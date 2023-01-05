<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NewsService;
use App\Models\Category;
use App\Models\News;
use App\Models\DropManagement;
use App\Services\PressReleaseService;
use App\Services\DropManagementService;
use App\Models\Video_management;
use Illuminate\Support\Facades\Response;

use App\Models\ManagePages;
use App\Services\ManagePagesService;

use View, DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newses          = News::orderBy('id', 'DESC')->get();
        // dd($newses[0]->newsType['homeheader']['start_date']);
        
        // foreach($newses as $newsData)
        // {
        //     $homeHeaderStartDate[] = json_decode($newsData->newsType);
        //     dd($homeHeaderStartDate[0]->homeheader->start_date);
        //     $homeHeaderEndDate[] = $newsData->newsType['homeheader']['end_date'];
        // }
        
        // $getDateDate = News::whereJsonContains("newsType->homeheader->start_date", $homeHeaderStartDate)->get();
        // dd($getDateDate);
        $currentDate = date('d-m-Y');
        $result = array();
        $resultHomeNews     = array();
        $resultFeaturedDrop = array();
        $resultFeaturedNews = array();

        $featured_news = array();
        $i = 0;
        foreach($newses as $key => $news)
        {
            $result[$key] = $news;
            $result[$key]->news_type = $newsType = json_decode($news->newsType);
            if ($newsType->homeheader && $newsType->homeheader->start_date <= $currentDate && $newsType->homeheader->end_date >= $currentDate) {
                $result[$key]->is_homeheader = 1;
                $result[$key]->homeheader_start_date = $newsType->homeheader->start_date;
                $result[$key]->homeheader_end_date = $newsType->homeheader->end_date;
            }

            if ($newsType->homenews && $newsType->homenews->start_date <= $currentDate && $newsType->homenews->end_date >= $currentDate) 
            {
                $featured_news[$i] = $news;
                $featured_news[$i]->is_homenews = $result[$key]->is_homeheader = 1;
                $featured_news[$i]->homeheader_start_date = $result[$key]->homeheader_start_date = $newsType->homeheader->start_date;
                $featured_news[$i]->homeheader_end_date = $result[$key]->homeheader_end_date = $newsType->homeheader->end_date;
                $i++;
            }
            $resultFeaturedDrop[$key] = $news;
            $resultFeaturedDrop[$key]->news_type = $newsType = json_decode($news->newsType);
            if ($newsType->featureddrop && $newsType->featureddrop->start_date <= $currentDate && $newsType->featureddrop->end_date >= $currentDate) {
                $resultFeaturedDrop[$key]->is_featuredDrop = 1;
                $resultFeaturedDrop[$key]->featureddrop_start_date = $newsType->featureddrop->start_date;
                $resultFeaturedDrop[$key]->featureddrop_end_date = $newsType->featureddrop->end_date;  
            }

            $resultFeaturedNews[$key] = $news;
            $resultFeaturedNews[$key]->news_type = $newsType = json_decode($news->newsType);
            if ($newsType->featurednew && $newsType->featurednew->start_date <= $currentDate && $newsType->featurednew->end_date >= $currentDate) {
                $resultFeaturedNews[$key]->is_featurednew = 1;
                $resultFeaturedNews[$key]->featurednew_start_date = $newsType->featurednew->start_date;
                $resultFeaturedNews[$key]->featurednew_end_date = $newsType->featurednew->end_date;                
            }
        }
        $pages               = ManagePages::all();
        $allNews             = News::take(10)->get();
        $categories          = Category::all();
        $pressReleases       = PressReleaseService::getPressRelease();
        $allDropManagement   = DropManagementService::getLatestDropManagement();
        $getAllNewses        = News::all();
        $videos              = Video_management::all();
        return view('user.index', compact('pages','videos', 'getAllNewses', 'result', 'featured_news', 'resultFeaturedDrop', 'resultFeaturedNews', 'allNews', 'categories', 'pressReleases', 'allDropManagement'));
    }

    public function userFilterVideos(Request $request)
    {
        $categoryId = $request->categoryId;
        if($categoryId == 0)
        {
            $videos    =  Video_management::take(10)->get();
        }
        else
        {
            $videos    =  Video_management::where('categoryId', $categoryId)->get();
        }
        
        $contents = View::make('user.videosDisplay')->with('videos', $videos);
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'text/plain');
        return $response;
    }

    public function userFilterCategory(Request $request)
    {
        $categoryId = $request->categoryId;
        if($categoryId == 0)
        {
            $allNews    =  News::take(10)->get();
        }
        else
        {
            $allNews    =  News::where('categoryId', $categoryId)->get();
        }
        
        $contents = View::make('user.newsDisplay')->with('allNews', $allNews);
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'text/plain');
        return $response;
    }
    
    public function userFilterNFTDrops(Request $request)
    {
        $getAllNewses        = News::all();
        $categoryId = $request->categoryId;
        if($categoryId == 0)
        {
            $allDropManagement    =  DropManagement::get();
        }
        else
        {
            $allDropManagement    =  DropManagement::where('categoryId', $categoryId)->get();
        }
        
        $contents = View::make('user.NFTDropDisplay')->with('allDropManagement', $allDropManagement);
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'text/plain');
        return $response;
    }

    public function advertise()
    {
        return view('user.advertise');
    }

    public function contact()
    {
        return view('user.contact');
    }

    public function education()
    {
        $page = ManagePages::where('slug', 'education')->first();
        if(@$page == null)
        {
            $page = 'No Education Information available..';
        }
        return view('user.education', compact('page'));
    }

    public function services()
    {
        $page = ManagePages::where('slug', 'services')->first();
        if(@$page == null)
        {
            $page = 'No Services Information available..';
        }
        return view('user.services', compact('page'));
    }
}
