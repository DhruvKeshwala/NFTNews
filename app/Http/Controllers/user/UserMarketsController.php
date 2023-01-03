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
        })->orderby('id','desc')->paginate(20);
        $filtercategoryId = $request->filternftcategoryValue;
        $search = $request->search;
        // return view('user.listNFTDrops', compact('allDropManagement','categories','filtercategoryId','nftsearch')); 
        $filterValue = $request->filterValue;
        return view('user.markets', compact('getAllNewses', 'categories', 'filtercategoryId', 'search', 'filterValue'));

    }

}
