<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NewsService;
use App\Models\News;

class UserNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allNews = NewsService::getNews();
        return view('user.news', compact('allNews'));
    }

    public function filterNews(Request $request)
    {
        $title      = $request->filterNewsTitle;
        $allNews    = News::where('title', 'LIKE', '%'.$title.'%')->orderby('id','desc')->paginate(2);
        return view('user.news', compact('allNews'));
    }

    public function newsDetail($id)
    {
        $newsDetail = NewsService::getNewsById(base64_decode($id));
        return view('user.newsDetails',compact('newsDetail'));
    }
}
