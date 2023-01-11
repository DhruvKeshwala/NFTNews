<?php
namespace App\Services;
use App\Models\GuideCategory;
class GuideCategoryService
{
    // find all Category
    public static function getAllCategory()
    {
        return GuideCategory::all();
    }
    public static function getCategory()
    {
        return GuideCategory::orderby('id','desc')->paginate(10);
    }
    public static function filterCategory($request)
    {
        $name = $request->filterCategoryName;
        $metaTitle = $request->filterCategoryMetaTitle;
        return GuideCategory::where('name', 'LIKE', '%'.$name.'%')->where('title', 'LIKE', '%'.$metaTitle.'%')->orderby('id','desc')->paginate(10);
    }
    // delete Category
    public static function deleteCategory($categoryId) 
    {
        $category = GuideCategory::find($categoryId);
        $category->delete();
    }
    //find Category by id
    public static function getCategoryById($categoryId)
    {
        return GuideCategory::find($categoryId);
    }
    //insert or update Category
    public static function createCategory($categoryDetails,$categoryId)
    {
        if($categoryId== 0)
        {
            return GuideCategory::create($categoryDetails);
        }
        else
        {
            return GuideCategory::whereId($categoryId)->update($categoryDetails);
        }
    }
}
?>