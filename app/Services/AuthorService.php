<?php
namespace App\Services;
use App\Models\Author;
class AuthorService
{
    // Get all records
    public static function get()
    {
        return Author::orderby('id','desc')->paginate(10);
    }
    // delete record
    public static function delete($authorId) 
    {
        $author = Author::find($authorId);
        $author->delete();
    }
    //find record by id
    public static function getById($authorId)
    {
        return Author::find($authorId);
    }
    //insert or update record
    public static function createUpdate($authorDetails,$authorId)
    {
        if($authorId== 0)
        {
            return Author::create($authorDetails);
        }
        else
        {
            return Author::whereId($authorId)->update($authorDetails);
        }
    }
}
?>