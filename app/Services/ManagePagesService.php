<?php
namespace App\Services;
use App\Models\ManagePages;
class ManagePagesService
{
    // find all News
    public static function getPages()
    {
        return ManagePages::orderby('id','desc')->paginate(10);
    }
    // delete country
    public static function deletePage($pageId) 
    {
        $pages = ManagePages::find($pageId);
        $pages->delete();
    }
    //find country by id
    public static function getPageById($categoryId)
    {
        return ManagePages::find($categoryId);
    }

    public static function getPageBySlug($categoryId)
    {
        return ManagePages::where('slug', $categoryId)->first();
    } 
    //insert or update country
    public static function createPage($pagedetails,$pageId)
    {
        if($pageId== 0)
        {
            return ManagePages::create($pagedetails);
        }
        else
        {
            return ManagePages::whereId($pageId)->update($pagedetails);
        }
    }
}
?>