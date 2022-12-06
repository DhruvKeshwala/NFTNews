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