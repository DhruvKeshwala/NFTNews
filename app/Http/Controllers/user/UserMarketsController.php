<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use App\Models\Banner;

class UserMarketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $getAllNewses   = News::orderby('orderIndex','asc')->paginate(20);
        $innerSideBanner = Banner::where('location', 'innerrec')->first();
        $marketTopBanner = Banner::where('location', 'marketsfull')->first();
        $banners_small = Banner::where('location', 'hpmarnewsrect')->get()->toArray();
        $banners_horizontal = Banner::where('location', 'hpmarnewsfull')->get()->toArray();
        return view('user.markets', compact('innerSideBanner', 'marketTopBanner', 'getAllNewses', 'categories','banners_small','banners_horizontal'));
    }

    public function filterMarketNews(Request $request)
    {
        $request->filternftcategoryValue = base64_decode($request->filternftcategoryValue);
        $categories = Category::all();
        $getAllNewses  = News::where(function($dm) {
            $request = app()->make('request');
            if($request->filternftcategoryValue == 'all' || $request->filterValue == 'all') {
                $dm->where('categoryId', '>', 0);
            }
            else if($request->filternftcategoryValue > 0) {
                $dm->where('categoryId', '=', $request->filternftcategoryValue);
            }
            if($request->search != null && $request->search != '') {
                $dm->where('title', 'like', '%'.$request->search.'%');
            }
            if($request->filterValue == 'latest') {
                $dm->where('categoryId','>', 0);
            }
            if($request->filterValue == 'featured')
            {
                 $currentDate              = date('d-m-Y');
                 $dm->where('newsType->featurednew->start_date','<=', $currentDate);
                 $dm->where('newsType->featurednew->end_date','>=', $currentDate);
            }
        })->orderby('orderIndex','asc')->paginate(20);
        $filtercategoryId = $request->filternftcategoryValue;
        $search = $request->search;
        // return view('user.listNFTDrops', compact('allDropManagement','categories','filtercategoryId','nftsearch')); 
        $filterValue = $request->filterValue;
        $banners_small = Banner::where('location', 'hpmarnewsrect')->get()->toArray();
        $banners_horizontal = Banner::where('location', 'hpmarnewsfull')->get()->toArray();
        return view('user.markets', compact('getAllNewses', 'categories', 'filtercategoryId', 'search', 'filterValue','banners_small','banners_horizontal'));

    }

}
