<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Author;
use App\Models\PressRelease;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\PressReleaseService;
use Illuminate\Support\Str;

class PressReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pressRelease = PressReleaseService::getPressRelease();
        foreach($pressRelease as $key=>$value)
        {
            $categories = Category::whereIn('id', explode(',',$value->categoryId))->pluck('name')->toArray();
            $value['category'] = implode(',',$categories);
        }
        $categories  = Category::all();
        return view('pressRelease', compact('pressRelease', 'categories'));
    }
    public function addPressRelease($id=null)
    {
        $categories   = Category::all();
        // $authors      = Author::all();
        $pressRelease = PressReleaseService::getPressReleaseById($id);
        return view('add_pressRelease',compact('pressRelease','id','categories'));
    }
    public function pressReleaseDetail($id)
    {
        $pressRelease = PressReleaseService::getPressReleaseById($id);
        return view('pressRelease_detail',compact('pressRelease'));
    }
    public function savePressRelease(Request $request)
    {
        //validation
        $request->validate([
            'title'             => 'required',
            'categoryId'        => 'required',
            // 'authorId'          => 'required',
            'shortDescription'  => 'required',
            'fullDescription'   => 'required',
            'pressReleaseId'    => 'required',
            'metaTitle'         => 'required',
            'description'       => 'required',
            'keywords'          => 'required',
            'orderIndex'        => 'required',
        ]);
        
        $pressReleasedetails = $request->only([
            'title',
            'shortDescription',
            'fullDescription',
            'categoryId',
            'start_date',
            'end_date',
            'metaTitle',
            'description',
            'keywords',
            // 'authorId',
            'orderIndex',
        ]);
        if($request->file('image') != null)
        {
            $file      = $request->file('image');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $pressReleasedetails['image'] = $fileName;
        }
        if($request->file('article_1') != null)
        {
            $file      = $request->file('article_1');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $pressReleasedetails['article_1'] = $fileName;
        }
        if($request->file('uploadSocialBanner') != null)
        {
            $file      = $request->file('uploadSocialBanner');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $pressReleasedetails['uploadSocialBanner'] = $fileName;
        }
        // if($request->file('article_2') != null)
        // {
        //     $file      = $request->file('article_2');
        //     $fileName = rand(11111,99999).time().'.'.$file->extension();       
        //     $name = $file->move(base_path('uploads'), $fileName);
        //     $pressReleasedetails['article_2'] = $fileName;
        // }
        // $pressTypeDate = array();
        // $start_date = explode(',',$request->start_date);
        // $end_date = explode(',',$request->end_date);
        // $pressArray = explode(',',$request->presstype);
        // if(is_array($pressArray))
        // {
        //     foreach($pressArray as $key=>$presstype)
        //     {
        //         $pressTypeDate[$presstype]['start_date'] = $start_date[$key];
        //         $pressTypeDate[$presstype]['end_date'] = $end_date[$key];
        //     }
        // } 
        $pressReleasedetails['start_date'] = $request->start_date;
        $pressReleasedetails['end_date']   = $request->end_date;
        $pressReleasedetails['slug']       = Str::slug($request->title); //Adds slug for news
        // $pressReleasedetails['pressType'] = json_encode($pressTypeDate);
        $news = PressReleaseService::createPressRelease($pressReleasedetails,$request->pressReleaseId);
        return json_encode(['success'=>1,'message'=>'Press Release Detail Saved Successfully']);
    }
    public function deletePressRelease(Request $request)
    {
        $pressRelease = PressReleaseService::deletePressRelease($request->id);
        return json_encode(['success'=>1,'message'=>'Press Release has been deleted successfully']);
    }

    public function filterPressRelease(Request $request)
    {
        
        $title      = $request->filterPressTitle;
        $categoryId = $request->filterCategoryId;
        
        $pressRelease       = PressRelease::where('title', 'LIKE', '%'.$title.'%')->where('categoryId', 'LIKE', '%'.$categoryId.'%')->orderby('id','desc')->paginate(10);
        foreach($pressRelease as $key=>$value)
        {
            $categories = Category::whereIn('id', explode(',',$value->categoryId))->pluck('name')->toArray();
            $value['category'] = implode(',',$categories);
        }
        $categories = Category::all();
        return view('pressRelease', compact('pressRelease','categories'));
    }

    //active inactive
    public function pressUpdateStatus($id)
    {
        $data = PressRelease::where('id', $id)->first();
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
