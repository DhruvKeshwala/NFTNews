<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NewsService;
use App\Models\Category;
use App\Models\News;
use App\Models\Guide;
use App\Models\Banner;
use App\Models\DropManagement;
use App\Services\PressReleaseService;
use App\Services\DropManagementService;
use App\Models\Video_management;
use App\Models\CryptoJournal;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

use App\Models\ManagePages;
use App\Services\ManagePagesService;

use View, DB;
use Mail;

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

        $cryptoJournals  = CryptoJournal::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderby('id','desc')->first();
        $pages               = ManagePages::all();
        $allNews             = News::take(10)->get();
        $categories          = Category::all();
        $pressReleases       = PressReleaseService::getPressRelease();
        $allDropManagement   = DropManagementService::getLatestDropManagement();
        $getAllNewses        = News::all();
        $videos              = Video_management::all();
        $guides              = Guide::all();
        $banners_small = Banner::where('size', '375 x 400 pixels')->get()->toArray();
        $banners_horizontal = Banner::where('size', '1210 x 210 pixels')->get()->toArray();
        $banners             = Banner::where('size', '280 x 400 pixels')->first();
        $settings = DB::table('settings')->where('id', 1)->first();
        return view('user.index', compact('banners', 'cryptoJournals', 'settings', 'pages','videos', 'getAllNewses', 'result', 'featured_news', 'resultFeaturedDrop', 'resultFeaturedNews', 'allNews', 'categories', 'pressReleases', 'allDropManagement', 'guides', 'banners_small','banners_horizontal'));
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
        $fourRandomDigit = mt_rand(1000,9999);
        return view('user.contact', compact('fourRandomDigit'));
    }
    public function sendMailForContact(Request $request)
    {

        $name = $request->name;
        $email = $request->email;
        $phone = $request->phn;
        $organization = $request->org;
        $location = $request->loc;
        $nmeproj = $request->nmeproj;
        $enquire_nature = $request->enquire_nature;
        $message = $request->message;
        $captcha = $request->captcha;
        $fourDigitRandom = $request->fourDigitRandom;

        if($request->captcha == $fourDigitRandom)
        {
            Mail::send('mailForContact', ['email' => $email], function ($message) use ($email){
                $message->to('info@infinitedryer.com', 'NFT News | Admin')->subject('NFT News Mail For Contact Request.');
                $message->from($email,'NFT News');
            });
            return redirect()->back()->with('success', 'Email Has Been Sent Successfully');
        }
        else
        {
            return redirect()->back()->with('error', 'Invalid Captcha.');
        }
        
    }
    public function subscribe()
    {
        $fourRandomDigit = mt_rand(1000,9999);
        return view('user.subscribe', compact('fourRandomDigit'));
    }

    public function sendMailForSubscribe(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phn;
        $subject = $request->subject;
        $message = $request->message;
        $captcha = $request->captcha;
        $fourDigitRandom = $request->fourDigitRandom;

        if($request->captcha == $fourDigitRandom)
        {
            Mail::send('mailForSubscribe', ['email' => $email], function ($message) use ($email){
                $message->to('info@infinitedryer.com', 'NFT News | Admin')->subject('NFT News Mail For Subscription Request.');
                $message->from($email,'NFT News');
            });
            return redirect()->back()->with('success', 'Email Has Been Sent Successfully');
        }
        else
        {
            return redirect()->back()->with('error', 'Invalid Captcha.');
        }
        
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

    public function partners()
    {
        $page = ManagePages::where('slug', 'partners')->first();
        if(@$page == null)
        {
            $page = 'No Partners Information available..';
        }
        return view('user.partners', compact('page'));
    }

    public function privacyPolicy()
    {
        $page = ManagePages::where('slug', 'privacy-policy')->first();
        if(@$page == null)
        {
            $page = 'No Privacy Policy Information available..';
        }
        return view('user.privacyPolicy', compact('page'));
    }

    public function termsAndConditions()
    {
        $page = ManagePages::where('slug', 'terms-and-conditions')->first();
        if(@$page == null)
        {
            $page = 'No Terms And Conditions Information available..';
        }
        return view('user.termsAndConditions', compact('page'));
    }

    public function gdpr()
    {
        $page = ManagePages::where('slug', 'gdpr')->first();
        if(@$page == null)
        {
            $page = 'No GDPR Information available..';
        }
        return view('user.gdpr', compact('page'));
    }

    public function termsOfService()
    {
        $page = ManagePages::where('slug', 'terms-of-service')->first();
        if(@$page == null)
        {
            $page = 'No Terms Of Service Information available..';
        }
        return view('user.termsOfService', compact('page'));
    }

    public function investmentAndFunding()
    {
        $page = ManagePages::where('slug', 'investment-and-funding')->first();
        if(@$page == null)
        {
            $page = 'No Investment & Funding Information available..';
        }
        return view('user.investmentAndFunding', compact('page'));
    }

    public function mediaEnquiries()
    {
        $page = ManagePages::where('slug', 'media-enquiries')->first();
        if(@$page == null)
        {
            $page = 'No Media Enquiries Information available..';
        }
        return view('user.mediaEnquiries', compact('page'));
    }

    public function careers()
    {
        $page = ManagePages::where('slug', 'careers')->first();
        if(@$page == null)
        {
            $page = 'No Careers Information available..';
        }
        return view('user.careers', compact('page'));
    }

    public function about()
    {
        $page = ManagePages::where('slug', 'about')->first();
        if(@$page == null)
        {
            $page = 'No About Page Information available..';
        }
        return view('user.about', compact('page'));
    }

    public function featuredNews()
    {
        $newses          = News::orderBy('id', 'DESC')->get();

        $currentDate = date('d-m-Y');
        $resultFeaturedNews = array();
        $resultFeaturedNews2 = array();
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
        $resultFeaturedNews2 = $resultFeaturedNews;
        $getAllNewses   = News::all();
        return view('user.featuredNews', compact('getAllNewses', 'resultFeaturedNews', 'resultFeaturedNews2'));
    }

    public function filterFeaturedNews(Request $request)
    {
        $newses          = News::orderBy('id', 'DESC')->get();

        $currentDate = date('d-m-Y');
        $resultFeaturedNews2 = array();
        foreach($newses as $key => $news)
        {
            $resultFeaturedNews2[$key] = $news;
            $resultFeaturedNews2[$key]->news_type = $newsType = json_decode($news->newsType);
            if ($newsType->featurednew && $newsType->featurednew->start_date <= $currentDate && $newsType->featurednew->end_date >= $currentDate) 
            {
                $resultFeaturedNews2[$key]->is_featurednew = 1;
                $resultFeaturedNews2[$key]->featurednew_start_date = $newsType->featurednew->start_date;
                $resultFeaturedNews2[$key]->featurednew_end_date = $newsType->featurednew->end_date;                
            }  
        }
        
        $getAllNewses   = News::all();
        $title      = $request->filterNewsTitle;
        $newses    = News::where('title', 'LIKE', '%'.$title.'%')->orderby('id','desc')->get();
        if($title == "" | $title == null)
        {
            $newses    = News::orderby('id','desc')->get();
        }
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
        

        // $allNews        = NewsService::getNews();
        // $categories     = Category::all();
        $getAllNewses   = News::all();
        return view('user.featuredNews', compact('getAllNewses', 'resultFeaturedNews', 'resultFeaturedNews2'));

    }

    public function newsHomeSearch(Request $request)
    {
        $homeSearch = $request->homeSearch;

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
        return view('user.news', compact('getAllNewses', 'allNews', 'categories', 'resultFeaturedNews','homeSearch'));
    }
    
}