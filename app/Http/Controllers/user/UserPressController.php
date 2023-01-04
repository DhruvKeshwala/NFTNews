<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PressReleaseService;
use App\Services\NewsService;
use App\Models\PressRelease;
use App\Models\Category;
use App\Models\News;

class UserPressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pressReleases          = PressRelease::orderBy('id', 'DESC')->paginate(20);
        $newses          = News::orderBy('id', 'DESC')->get();

        $currentDate = date('d-m-Y');
        $resultFeaturedNews = array();

        foreach($newses as $key => $news)
        {
            $resultFeaturedNews[$key] = $news;
            $resultFeaturedNews[$key]->news_type = $newsType = json_decode($news->newsType);
            if ($newsType->featurednew && $newsType->featurednew->start_date <= $currentDate && $newsType->featurednew->end_date >= $currentDate) 
            {
                $resultFeaturedNews[$key]->is_featurednew = 1;
                $resultFeaturedNews[$key]->featurednew_start_date = $newsType->featurednew->start_date;
                $resultFeaturedNews[$key]->featurednew_end_date = $newsType->featurednew->end_date;                
            }  
        }
        // dd($resultFeaturedNews);
        $allNews        = NewsService::getNews();
        $categories     = Category::all();
        $getAllNewses   = News::all();
        return view('user.pressRelease', compact('pressReleases', 'categories', 'getAllNewses', 'allNews','resultFeaturedNews'));
    }

    public function pressDetail($id)
    {
        $pressDetail = PressReleaseService::getPressReleaseById(base64_decode($id));
        return view('user.pressDetails',compact('pressDetail'));
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
