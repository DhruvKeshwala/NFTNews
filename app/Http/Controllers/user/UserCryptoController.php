<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CryptoJournal;
use App\Services\CryptoJournalService;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\Banner;

class UserCryptoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cryptoJournals   = CryptoJournal::orderby('id','desc')->paginate(10);
        return view('user.cryptoJournals', compact('cryptoJournals'));
    }

    public function cryptoDetail($id)
    {
        $banners             = Banner::where('size', '280 x 400 pixels')->first();
        $cryptoDetail        = CryptoJournalService::getCryptoBySlug($id);
        return view('user.cryptoDetails',compact('cryptoDetail', 'banners'));
    }

    public function filterCrypto(Request $request)
    {
        $cryptoJournals  = CryptoJournal::where(function($dm) {
            $request = app()->make('request');
            if($request->filternftcategoryValue == 'all' || $request->filterValue == 'all') {
                $dm->get();
            }
            // else if($request->filternftcategoryValue > 0) {
            //     $dm->where('categoryId', '=', $request->filternftcategoryValue);
            // }
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
        })->orderby('id','desc')->paginate(20);
        $filtercategoryId = $request->filternftcategoryValue;
        $search = $request->search;
        // return view('user.listNFTDrops', compact('allDropManagement','categories','filtercategoryId','nftsearch')); 
        $filterValue = $request->filterValue;
        return view('user.cryptoJournals', compact('cryptoJournals', 'search', 'filterValue'));
    }
}
