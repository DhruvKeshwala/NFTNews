<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;
use App\Services\GuideService;
use Illuminate\Support\Str;
use App\Services\GuideCategoryService;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guide = GuideService::getGuide();
        return view('guide', compact('guide'));
    }

    public function addGuide($id=null)
    {
        $guide = Guide::where('id', $id)->first();
        $categories = GuideCategoryService::getAllCategory();
        // $guide = GuideService::getGuideById($id);
        return view('add_guide',compact('guide','id', 'categories'));
    }

    public function saveGuide(Request $request)
    {
        //validation
        $request->validate([
            'category'        => 'required',
            'question'  => 'required',
            'answer'   => 'required',
        ]);
        
        $guidedetails = $request->only([
            'category',
            'question',
            'answer',
        ]);
        $guidedetails['slug']     = Str::slug($request->question);
        $guidedetails['categorySlug']     = Str::slug($request->category); //Adds slug for guide
        $news = GuideService::createGuide($guidedetails,$request->guideId);
        return json_encode(['success'=>1,'message'=>'Guide Detail Saved Successfully']);
    }

    public function guideDetail($id)
    {
        $guide = Guide::where('id', $id)->first();
        return view('guideDetails',compact('guide'));
    }

    public function filterGuide(Request $request)
    {
        $category = $request->category;
        // if($category == '' | $category == null)
        //     $guide = Guide::get();
        // else
        $guide       = Guide::where('category', $category)->orderby('id','desc')->paginate(10);
        return view('guide', compact('guide'));
    }

    public function deleteGuide(Request $request)
    {
        $guide = GuideService::deleteGuide($request->id);
        return json_encode(['success'=>1,'message'=>'Guide has been deleted successfully']);
    }
}
