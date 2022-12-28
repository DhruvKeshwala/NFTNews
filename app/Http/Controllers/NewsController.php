<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Author;
use App\Models\News;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $categories = Category::all();
        $authors     = Author::all();
        return view('news', compact('news','categories','authors'));
    }

    public function filterNews(Request $request)
    {
        $title      = $request->filterNewsTitle;
        $categoryId = $request->filterCategoryId;
        $authorId   = $request->filterAuthorId;
        
        $news       = News::where('title', 'LIKE', '%'.$title.'%')->where('categoryId', 'LIKE', '%'.$categoryId.'%')->where('authorId', 'LIKE', '%'.$authorId.'%')->orderby('id','desc')->paginate(10);
        foreach($news as $key=>$value)
        {
            $categories = Category::whereIn('id', explode(',',$value->categoryId))->pluck('name')->toArray();
            $value['category'] = implode(',',$categories);
        }
        $categories = Category::all();
        $authors    = Author::all();
        return view('news', compact('news','categories','authors'));
    }

    public function addNews($id=null)
    {
        $categories = Category::all();
        $authors    = Author::all();
        $news = NewsService::getNewsById($id);
        return view('add_news',compact('news','id','categories','authors'));
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
            'title'             => 'required',
            'categoryId'        => 'required',
            'authorId'          => 'required',
            'shortDescription'  => 'required',
            'fullDescription'   => 'required',
            'videoURL'          => 'required',
            'newsId'            => 'required',
        ]);
        
        $newsdetails = $request->only([
            'title',
            'shortDescription',
            'fullDescription',
            'videoURL',
            'categoryId',
            'authorId',
        ]);
        if($request->file('image') != null)
        {
            $file      = $request->file('image');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $newsdetails['image'] = $fileName;
        }
        if($request->file('article_1') != null)
        {
            $file      = $request->file('article_1');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $newsdetails['article_1'] = $fileName;
        }
        if($request->file('article_2') != null)
        {
            $file      = $request->file('article_2');
            $fileName = rand(11111,99999).time().'.'.$file->extension();       
            $name = $file->move(base_path('uploads'), $fileName);
            $newsdetails['article_2'] = $fileName;
        }
        $newsTypeDate = array();
        $start_date = explode(',',$request->start_date);
        $end_date = explode(',',$request->end_date);
        $newsArray = explode(',',$request->newstype);
        if(is_array($newsArray))
        {
            foreach($newsArray as $key=>$newstype)
            {
                $newsTypeDate[$newstype]['start_date'] = $start_date[$key];
                $newsTypeDate[$newstype]['end_date'] = $end_date[$key];
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
