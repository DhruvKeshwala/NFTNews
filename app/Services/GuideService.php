<?php
namespace App\Services;
use App\Models\Guide;
class GuideService
{
    // find all Guide
    public static function getGuide()
    {
        return Guide::orderby('id','desc')->paginate(10);
    }
    // delete country
    public static function deleteGuide($guideId) 
    {
        $news = Guide::find($guideId);
        $news->delete();
    }
    //find country by id
    public static function getGuideById($categoryId)
    {
        return Guide::find($categoryId);
    }

    public static function getGuideBySlug($categoryId)
    {
        return Guide::where('slug', $categoryId)->first();
    } 
    //insert or update country
    public static function createGuide($guideDetails,$guideId)
    {
        if($guideId== 0)
        {
            return Guide::create($guideDetails);
        }
        else
        {
            return Guide::whereId($guideId)->update($guideDetails);
        }
    }
}
?>