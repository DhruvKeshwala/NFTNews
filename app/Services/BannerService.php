<?php
namespace App\Services;
use App\Models\Banner;
class BannerService
{
    // Get all records
    public static function get()
    {
        return Banner::orderby('id','desc')->paginate(10);
    }
    // delete record
    public static function delete($bannerId) 
    {
        $banner = Banner::find($bannerId);
        $banner->delete();
    }
    //find record by id
    public static function getById($bannerId)
    {
        return Banner::find($bannerId);
    }
    //insert or update record
    public static function createUpdate($bannerDetails,$bannerId)
    {
        if($bannerId== 0)
        {
            return Banner::create($bannerDetails);
        }
        else
        {
            return Banner::whereId($bannerId)->update($bannerDetails);
        }
    }
}
?>