<?php
namespace App\Services;
use App\Models\PressRelease;
class PressReleaseService
{
    // find all News
    public static function getPressRelease()
    {
        return PressRelease::orderby('id','desc')->paginate(10);
    }
    public static function getPressBySlug($categoryId)
    {
        return PressRelease::where('slug', $categoryId)->first();
    } 
    // delete country
    public static function deletePressRelease($pressReleaseId) 
    {
        $PressRelease = PressRelease::find($pressReleaseId);
        $PressRelease->delete();
    }
    //find country by id
    public static function getPressReleaseById($categoryId)
    {
        return PressRelease::find($categoryId);
    }
    //insert or update country
    public static function createPressRelease($pressReleaseDetails,$pressReleaseId)
    {
        if($pressReleaseId== 0)
        {
            return PressRelease::create($pressReleaseDetails);
        }
        else
        {
            return pressRelease::whereId($pressReleaseId)->update($pressReleaseDetails);
        }
    }
}
?>