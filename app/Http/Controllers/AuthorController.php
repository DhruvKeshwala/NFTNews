<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AuthorService::get();
        return view('author', compact('data'));
    }

    public function filterAuthor(Request $request)
    {
        $name       = $request->filterAuthorName;
        $email      = $request->filterEmail;
        $mobile     = $request->filterMobile;
        $data       = Author::where('name', 'LIKE', '%'.$name.'%')->where('email', 'LIKE', '%'.$email.'%')->where('mobile', 'LIKE', '%'.$mobile.'%')->orderby('id','desc')->paginate(10);
        return view('author', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=null)
    {
        $data = AuthorService::getById($id);
        return view('add_author',compact('data','id'));
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
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'mobile' => 'required',
        //     'shortBio' => 'required',
        //     'authorId' => 'required',
        //     'twitterLink'=> 'required',
        //     'linkedInLink'=> 'required',
        // ]);
        
        $request->only([
            'name',
            'email',
            'mobile',
            'shortBio',
            'twitterLink',
            'linkedInLink',
        ]);
        if($request->file('image') != null)
        {
            $file      = $request->file('image');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $data['image'] = $fileName;
        }

        $data['name'] =  $request->name;
        $data['email'] = $request->email;
        $data['mobile'] = $request->mobile;
        $data['short_bio'] = $request->shortBio;
        $data['twitterLink'] = $request->twitterLink;
        $data['linkedInLink'] = $request->linkedInLink;

        // $data['authorId'] = $request->authorId;
        $result = AuthorService::createUpdate($data,$request->authorId);
        return json_encode(['success'=>1,'message'=>'Author Saved Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = AuthorService::delete($request->id);
        return json_encode(['success'=>1,'message'=>'Author has been deleted successfully']);
    }
}
