<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Services\DropManagementService;
use App\Models\DropManagement;

class DropManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dropManagement = DropManagementService::getDropManagement();
        foreach($dropManagement as $key=>$value)
        {
            $categories = Category::whereIn('id', explode(',',$value->categoryId))->pluck('name')->toArray();
            $value['category'] = implode(',',$categories);
        }
        return view('dropManagement', compact('dropManagement'));
    }

    public function filterDropManagement(Request $request)
    {
        $name      = $request->filterDropName;
        $price     = $request->filterPriceOfSale;
        $blockChain = $request->filterBlockChain;
        $dropManagement         = DropManagement::where('name', 'LIKE', '%'.$name.'%')->where('blockChain', 'LIKE', '%'.$blockChain.'%')->where('priceOfSale', 'LIKE', '%'.$price.'%')->orderby('id','desc')->paginate(1);
        return view('dropManagement', compact('dropManagement'));
    }

    public function addDropManagement($id=null)
    {
        $categories = Category::all();
        $dropManagement = DropManagementService::getDropManagementById($id);
        return view('add_dropManagement',compact('dropManagement','id','categories'));
    }

    public function saveDropManagement(Request $request)
    {
        //validation
        $request->validate([
            'name'       => 'required',
            'categoryId' => 'required',
            'token'      => 'required',
            'blockChain' => 'required',
            'priceOfSale'=> 'required',
            'saleDate'   => 'required',
            'discordLink'=> 'required',
            'twitterLink'=> 'required',
            'websiteLink'=> 'required',

        ]);
        
        $dropManagementdetails = $request->only([
            'name',
            'token',
            'blockChain',
            'priceOfSale',
            'saleDate',
            'discordLink',
            'twitterLink',
            'websiteLink',
            'categoryId',
        ]);

        if($request->file('image') != null)
        {
            $file      = $request->file('image');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $dropManagementdetails['image'] = $fileName;
        }
        if($request->file('logo') != null)
        {
            $file      = $request->file('logo');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $dropManagementdetails['logo'] = $fileName;
        }
        // if($request->file('image') != null)
        // {
        //     $file      = $request->file('image');
        //     $fileName = rand(11111,99999).time().'.'.$file->extension();       
        //     $name = $file->move(public_path('uploads'), $fileName);
        //     $newsdetails['image'] = $fileName;
        // }
        // if($request->file('article_1') != null)
        // {
        //     $file      = $request->file('article_1');
        //     $fileName = rand(11111,99999).time().'.'.$file->extension();       
        //     $name = $file->move(public_path('uploads'), $fileName);
        //     $newsdetails['article_1'] = $fileName;
        // }
        // if($request->file('article_2') != null)
        // {
        //     $file      = $request->file('article_2');
        //     $fileName = rand(11111,99999).time().'.'.$file->extension();       
        //     $name = $file->move(public_path('uploads'), $fileName);
        //     $newsdetails['article_2'] = $fileName;
        // }
        // $newsTypeDate = array();
        // $start_date = explode(',',$request->start_date);
        // $end_date = explode(',',$request->end_date);
        // $newsArray = explode(',',$request->newstype);
        // if(is_array($newsArray))
        // {
        //     foreach($newsArray as $key=>$newstype)
        //     {
        //         $newsTypeDate[$newstype]['start_date'] = $start_date[$key];
        //         $newsTypeDate[$newstype]['end_date'] = $end_date[$key];
        //     }
        // }
        // $newsdetails['newsType'] = json_encode($newsTypeDate);
        $dropManagement = DropManagementService::createDropManagement($dropManagementdetails,$request->dropManagementId);
        return json_encode(['success'=>1,'message'=>'Drop Management has been Saved Successfully']);
    }
    public function deleteDropManagement(Request $request)
    {
        $dropManagement = DropManagementService::deleteDropManagement($request->id);
        return json_encode(['success'=>1,'message'=>'Drop Management has been deleted successfully']);
    }
}
