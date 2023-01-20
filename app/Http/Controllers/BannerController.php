<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Services\BannerService;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BannerService::get();
        return view('banner', compact('data'));
    }

    public function filterBanner(Request $request)
    {
        $location = $request->location;
        //$locations = BannerService::getById($id);
        $size       = $request->filterSize;
        $data       = Banner::where('size', 'LIKE', '%'.$size.'%')->where('location', 'LIKE', '%'.$location.'%')->orderby('id','desc')->paginate(10);
        return view('banner', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=null)
    {
        $data = BannerService::getById($id);
        return view('add_banner',compact('data','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'size'     => 'required',
            'url'      => 'required',
            'location'      => 'required',
            // 'image'    => 'required',
            'bannerId' => 'required',
        ]);
        
        $request->only([
            'size',
            'url',
            'image',
            'location',
            'banner_image_alt'
        ]);
        if($request->file('image') != null)
        {
            $file      = $request->file('image');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads/banner/'), $fileName);
            $data['image'] = $fileName;
        }

        $data['size'] =  $request->size;
        $data['url'] = $request->url;
        $data['location'] = $request->location;
        $data['banner_image_alt'] = $request->banner_image_alt;
        // $data['authorId'] = $request->authorId; 
        $result = BannerService::createUpdate($data,$request->bannerId);
        return json_encode(['success'=>1,'message'=>'Banner Saved Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = BannerService::delete($request->id);
        return json_encode(['success'=>1,'message'=>'Banner has been deleted successfully']);
    }
}
