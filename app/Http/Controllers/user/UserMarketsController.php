<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;

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
        $getAllNewses   = News::orderby('id','desc')->paginate(20);
        return view('user.markets', compact('getAllNewses', 'categories'));
    }

    public function filterMarketNews(Request $request)
    {
        $categories = Category::all();
        if($request->list)
        {
            if($request->list == 'all')
            {
                $getAllNewses = News::orderBy('id')->paginate(50);
            }
            else
            {
                $categoryId = $request->list;
                $getAllNewses = News::where('categoryId', $categoryId)->paginate(50);
            }
            return view('user.markets', compact('getAllNewses', 'categories'));
        }
        if($request->filterValue == 'all')
        {
            $getAllNewses = News::orderBy('id')->paginate(50);
        }
        elseif($request->filterValue == 'latest')
        {
            $getAllNewses = News::orderBy('id','desc')->paginate(50);
        }
        elseif($request->filterValue == 'featured')
        {
            $getAllNewses             = News::orderBy('id', 'DESC')->paginate(50);
            $currentDate        = date('d-m-Y');
            $resultFeaturedNews       = array();

            foreach($getAllNewses as $key => $news)
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
            return view('user.markets', compact('getAllNewses', 'categories'));
        }
        elseif($request->search != null)
        { 
            $title          = $request->search;
            $getAllNewses   = News::where('title', 'LIKE', '%'.$title.'%')->orderby('id','desc')->paginate(50);
            
        }
        elseif($request->search == "" || $request->search == null)
        {
            $getAllNewses = News::orderBy('id', 'DESC')->paginate(50);
        }
        return view('user.markets', compact('getAllNewses', 'categories'));

    }
}
