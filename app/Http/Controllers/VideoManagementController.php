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
        $categories = Category::all();
        $authors     = Author::all();
        return view('videos', compact('categories','authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addVideo($id=null)
    {
        $counter = 1;
        $items = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        foreach($items as $item) {
            echo $item;
            if($counter % 4 == 0 && $counter < count($items)) {
                echo "-break-";
            }
            if($counter % 5 == 0 && $counter < count($items)) {
                echo "--break--";
            }
            $counter++;
        }
        die;
        $categories = Category::all();
        $authors    = Author::all();
        $news = VideoService::getNewsById($id);
        return view('add_video',compact('news','id','categories','authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video_management  $video_management
     * @return \Illuminate\Http\Response
     */
    public function show(Video_management $video_management)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video_management  $video_management
     * @return \Illuminate\Http\Response
     */
    public function edit(Video_management $video_management)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video_management  $video_management
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video_management $video_management)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video_management  $video_management
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video_management $video_management)
    {
        //
    }
}
