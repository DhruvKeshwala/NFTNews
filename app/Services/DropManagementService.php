<?php
namespace App\Services;
use App\Models\DropManagement;
class DropManagementService
{
    // find all News
    public static function getDropManagement()
    {
        return DropManagement::orderby('id','desc')->paginate(10);
    }

    public static function getNFTDropBySlug($categoryId)
    {
        return DropManagement::where('slug', $categoryId)->first();
    } 
    
    //user-side home page display only 10 latest records
    public static function getLatestDropManagement()
    {
        return DropManagement::orderby('id','desc')->take(10)->get();
    }

    // delete country
    public static function deleteDropManagement($dropManagementId) 
    {
        $dropManagement = DropManagement::find($dropManagementId);
        $dropManagement->delete();
    }
    //find country by id
    public static function getDropManagementById($categoryId)
    {
        return DropManagement::find($categoryId);
    }
    //insert or update country
    public static function createDropManagement($dropManagementDetails,$dropManagementId)
    {
        if($dropManagementId==0)
        {
            return DropManagement::create($dropManagementDetails);
        }
        else
        {
            return DropManagement::whereId($dropManagementId)->update($dropManagementDetails);
        }
    }
}
?>