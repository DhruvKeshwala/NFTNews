<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $category = CategoryService::getCategory();
        return view('category', compact('category'));
    }
    public function filterCategory(Request $request)
    {
        $name       = $request->filterCategoryName;
        $metaTitle  = $request->filterCategoryMetaTitle;
        $category   = Category::where('name', 'LIKE', '%'.$name.'%')->where('title', 'LIKE', '%'.$metaTitle.'%')->orderby('id','desc')->paginate(10);
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

        $categories = Category::select('slug')->withTrashed()->get();
        if(count($categories))
        {
            $lastId     = Category::select('id')->withTrashed()->latest()->first();
            foreach($categories as $value)
            {
                if($value->slug == $categoryDetails['slug'])
                {
                    $categoryDetails['slug'] = Str::slug($request->name . '-' . base64_encode($lastId->id));
                }
            }
        }
        CategoryService::createCategory($categoryDetails,$request->categoryId);
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
