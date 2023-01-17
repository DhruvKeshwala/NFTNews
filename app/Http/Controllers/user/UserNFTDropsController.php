<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Services\DropManagementService;
use App\Models\DropManagement;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
        $banners = Banner::where('location', 'nftdropfull')->first();
        return view('user.listNFTDrops', compact('allDropManagement','categories','banners'));
    }
    public function filterNFTDrop(Request $request)
    {
        $categories = Category::all();
        $allDropManagement  = DropManagement::where(function($dm) {
            $request = app()->make('request');
            if($request->filternftcategoryValue == 'all' || $request->filterValue == 'all') {
                $dm->where('categoryId', '>', 0);
            }
            else if($request->filternftcategoryValue > 0) {
                $dm->where('categoryId', '=', $request->filternftcategoryValue);
            }
            if($request->nft_search != null && $request->nft_search != '') {
                $dm->where('name', 'like', '%'.$request->nft_search.'%');
            }
            if($request->filterValue == 'upcoming') {
                $dm->where('saleDate', '>' ,Carbon::now()->format('Y-m-d'));
            }
            if($request->filterValue == 'past') {
                $dm->where('saleDate', '<' ,Carbon::now()->format('Y-m-d'));
            }
            if($request->filterValue == 'mostPopular') {
                $dm->where('nftType', 'Featured');
            }
        })->orderby('id','desc')->paginate(10);
        $filterValue = $request->filternftcategoryValue;
        $nftsearch = $request->nft_search;
        $filterParam = $request->filterValue;
        $banners = Banner::where('location', 'nftdropfull')->first();
        return view('user.listNFTDrops', compact('filterParam', 'allDropManagement','categories','filterValue','nftsearch','banners'));
    }
    
    public function nftDropDetail($id)
    {
        $featuredDropManagement  = DropManagement::where('nftType', 'Featured')->orderby('id','desc')->get();
        $nftDropDetail      = DropManagementService::getNFTDropBySlug($id);
        return view('user.nftDropDetails',compact('nftDropDetail', 'featuredDropManagement'));
    }

    public function submitNFT()
    {
        $fourRandomDigit = mt_rand(1000,9999);
        return view('user.submitNFT', compact('fourRandomDigit'));
    }

    public function save_submitNFT(Request $request)
    {
        $fourDigitRandom = $request->fourDigitRandom;
        
        $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'location' => 'required',
                'phone'    => 'required|integer|digits_between:2,12',
                'skype'     => 'required',
                'projectName' => 'required',
                'twitterLink'   => 'required|url',
                'discordLink'   => 'required|url',
                'shortDescription'  => 'required',
                'websiteLink'   => 'required|url',
                'collectionName'    => 'required',
                'collectionItem'    => 'required|integer',
                //'contractAddress'   => 'required',
                'saleDate'          => 'required',
                'saleTime'          => 'required',
                'saleEndDate'       => 'required',
                'captcha'           => 'required',
                // 'metaData'      => 'required',
                //'priceOfSale'   => 'required',
                //'password' => 'required|min:5',
                //'email' => 'required|email|unique:users'
            ], [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'phone.integer' => 'The phone must be in digits',
                'saleDate.required' => 'The sale start date field is required.',
                'collectionItem.integer' => 'The Collection item only allow number',
                //'password.required' => 'Password is required'
            ]);
        
        $dropManagementdetails = $request->only([
            'name',
            'email',
            'location',
            'phone',
            'skype',
            'projectName',
            'shortDescription',
            'collectionName',
            'nftStatus',
            'collectionItem',
            'blockChain',
            'contractAddress',
            'metaData',
            'saleTime',
            'saleEndDate',
            'token',
            'blockChain',
            'priceOfSale',
            'saleDate',
            'discordLink',
            'twitterLink',
            'websiteLink',
            
        ]);
        
        
        
        
        // if($request->file('image') != null)
        // {
        //     $file      = $request->file('image');
        //     $fileName = rand(11111,99999).time().'.'.$file->extension();       
        //     $name = $file->move(base_path('uploads'), $fileName);
        //     $dropManagementdetails['image'] = $fileName;
        // }
        // if($request->file('image2') != null)
        // {
        //     $file      = $request->file('image2');
        //     $fileName = rand(11111,99999).time().'.'.$file->extension();       
        //     $name = $file->move(base_path('uploads'), $fileName);
        //     $dropManagementdetails['image2'] = $fileName;
        // }
        // if($request->file('logo') != null)
        // {
        //     $file      = $request->file('logo');
        //     $fileName = rand(11111,99999).time().'.'.$file->extension();       
        //     $name = $file->move(base_path('uploads'), $fileName);
        //     $dropManagementdetails['logo'] = $fileName;
        // }   
        $dropManagementdetails['slug']      = Str::slug($request->name); //Adds slug for news
        // $dropManagementdetails['image']     = 'default-image-1';
        // $dropManagementdetails['image2']    = 'default-image-2';
        // $dropManagementdetails['logo']      = 'default-logo';

        // if (!empty($request->start_date) && !empty($request->end_date)) {
        //     $dropManagementdetails['nftType']  = 'Featured';
        // }
        if($request->captcha == $fourDigitRandom)
        {
            $dropManagement = DropManagement::create($dropManagementdetails);
            return back()->with('success','NFT added successfully..');    
        } 
        else
        {
            return back()->with('error','Invalid Captcha..');
        }
    }
}
