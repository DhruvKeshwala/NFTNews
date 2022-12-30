<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DropManagementService;
use App\Models\DropManagement;

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
        $allDropManagement  = DropManagement::orderby('id','desc')->paginate(10);
        return view('user.listNFTDrops', compact('allDropManagement'));
    }
    
    public function nftDropDetail($id)
    {
        $nftDropDetail = DropManagementService::getNFTDropBySlug($id);
        return view('user.nftDropDetails',compact('nftDropDetail'));
    }
}
