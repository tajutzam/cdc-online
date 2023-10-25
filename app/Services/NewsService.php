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

    public function __construct()
    {
        $this->news = new News();
    }


    public function findAll($page = 0)
    {

        $data = $this->news->paginate(10, ['*'], 'page', $page); // Change 10 to the number of items you want per page
        $result = $this->castToPojo($data->items());

        return [
            'data' => $result,
            'pagination' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
            ],
        ];
    }

    public function findAllActive()
    {

        $data = $this->news->with('admin')->where('active', true)->get()->toArray();
        return $this->castToPojo($data);
    }

    function findById($id): array
    {
        $data = $this->news->with('admin')->where('active', true)->where('id', $id)->first();
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
            'active' => true,
        ]);
        if (isset($created)) {
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
            'active' => $request['active']
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