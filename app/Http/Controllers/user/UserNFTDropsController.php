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
use App\Http\Controllers\user\HomeController;

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
        $allDropManagement  = DropManagement::orderby('orderIndex','asc')->paginate(9);
        $banners = Banner::where('location', 'nftdropfull')->first();
        return view('user.listNFTDrops', compact('allDropManagement','categories','banners'));
    }
    public function filterNFTDrop(Request $request)
    {
        $request->filternftcategoryValue = base64_decode($request->filternftcategoryValue);
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
        })->orderby('orderIndex','asc')->paginate(9);
        $filterValue = $request->filternftcategoryValue;
        $nftsearch = $request->nft_search;
        $filterParam = $request->filterValue;
        $banners = Banner::where('location', 'nftdropfull')->first();
        return view('user.listNFTDrops', compact('filterParam', 'allDropManagement','categories','filterValue','nftsearch','banners'));
    }
    
    public function nftDropDetail($id)
    {
        $featuredDropManagement  = DropManagement::where('nftType', 'Featured')->orderby('orderIndex','asc')->get();
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
            // $result = (new OtherController)->exampleFunction();
            $mail = (new HomeController)->mailData();

            //Mail Information
            //Recipients
            $mail->setFrom('nftnews@infinitedryer.com', 'NFTNews');
            $mail->addAddress($request->email, 'Your NFT Information Mail From ');     //Add a recipient
            
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is given below the information you added in your NFT Responses.';
            $mail->Body    = '
            <!DOCTYPE html>
            <html>
            <head>
            <style>
            table, th, td {
            border: 1px solid white;
            border-collapse: collapse;
            }
            th, td {
            background-color: #96D4D4;
            }
            </style>
            </head>
            <body>

            <h2>Table With Invisible Borders</h2>

            <p>Style the table with white borders and a background color of the cells to make the impression of invisible borders.</p>

            <table style="width:100%">
            <tr>
                <th>Name</th>
                <th>Value</th> 
            </tr>
            <tr>
                <td>Full Name</td>
                <td>'. $request->name . '</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>'. $request->email . '</td>
            </tr>
            <tr>
                <td>Location</td>
                <td>'. $request->location . '</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>'. $request->phone . '</td>
            </tr>
            <tr>
                <td>Skype</td>
                <td>'. $request->skype . '</td>
            </tr>
            <tr>
                <td>Project Name</td>
                <td>'. $request->projectName . '</td>
            </tr>
            <tr>
                <td>Short Description</td>
                <td>'. $request->shortDescription . '</td>
            </tr>
            <tr>
                <td>Collection Name</td>
                <td>'. $request->collectionName . '</td>
            </tr>
            <tr>
                <td>Contact Address</td>
                <td>'. $request->contractAddress . '</td>
            </tr>
            <tr>
                <td>Meta Data</td>
                <td>'. $request->metaData . '</td>
            </tr>
            <tr>
                <td>Start Sale Date</td>
                <td>'. $request->saleDate . '</td>
            </tr>
            <tr>
                <td>End Sale Date</td>
                <td>'. $request->saleEndDate . '</td>
            </tr>
            <tr>
                <td>Sale Time</td>
                <td>'. $request->saleTime . '</td>
            </tr>
            <tr>
                <td>Price</td>
                <td>'. $request->priceOfSale . '</td>
            </tr>
            <tr>
                <td>Discord Link</td>
                <td>'. $request->discordLink . '</td>
            </tr>
            <tr>
                <td>Twitter Link</td>
                <td>'. $request->twitterLink . '</td>
            </tr>
            <tr>
                <td>Website Link</td>
                <td>'. $request->websiteLink . '</td>
            </tr>
            </table>

            </body>
            </html>

            </body>
            </html>
            ';
            
            $mail->send();
        

            $dropManagementdetails['nftType']  = null;
            $dropManagement = DropManagement::create($dropManagementdetails);
            return back()->with('success','NFT information added successfully also a copy of your responses will be emailed to the address you provided..');    
        } 
        else
        {
            return back()->with('error','Invalid Captcha..');
        }
    }
}
