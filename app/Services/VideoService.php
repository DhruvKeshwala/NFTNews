<?php
namespace App\Services;
use App\Models\Video_management;
class VideoService
{
    // find all News
    public static function getNews()
    {
        return Video_management::orderby('id','desc')->paginate(10);
    }
    // delete country
    public static function deleteNews($newsId) 
    {
        $news = Video_management::find($newsId);
        $news->delete();
    }
    //find country by id
    public static function getNewsById($categoryId)
    {
        return Video_management::find($categoryId);
    }
    //insert or update country
    public static function createNews($newsDetails,$newsId)
    {
        if($newsId== 0)
        {
            return Video_management::create($newsDetails);
        }
        else
        {
            return Video_management::whereId($newsId)->update($newsDetails);
        }
    }
}
?>