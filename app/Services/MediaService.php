<?php
namespace App\Services;
use App\Models\Media;
class MediaService
{
    // Get all records
    public static function get()
    {
        return Media::orderby('id','desc')->get();
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
    // Get filter records
    public static function getFilterMedia($param)
    {
        return Media::where('title','LIKE','%'.$param['search_key'].'%')->get();
    }

    public static function deleteMedia($id) 
    {
        $media = Media::find($id);
        $media->delete();
    }
}
?>