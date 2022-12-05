<?php
namespace App\Services;
use App\Models\Category;
class CategoryService
{
    // find all Category
    public static function getCategory()
    {
        return Category::orderby('id','desc')->paginate(10);
    }
    // delete Category
    public static function deleteCategory($categoryId) 
    {
        $category = Category::find($categoryId);
        $category->delete();
    }
    //find Category by id
    public static function getCategoryById($categoryId)
    {
        return Category::find($categoryId);
    }
    //insert or update Category
    public static function createCategory($categoryDetails,$categoryId)
    {
        if($categoryId== 0)
        {
            return Category::create($categoryDetails);
        }
        else
        {
            return Category::whereId($categoryId)->update($categoryDetails);
        }
    }
}
?>