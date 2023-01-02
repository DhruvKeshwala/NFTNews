<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guide;

class UserGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $gettingStarted = Guide::where('category', 'GETTING STARTED')->get();
        // $buying         = Guide::where('category', 'BUYING')->get();
        
        return view('user.guide');
    }

    public function guideList($id=null,$slug=null)
    {
        if($id != null && $slug == null)
        {
            if($id == 'getting-started'){
                $guides = Guide::where('category', 'GETTING STARTED')->get(); 
            }
            elseif($id=='buying')
            {
                $guides = Guide::where('category', 'BUYING')->get();
            }
            elseif($id=='selling')
            {
               $guides = Guide::where('category', 'SELLING')->get();
            }
            elseif($id=='creating')
            {
                $guides = Guide::where('category', 'CREATING')->get();
            }
            elseif($id=='policies')
            {
                $guides = Guide::where('category', 'POLICIES')->get();
            }
            elseif($id=='faqs')
            {
                $guides = Guide::where('category', 'FAQS')->get();
            }
            elseif($id=='userSafety')
            {
                $guides = Guide::where('category', 'USER SAFETY')->get();
            }
            elseif($id=='developers')
            {
                $guides = Guide::where('category', 'DEVELOPERS')->get();
            }
            elseif($id=='solana')
            {
                $guides = Guide::where('category', 'SOLANA')->get();
            }
            $this->guideView($guides[0]->slug);
            return view('user.guideDetails', compact('guides'));
            
    }
    // else
    // {

        // $singleGuide = Guide::where('slug', $slug)->first();
        // $guides = Guide::all();
        // return view('user.guideDetails', compact('singleGuide', 'guides'));
    // }
        
        
        
    }

    public function guideView($guides)
    {
        $singleGuide = Guide::where('slug', $guides)->first();
        return view('user.guideDetails', compact('singleGuide'));
    }
}
