<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Video_management;
use App\Services\VideoService;
use App\Models\Category;

class UserVideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $videos   = Video_management::where('fld_status', 'Active')->orderby('id','desc')->paginate(10);
        $banners = Banner::where('location', 'videosfull')->first();
        return view('user.videos', compact('videos', 'categories','banners'));
    }


    public function videoDetail($id)
    {
        $videoDetail = VideoService::getVideosBySlug($id);
        return view('user.videoDetails',compact('videoDetail'));
    }

    public function filterVideos(Request $request)
    {
        $categories = Category::all();
        $videos  = Video_management::where(function($dm) {
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
                 $currentDate              = date('Y-m-d');
                 $dm->where('start_date','<=', $currentDate);
                 $dm->where('end_date','>=', $currentDate);
            }
        })->orderby('id','desc')->paginate(20);
        $filtercategoryId = $request->filternftcategoryValue;
        $search = $request->search;
        // return view('user.listNFTDrops', compact('allDropManagement','categories','filtercategoryId','nftsearch')); 
        $filterValue = $request->filterValue;
        $banners = Banner::where('location', 'videosfull')->first();
        return view('user.videos', compact('videos', 'categories', 'filtercategoryId', 'search', 'filterValue','banners'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
