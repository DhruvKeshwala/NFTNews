<?php

namespace App\Http\Controllers;

use App\Models\Video_management;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Author;
use App\Services\VideoService;

class VideoManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = VideoService::getVideos();
        foreach($videos as $key=>$value)
        {
            $categories = Category::whereIn('id', explode(',',$value->categoryId))->pluck('name')->toArray();
            $value['category'] = implode(',',$categories);
        }
        $categories = Category::all();
        // $authors     = Author::all();
        return view('videos', compact('videos', 'categories'));
    }

    public function filterVideo(Request $request)
    {
        $title      = $request->filterNewsTitle;
        $categoryId = $request->filterCategoryId;
        // $authorId   = $request->filterAuthorId;
        
        $videos     = Video_management::where('title', 'LIKE', '%'.$title.'%')->where('categoryId', 'LIKE', '%'.$categoryId.'%')->orderby('id','desc')->paginate(10);
        foreach($videos as $key=>$value)
        {
            $categories         = Category::whereIn('id', explode(',',$value->categoryId))->pluck('name')->toArray();
            $value['category']  = implode(',',$categories);
        }
        $categories = Category::all();
        // $authors    = Author::all();
        return view('videos', compact('videos','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addVideo($id=null)
    {   
        $categories = Category::all();
        // $authors    = Author::all();
        $news = VideoService::getNewsById($id);
        return view('add_video',compact('news','id','categories')); 
    }

     public function videoDetail($id)
    {
        $news = VideoService::getNewsById($id);
        return view('video_detail',compact('news'));
    }

    public function saveVideo(Request $request)
    {
        //validation
        $request->validate([
            'title'             => 'required',
            'categoryId'        => 'required',
            // 'authorId'          => 'required',
            'shortDescription'  => 'required',
            'fullDescription'   => 'required',
            'code'              => 'required',

        ]);
        
        $newsdetails = $request->only([
            'title',
            'shortDescription',
            'fullDescription',
            'code',
            'categoryId',
            // 'authorId',
        ]);
        if($request->file('image1') != null)
        {
            $file      = $request->file('image1');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $newsdetails['image1'] = $fileName;
        }
        if($request->file('image2') != null)
        {
            $file      = $request->file('image2');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $newsdetails['image2'] = $fileName;
        }

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
        $newsdetails['videoType']  = $request->videoType;
        $newsdetails['start_date'] = $request->start_date;
        $newsdetails['end_date']   = $request->end_date;
        
        $news = VideoService::createVideo($newsdetails,$request->newsId);
        return json_encode(['success'=>1,'message'=>'Video Saved Successfully']);
    }

    public function deleteVideo(Request $request)
    {
        $video = VideoService::deleteNews($request->id);
        return json_encode(['success'=>1,'message'=>'Video has been deleted successfully']);
    }

    //active inactive
    public function videoUpdateStatus($id)
    {
        $data = Video_management::where('id', $id)->first();
        if($data->fld_status == 'Active')
        {
            $data->fld_status = 'Inactive';
            $data->save();
        }
        else
        {
            $data->fld_status = 'Active';
            $data->save();
        }
        return redirect()->back();
    }
}
