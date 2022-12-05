<?php
namespace App\Services;
use App\Models\News;
class NewsService
{
    // find all News
    public static function getNews()
    {
        return News::orderby('id','desc')->paginate(10);
    }
    // delete country
    public static function deleteNews($newsId) 
    {
        $news = News::find($newsId);
        $news->delete();
    }
    //find country by id
    public static function getNewsById($categoryId)
    {
        return News::find($categoryId);
    }
    //insert or update country
    public static function createNews($newsDetails,$newsId)
    {
        if($newsId== 0)
        {
            return News::create($newsDetails);
        }
        else
        {
            return News::whereId($newsId)->update($newsDetails);
        }
    }
}
?>