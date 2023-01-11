<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\GuideCategory;
use Illuminate\Http\Request;
use App\Models\Guide;

class UserGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        $guidesCategory = GuideCategory::get();           
        return view('user.guide',compact('guidesCategory'));
    }

    public function guideList($category=null, $slug=null)
    {
        $guideDetail = [];
        $guides = Guide::where('category', $category)->get();
        if (empty($slug)) {
            $slug = @$guides[0]->slug;
            if (!$slug) {
                return view('user.guide');
            }
            $guideDetail = Guide::where(['category'=> $category,'slug'=> $guides[0]->slug])->first();            
            return redirect()->route('user.guideList', ['category' => $category, 'slug'=> $guides[0]->slug ]);
        } else {
            $guideDetail = Guide::where(['category'=> $category,'slug'=> $slug])->first();
        }
        return view('user.guideDetails', compact('guides', 'guideDetail', 'slug'));
    }    
}
