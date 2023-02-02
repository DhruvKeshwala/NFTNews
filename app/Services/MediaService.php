<?php
namespace App\Services;
use App\Models\Media;
class MediaService
{
    // Get all records
    public static function get()
    {
        return Media::orderby('id','desc')->paginate(10);
    }
    // delete record
    public static function delete($mediaId) 
    {
        $media = Media::find($mediaId);
        $media->delete();
    }
    //find record by id
    public static function getMediaById($mediaId)
    {
        return Media::find($mediaId);
    }
    //insert or update record
    public static function createUpdate($mediaDetails,$mediaId)
    {
        if($mediaId== 0)
        {
            return Media::create($mediaDetails);
        }
        else
        {
            return Media::whereId($mediaId)->update($mediaDetails);
        }
    }
}
?>