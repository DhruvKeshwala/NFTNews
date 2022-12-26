<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NewsService;
use App\Models\Category;
use App\Models\News;
use App\Services\PressReleaseService;
use App\Services\DropManagementService;
use Illuminate\Support\Facades\Response;
use View, DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allNews            = News::take(10)->get();
        $categories         = Category::all();
        $pressReleases      = PressReleaseService::getPressRelease();
        $allDropManagement  = DropManagementService::getLatestDropManagement();
        return view('user.index', compact('allNews', 'categories', 'pressReleases', 'allDropManagement'));
    }

    public function userFilterCategory(Request $request)
    {
        $categoryId = $request->categoryId;
        if($categoryId == 0)
        {
            $allNews    =  News::take(10)->get();
        }
        else
        {
            $allNews    =  News::where('categoryId', $categoryId)->get();
        }
        
        $contents = View::make('user.newsDisplay')->with('allNews', $allNews);
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'text/plain');
        return $response;
    }

    function load_data(Request $request)
    {
     if($request->ajax())
     {
      if($request->id > 0)
      {
       $data = DB::table('drop_management')
          ->where('id', '<', $request->id)
          ->orderBy('id', 'DESC')
          ->limit(5)
          ->get();
      }
      else
      {
       $data = DB::table('drop_management')
          ->orderBy('id', 'DESC')
          ->limit(5)
          ->get();
      }
        $contents = View::make('user.NFTDropDisplay')->with('data', $data);
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'text/plain');
        return $response;
    //   $output = '';
    //   $last_id = '';
      
    //   if(!$data->isEmpty())
    //   {
    //    foreach($data as $dropManagement)
    //    {
    //     $output .= '
    //     <tr>
    //         <td><img src="/NFTNews/uploads/' . @$dropManagement->logo . '" class="rounded-pill" width="34" height="34" alt="" /></td>
    //         <td>' . @$dropManagement->name . '</td>
    //             <td>' . @$dropManagement->token . '</td>
    //             <td><strong>' . @$dropManagement->blockChain . '</strong></td>
    //             <td>' . @$dropManagement->priceOfSale . '</td>
    //             <td>' . @$dropManagement->saleDate . '</td>
    //             <td><a href="' . @$dropManagement->twitterLink . '" target="_blank"><i class="fa fa-twitter mr-3"></i> <a href="' . @$dropManagement->discordLink . '" target="_blank"><i class="fa fa-github-alt" aria-hidden="true"></i></a></td>
    //     </tr>
    //     ';
    //     $last_id = $dropManagement->id;
    //    }
    //    $output .= '
    //    <div id="load_more">
    //    <button name="load_more_button" class="btn d-block btn-outline-light py-2 mt-4 form-control" data-id="'.$last_id.'" id="load_more_button">View More NFT Drops</button>
    //    </div>';
    //   }
    //   else
    //   {
    //    $output .= '
    //    <div id="load_more">
    //     <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
    //    </div>';
    //   }
    //   echo $output;
     }
    }
}
