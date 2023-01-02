<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;
use App\Services\GuideService;
use Illuminate\Support\Str;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guide = GuideService::getGuide();        
        return view('guide', compact('guide'));
    }

    public function addGuide($id=null)
    {
        $guide = GuideService::getGuideById($id);
        return view('add_guide',compact('guide','id'));
    }

    public function saveGuide(Request $request)
    {
        //validation
        $request->validate([
            'category'        => 'required',
            'question'  => 'required',
            'answer'   => 'required',
        ]);
        
        $guidedetails = $request->only([
            'category',
            'question',
            'answer',
        ]);
        $guidedetails['slug']     = Str::slug($request->question); //Adds slug for guide
        $news = GuideService::createGuide($guidedetails,$request->guideId);
        return json_encode(['success'=>1,'message'=>'News Detail Saved Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function show(Guide $guide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function edit(Guide $guide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guide $guide)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guide $guide)
    {
        //
    }
}
