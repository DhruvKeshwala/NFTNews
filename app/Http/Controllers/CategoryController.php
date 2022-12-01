<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $category = CategoryService::getCategory();
        return view('category', compact('category'));
    }
    public function addCategory($id=null)
    {
        $category = CategoryService::getCategoryById($id);
        return view('add_category',compact('category','id'));
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
        $country = CategoryService::createCategory($categoryDetails,$request->categoryId);
        return json_encode(['success'=>1,'message'=>'Category Detail Saved Successfully']);
    }
    public function deleteCategory(Request $request)
    {
        //find country by id
        $country = CategoryService::deleteCategory($request->id);
        return json_encode(['success'=>1,'message'=>'Category has been deleted successfully']);
    }
    public function editCategory(Request $request)
    {
        //find country by id
        //$country = CountryService::getCountryBYId($request->id);
        //return json_encode(['success'=>1,'countryDetail'=>$country]);

        return view('add_category');
    }
}
