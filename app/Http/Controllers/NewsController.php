<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Services\NewsService;

class NewsController extends Controller
{
    public function index()
    {
        $news = NewsService::getNews();
        foreach($news as $key=>$value)
        {
            $categories = Category::whereIn('id', explode(',',$value->categoryId))->pluck('name')->toArray();
            $value['category'] = implode(',',$categories);
        }
        return view('news', compact('news'));
    }
    public function addNews($id=null)
    {
        $categories = CategoryService::getCategory();
        $news = NewsService::getNewsById($id);
        return view('add_news',compact('news','id','categories'));
    }
    public function newsDetail($id)
    {
        $news = NewsService::getNewsById($id);
        return view('news_detail',compact('news'));
    }
    public function saveNews(Request $request)
    {
        //validation
        $request->validate([
            'title' => 'required',
            'categoryId' => 'required',
            'shortDescription' => 'required',
            'fullDescription' => 'required',
            'videoURL' => 'required',
            'newsId' => 'required',
        ]);
        
        $newsdetails = $request->only([
            'title',
            'shortDescription',
            'fullDescription',
            'videoURL',
            'categoryId',
        ]);
        if($request->file('image') != null)
        {
            $file      = $request->file('image');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(public_path('uploads'), $fileName);
            $newsdetails['image'] = $fileName;
        }
        $newsTypeDate = array();
        $dateArray = explode(',',$request->date);
        $newsArray = explode(',',$request->newstype);
        if(is_array($newsArray))
        {
            foreach($newsArray as $key=>$newstype)
            {
                $newsTypeDate[$newstype] = $dateArray[$key];
            }
        }
        $newsdetails['newsType'] = json_encode($newsTypeDate);
        $news = NewsService::createNews($newsdetails,$request->newsId);
        return json_encode(['success'=>1,'message'=>'News Detail Saved Successfully']);
    }
    public function deleteNews(Request $request)
    {
        $news = NewsService::deleteNews($request->id);
        return json_encode(['success'=>1,'message'=>'News has been deleted successfully']);
    }
}
