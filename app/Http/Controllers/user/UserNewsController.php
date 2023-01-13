<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NewsService;
use App\Models\News;
use App\Models\Category;
use App\Models\Banner;

class UserNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $allNews        = News::orderby('id','desc')->paginate(10);
        $categories     = Category::all();
        $getAllNewses   = News::all();
        $innerSideBanner = Banner::where('location', 'innerrec')->first();
        $newsTopBanner = Banner::where('location', 'latnewsfull')->first();
        return view('user.news', compact('newsTopBanner', 'innerSideBanner','getAllNewses', 'allNews', 'categories', 'resultFeaturedNews'));
    }

    public function filterNews(Request $request)
    {
        // dd($request->all());
        $getAllNewses   = News::all();
        $title      = $request->filterNewsTitle;
        $allNews    = News::where('title', 'LIKE', '%'.$title.'%')->orderby('id','desc')->paginate(10);

        if($title == "" | $title == null)
        {
            $allNews    = News::orderby('id','desc')->paginate(10);
        }

        if($request->homeSearch)
        {
            $title      = $request->homeSearch;
            $allNews    = News::where('title', 'LIKE', '%'.$title.'%')->orderby('id','desc')->paginate(10);
        }
        $categories     = Category::all();
        $innerSideBanner = Banner::where('location', 'innerrec')->first();
        $newsTopBanner = Banner::where('location', 'latnewsfull')->first();

        return view('user.news', compact('categories', 'allNews', 'getAllNewses', 'innerSideBanner', 'newsTopBanner'));
    }

    public function newsDetail($id)
    {
        $newses          = News::orderBy('id', 'DESC')->get();

        $newsDetail = NewsService::getNewsBySlug($id);
        
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
        $getAllNewses    = News::all();
        $banners         = Banner::where('size', '280 x 400 pixels')->first();
        $innerSideBanner = Banner::where('location', 'innerrec')->first();
        return view('user.newsDetails',compact('innerSideBanner', 'newsDetail', 'resultFeaturedNews', 'getAllNewses', 'banners'));
    }
}