<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Services\DropManagementService;
use App\Models\DropManagement;
use Illuminate\Support\Str;

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

        $dropManagement         = DropManagement::where('name', 'LIKE', '%'.$name.'%')->where('blockChain', 'LIKE', '%'.$blockChain.'%')->where('priceOfSale', 'LIKE', '%'.$price.'%')->orderby('id','desc')->paginate(10);
        foreach($dropManagement as $key=>$value)
        {
            $categories = Category::whereIn('id', explode(',',$value->categoryId))->pluck('name')->toArray();
            $value['category'] = implode(',',$categories);
        }
        $categories = Category::all();
        return view('dropManagement', compact('categories','dropManagement'));
    }

    public function addDropManagement($id=null)
    {
        $categories = Category::all();
        $dropManagement = DropManagementService::getDropManagementById($id);
        return view('add_dropManagement',compact('dropManagement','id','categories'));
    }

    public function saveDropManagement(Request $request)
    {
        // $previousId =  DropManagement::select('id')->latest()->get()->first();
        // $lastId     = $previousId->id;

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
            'metaTitle'  => 'required',
            'description'=> 'required',
            'keywords'   => 'required',
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
            'start_date',
            'end_date',
            'metaTitle',
            'description',
            'keywords',
            
        ]);

        if($request->file('image') != null)
        {
            $file      = $request->file('image');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $dropManagementdetails['image'] = $fileName;
        }
        if($request->file('image2') != null)
        {
            $file      = $request->file('image2');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $dropManagementdetails['image2'] = $fileName;
        }
        if($request->file('logo') != null)
        {
            $file      = $request->file('logo');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $dropManagementdetails['logo'] = $fileName;
        }        
        $dropManagementdetails['slug']     = Str::slug($request->name); //Adds slug for news
        if (!empty($request->start_date) && !empty($request->end_date)) {
            $dropManagementdetails['nftType']  = 'Featured';
        }
        
        $dropManagement = DropManagementService::createDropManagement($dropManagementdetails,$request->dropManagementId);
        return json_encode(['success'=>1,'message'=>'Drop Management has been Saved Successfully']);
    }
    public function dropManagementDetail($id)
    {
        $dropManagement = DropManagementService::getDropManagementById($id);
        return view('dropManagement_detail',compact('dropManagement'));
    }
    public function deleteDropManagement(Request $request)
    {
        $dropManagement = DropManagementService::deleteDropManagement($request->id);
        return json_encode(['success'=>1,'message'=>'Drop Management has been deleted successfully']);
    }
}
