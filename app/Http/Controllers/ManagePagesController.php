<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ManagePages;
use App\Models\Subscribe;
use App\Models\Contact;
use App\Services\ManagePagesService;

class ManagePagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = ManagePagesService::getPages();
        return view('managePages', compact('pages'));
    }

    public function addPage($id=null)
    {
        $page  = ManagePagesService::getPageById($id);
        return view('add_page', compact('page', 'id'));
    }

    public function savePage(Request $request)
    {
        //validation
        $request->validate([
            'name'              => 'required',
            'title'             => 'required',
            'metaTitle'         => 'required',
            'description'       => 'required',
            'keywords'          => 'required',
            'contents'          => 'required',
            'selectTemplate'    => 'required',
        ]);

        $pagedetails = $request->only([
            'name',
            'title',
            'metaTitle',
            'description',
            'keywords',
            'contents',
            'selectTemplate',
            'image1_alt',
            'image2_alt',
            'social_banner_alt'
        ]);

        if($request->pageId != 0)
        {
            $request->except('name');
        }

        if($request->file('image1') != null)
        {
            $file      = $request->file('image1');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $pagedetails['image1'] = $fileName;
        }
        if($request->file('image2') != null)
        {
            $file      = $request->file('image2');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $pagedetails['image2'] = $fileName;
        }
        if($request->file('uploadSocialBanner') != null)
        {
            $file      = $request->file('uploadSocialBanner');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $pagedetails['uploadSocialBanner'] = $fileName;
        }
        if($request->pageId == 0)
        {
            $pagedetails['slug']     = Str::slug($request->name); //Adds slug for news
        }
        $page = ManagePagesService::createPage($pagedetails,$request->pageId);
        return json_encode(['success'=>1,'message'=>'New Page Details Saved Successfully']);
    }

    public function deletePage(Request $request)
    {
        $page = ManagePagesService::deletePage($request->id);
        return json_encode(['success'=>1,'message'=>'Page has been deleted successfully']);
    }

    public function pageDetail($id)
    {
        $page = ManagePagesService::getPageById($id);
        return view('page_detail',compact('page'));
    }

    public function subscribersList()
    {
        $data = Subscribe::paginate(10);
        return view('subscriberList', compact('data'));
    }

    public function contactList()
    {
        $data = Contact::paginate(10);
        return view('contactList', compact('data'));
    }
}
