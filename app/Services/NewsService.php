<?php



namespace App\Services;

use App\Models\News;
use Illuminate\Support\Carbon;

class NewsService
{

    private News $news;

    public function __construct()
    {
        $this->news = new News();
    }


    public function findAll()
    {
        $data = $this->news->all()->toArray();
        $result = $this->castToPojo($data);
        return $result;
    }

    public function findAllActive()
    {

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

}