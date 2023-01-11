<?php

namespace App\Http\Controllers;

use App\Models\GuideCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\GuideCategoryService;

class GuideCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = GuideCategoryService::getCategory();
        return view('guide_category', compact('category'));
    }

    public function addCategory($id=null)
    {
        $category = GuideCategoryService::getCategoryById($id);
        return view('add_guide_category',compact('category','id'));
    }

    public function saveCategory(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required',
            'categoryId' => 'required',
            'title' => 'required',
            'description' => 'required',
            'keywords' => 'required',
        ]);

        $categoryDetails = $request->only([
            'name',
            'title',
            'description',
            'keywords'
        ]);
        $categoryDetails['slug'] = Str::slug($request->name);
        $country = GuideCategoryService::createCategory($categoryDetails,$request->categoryId);
        return json_encode(['success'=>1,'message'=>'Category Detail Saved Successfully']);
    }
    public function deleteCategory(Request $request)
    {
        //find country by id
        $country = GuideCategoryService::deleteCategory($request->id);
        return json_encode(['success'=>1,'message'=>'Category has been deleted successfully']);
    }
    
    public function filterCategory(Request $request)
    {
        $name       = $request->filterCategoryName;
        $metaTitle  = $request->filterCategoryMetaTitle;
        $category   = GuideCategory::where('name', 'LIKE', '%'.$name.'%')->where('title', 'LIKE', '%'.$metaTitle.'%')->orderby('id','desc')->paginate(10);
        return view('guide_category', compact('category', 'name', 'metaTitle'));
    }

    
}
