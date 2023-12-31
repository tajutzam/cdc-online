<?php



namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Exceptions\WebException;
use App\Models\News;
use Cloudinary\Api\Exception\BadRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class NewsService
{

    private News $news;
    private NotificationService $notificationService;

    public function __construct()
    {
        $this->notificationService = new NotificationService();
        $this->news = new News();
    }


    public function findAll($page = 0)
    {

        $data = $this->news->with('admin')->paginate(5, ['*'], 'page', $page); // Change 10 to the number of items you want per page
        $result = $this->castToPojo($data->items());


        $endDate = Carbon::now(); // Current date and time
        $startDate = $endDate->copy()->startOfWeek(); // Start of the current week (Sunday)
        $endDate = $endDate->copy()->endOfWeek(); // End of the current week (Saturday)

        // Query to count news items within the last week
        $endDate = Carbon::now(); // Current date and time
        $startDate = $endDate->copy()->startOfWeek(); // Start of the current week (Sunday)
        $endDate = $endDate->copy()->endOfWeek(); // End of the current week (Saturday)


        $countsAll = [];

        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            // Query to count active news items for the current day
            $count = $this->news
                ->whereDate('created_at', $currentDate)
                ->count();
            // Store the count in the array with the date as the key
            $countsAll[$currentDate->toDateString()] = $count;

            // Move to the next day
            $currentDate->addDay();
        }

        return [
            'data' => $result,
            // 'count_by_active' => $countsByDayActive,
            // 'count_by_day_nonactive' => $countsByDayNonActive,
            'count_all' => $countsAll,
            'pagination' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
            ],
        ];
    }




    public function findLastInserted()
    {

        $data = $this->news->with('admin')->latest()->take(5)->get()->toArray();
        return $this->castToPojo($data);
    }

    function findById($id): array
    {
        $data = $this->news->with('admin')->where('id', $id)->first();
        if (isset($data)) {
            $data = $data->toArray();
            $response = $this->castToSinglePojo($data);
            return $response;
        }
        throw new NotFoundException('Ops, Berita tidak ditemukan harap masukan ID yang benar');
    }

    public function addNews($request, $image)
    {
        $adminId = Auth::guard('admin')->user()->id;

        DB::beginTransaction();
        $folder = "news";
        $fileName = time() . '.' . $image->extension();
        $urlResource = $image->move($folder, $fileName);
        if (!isset($urlResource)) {
            throw new WebException('Ops, Gagal membuat Berita terjadi kesalahan');
        }
        $created = $this->news->create([
            'admin_id' => $adminId,
            'image' => $fileName,
            'title' => $request['title'],
            'description' => $request['description'],

        ]);
        if (isset($created)) {
            $this->notificationService->sendNotificationsNews($created->title, $created->id);
            DB::commit();
            return [
                'status' => true,
                'code' => 201,
                'message' => 'Sukses membuat Berita'
            ];
        }

        throw new WebException('Ops, Gagal membuat Berita terjadi kesalahan');
    }

    public function update($request, $image, $id)
    {
        $news = $this->news->where('id', $id)->first();
        if (!isset($news)) {
            throw new WebException('Ops, Berita tidak ditemukan');
        }
        $imageName = $news->image;
        $imagePath = public_path("news/" . $imageName); // Get the full path to the image
        if (isset($image)) {
            if (File::exists($imagePath)) {
                File::delete($imagePath); // Delete the image file
            }
            $folder = "news";
            $fileName = time() . '.' . $image->extension();
            $imageName = $fileName;
            $urlResource = $image->move($folder, $fileName);
        }

        DB::beginTransaction();
        $updated = $news->update([
            'image' => $imageName,
            'title' => $request['title'],
            'description' => $request['description'],
        ]);
        if ($updated) {
            Db::commit();
            return [
                'status' => true,
                'code' => 201,
                'message' => 'Sukse memperbarui Berita'
            ];
        }
        throw new WebException('Ops, Gagal memperbarui Berita terjadi kesalahan');
    }

    public function delete($id)
    {
        $news = $this->news->where('id', $id)->first();
        DB::beginTransaction();
        if (isset($news)) {
            $deleted = $news->delete();
            if ($deleted) {
                DB::commit();
                return back()->with('Sukses', 'Berhasil menghapus Berita');
            }
            throw new WebException('Gagal menghapus Berita, terjadi kesalahan');
        }
        throw new WebException('Gagal menghapus Berita, Berita tidak ditemukan');
    }


    private function castToPojo($newsArray)
    {
        $newsCollect = collect($newsArray);

        return $newsCollect->map(function ($news) {
            $url = url("/") . "/news/" . $news['image'];
            $createdAt = Carbon::parse($news['updated_at']);
            $now = Carbon::now();
            $interval = $createdAt->diffForHumans($now);
            $interval = str_replace('before', 'ago', $interval);
            $news['image'] = $url;
            $news['interval'] = $interval;

            return $news;
        })->toArray();
    }

    private function castToSinglePojo($news)
    {
        $url = url("/") . "/news/" . $news['image'];
        $createdAt = Carbon::parse($news['updated_at']);
        $now = Carbon::now();
        $interval = $createdAt->diffForHumans($now);
        $interval = str_replace('before', 'ago', $interval);
        $news['image'] = $url;
        $news['interval'] = $interval;

        return $news;
    }

}