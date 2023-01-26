<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PressReleaseService;
use App\Services\NewsService;
use App\Models\PressRelease;
use App\Models\Category;
use App\Models\Banner;
use App\Models\News;
use Carbon\Carbon;
use Mail;
use App\Mail\subscribeMail;

class UserPressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pressReleases          = PressRelease::orderBy('orderIndex', 'asc')->paginate(10);
        $pressRecommended = PressRelease::where('start_date', '!=' , null)->where('start_date', '!=' , null)->orderBy('orderIndex', 'asc')->get();
        $newses          = News::orderBy('orderIndex', 'asc')->get();

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
        $banners_small = Banner::where('location', 'hpmarnewsrect')->get()->toArray();
        $banners_horizontal = Banner::where('location', 'hpmarnewsfull')->get()->toArray();
        $categories     = Category::all();
        $getAllNewses   = News::orderBy('orderIndex', 'asc')->get();
        $banners        = Banner::where('size', '280 x 400 pixels')->first();
        $pressTopBanner = Banner::where('location', 'pressrelfull')->first();
        $pressSideBanner = Banner::where('location', 'prssrelrect')->first();
        return view('user.pressRelease', compact('banners_small', 'banners_horizontal', 'pressSideBanner', 'pressTopBanner', 'pressReleases', 'pressRecommended', 'categories', 'getAllNewses', 'resultFeaturedNews', 'banners'));
    }

    public function pressDetail($id)
    {
        $pressDetail = PressReleaseService::getPressBySlug($id);
        $newses          = News::orderBy('orderIndex', 'asc')->get();
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
        $banners_small = Banner::where('location', 'hpmarnewsrect')->get()->toArray();
        $banners_horizontal = Banner::where('location', 'hpmarnewsfull')->get()->toArray();
        $categories     = Category::all();
        $getAllNewses   = News::orderBy('orderIndex', 'asc')->get();
        $innerSideBanner = Banner::where('location', 'innerrec')->first();
        return view('user.pressDetails',compact('banners_small', 'banners_horizontal', 'innerSideBanner', 'pressDetail', 'categories', 'getAllNewses', 'resultFeaturedNews'));
    }
    
    public function filterPress(Request $request)
    {
        $request->filternftcategoryValue = base64_decode($request->filternftcategoryValue);
        $pressRecommended = PressRelease::orderBy('orderIndex', 'asc')->get();
        $pressReleases  = PressRelease::where(function($dm) {
            $request = app()->make('request');
            if($request->filternftcategoryValue == 'all' || $request->filterValue == 'all') {
                $dm->get();
            }
            else if($request->filternftcategoryValue > 0) {
                // $dm->where('categoryId', '=', $request->filternftcategoryValue);
                $dm->where('categoryId', 'LIKE', '%'.$request->filternftcategoryValue.'%');
            }
            if($request->search != null && $request->search != '') {
                $dm->where('title', 'like', '%'.$request->search.'%');
            }
            if($request->filterValue == 'thisWeek') {
                $dm->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            }
            if($request->filterValue == 'thisMonth')
            {
                $dm->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
            }
            // if($request->filterValue == 'featured')
            // {
            //      $currentDate              = date('d-m-Y');
            //      $dm->where('newsType->featurednew->start_date','<=', $currentDate);
            //      $dm->where('newsType->featurednew->end_date','>=', $currentDate);
            // }
        })->orderby('orderIndex','asc')->paginate(10);
        $filtercategoryId = $request->filternftcategoryValue;
        $search = $request->search;
        // return view('user.listNFTDrops', compact('allDropManagement','categories','filtercategoryId','nftsearch')); 
        $filterValue = $request->filterValue;
        $categories     = Category::all();
        $getAllNewses   = News::orderBy('orderIndex', 'asc')->get();
        $banners        = Banner::where('size', '280 x 400 pixels')->first();
        $banners_small = Banner::where('location', 'hpmarnewsrect')->get()->toArray();
        $banners_horizontal = Banner::where('location', 'hpmarnewsfull')->get()->toArray();
        return view('user.pressRelease', compact('banners_small', 'banners_horizontal', 'banners', 'pressReleases', 'pressRecommended', 'getAllNewses', 'search', 'filterValue', 'categories', 'filtercategoryId'));
    }

    // public function sendMail(Request $request)
    // {
    //     $email = $request->email;
    //     Mail::send('mailForSubscribe', ['email' => $email], function ($message) use ($email){
    //         $message->to('info@infinitedryer.com', 'NFT News | Admin')->subject('NFT News Mail For Subscription Request.');
    //         $message->from($email,'NFT News');
    //     });
    //     return redirect()->back()->with('success', 'Email Has Been Sent Successfully');
    // }

    public function sendMail(Request $request)
    {
        // return view('welcome'); 
        $email = $request->email;
        Mail::to($email)->send(new subscribeMail($email));
        
        // Mail::to('desaipratik595@gmail.com')->send(new subscribeMail($email), ['email' => $email], function ($message) use ($email){
        //     $message->from('email');
        // });
       


        // Mail::to('info@infinitedryer.com', 'NFT News | Admin')->send(new subscribeMail(), ['email' => $email], function ($message) use ($email){$message->from('email','NFT News');
        // });
        return redirect()->back()->with('success', 'Email Has Been Sent Successfully');
    }
    
}
