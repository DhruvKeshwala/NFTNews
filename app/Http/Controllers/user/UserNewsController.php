<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NewsService;
use App\Models\News;
use App\Models\Category;

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
        $allNews        = NewsService::getNews();
        $categories     = Category::all();
        return view('user.news', compact('allNews', 'categories', 'resultFeaturedNews'));
    }

    public function filterNews(Request $request)
    {
        $title      = $request->filterNewsTitle;
        $allNews    = News::where('title', 'LIKE', '%'.$title.'%')->orderby('id','desc')->paginate(2);
        return view('user.news', compact('allNews'));
    }

    public function newsDetail($id)
    {
        $newsDetail = NewsService::getNewsById(base64_decode($id));
        return view('user.newsDetails',compact('newsDetail'));
    }
}
