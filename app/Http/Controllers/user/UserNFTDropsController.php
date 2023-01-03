<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DropManagementService;
use App\Models\DropManagement;
use App\Models\Category;
use Carbon\Carbon;

class UserNFTDropsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function listNFTDrop()
    {
        $categories = Category::all();
        $allDropManagement  = DropManagement::orderby('id','desc')->paginate(10);
        return view('user.listNFTDrops', compact('allDropManagement','categories'));
    }
    public function filterNFTDrop(Request $request)
    {
        // dd(Carbon::now()->format('Y-m-d'));
        $categories = Category::all();
        $allDropManagement  = DropManagement::where(function($dm) {
            $request = app()->make('request');
            if($request->filternftcategoryValue == 'all') {
                $dm->where('categoryId', '>', 0);
            }
            else if($request->filternftcategoryValue > 0) {
                $dm->where('categoryId', '=', $request->filternftcategoryValue);
            }
            if($request->nft_search != null && $request->nft_search != '') {
                $dm->where('name', 'like', '%'.$request->nft_search.'%');
            }
            if($request->filterValue == 'upcoming') {
                $dm->where('saleDate', '>' ,Carbon::now()->format('Y-m-d'))->get();
            }
            if($request->filterValue == 'past') {
                $dm->where('saleDate', '<' ,Carbon::now()->format('Y-m-d'))->get();
            }
        })->orderby('id','desc')->paginate(10);
        $filterValue = $request->filternftcategoryValue;
        $nftsearch = $request->nft_search;
        return view('user.listNFTDrops', compact('allDropManagement','categories','filterValue','nftsearch'));
    }
    
    public function nftDropDetail($id)
    {
        $nftDropDetail = DropManagementService::getNFTDropBySlug($id);
        return view('user.nftDropDetails',compact('nftDropDetail'));
    }

    public function submitNFT()
    {
        return view('user.submitNFT');
    }

    public function save_submitNFT(Request $request)
    {
        return $request->all();
    }
}
