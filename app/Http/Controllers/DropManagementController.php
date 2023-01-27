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

    public function addDropManagement($id=null, $type=null)
    {
        if($type=='User')
        {
            $dropManagement = DropManagementService::getDropManagementById($id);
            return view('edit_userDropManagement',compact('dropManagement','id'));
        }
        else
        {
            $categories = Category::all();
            $dropManagement = DropManagementService::getDropManagementById($id);
            return view('add_dropManagement',compact('dropManagement','id','categories'));
        }
    }

    public function saveUserDropManagement(Request $request)
    {
        $dropManagementdetails = $request->only([
            'name',
            'email',
            'location',
            'phone',
            'skype',
            'projectName',
            'twitterLink',
            'discordLink',
            'shortDescription',
            'websiteLink',
            'collectionName',
            //'nftStatus',
            //'collectionItem',
            'blockChain',
            'contractAddress',
            'token',
            'metaData',
            'saleDate',
            'saleEndDate',
            'priceOfSale'
        ]);

        $dropManagementdetails['userType'] = 'User';
        $dropManagement = DropManagementService::createDropManagement($dropManagementdetails,$request->dropManagementId);
        return json_encode(['success'=>1,'message'=>'Drop Management has been Saved Successfully']);

    }
    public function saveDropManagement(Request $request)
    {
        // $previousId =  DropManagement::select('id')->latest()->get()->first();
        // $lastId     = $previousId->id;

        //validation
        // $request->validate([
        //         'name' => 'required',
        //         'email' => 'required|email',
        //         'location' => 'required',
        //         'phone'    => 'required|integer|digits_between:2,12',
        //         'skype'     => 'required',
        //         'projectName' => 'required',
        //         'twitterLink'   => 'required|url',
        //         'discordLink'   => 'required|url',
        //         'shortDescription'  => 'required',
        //         'websiteLink'   => 'required|url',
        //         'collectionName'    => 'required',
        //         'collectionItem'    => 'required|integer',
        //         //'contractAddress'   => 'required',
        //         'saleDate'          => 'required',
        //         'saleTime'          => 'required',
        //         'saleEndDate'       => 'required',
        //         'captcha'           => 'required',
        //         // 'metaData'      => 'required',
        //         //'priceOfSale'   => 'required',
        //         //'password' => 'required|min:5',
        //         //'email' => 'required|email|unique:users'
        //     ], [
        //         'name.required' => 'Name is required',
        //         'email.required' => 'Email is required',
        //         'phone.integer' => 'The phone must be in digits',
        //         'saleDate.required' => 'The sale start date field is required.',
        //         'collectionItem.integer' => 'The Collection item only allow number',
        //         //'password.required' => 'Password is required'
        //     ]);


        
        $dropManagementdetails = $request->only([
            'name',
            'slug',
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
            'orderIndex',
            'image1_alt',
            'image2_alt',
            'image3_alt',
            'social_banner_alt'
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
        if($request->file('uploadSocialBanner') != null)
        {
            $file      = $request->file('uploadSocialBanner');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $dropManagementdetails['uploadSocialBanner'] = $fileName;
        }    
        //$dropManagementdetails['slug']     = Str::slug($request->name); //Adds slug for news
        if (!empty($request->start_date) && !empty($request->end_date)) {
            $dropManagementdetails['nftType']  = 'Featured';
        }

        if($request->dropManagementId != 0 || $request->dropManagementId != null)
        {
            if($request->start_date == null || $request->end_date == null)
            {
                $dropManagementdetails['nftType'] = null;
            }
        }
        
        $dropManagementdetails['userType'] = 'Admin';
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
