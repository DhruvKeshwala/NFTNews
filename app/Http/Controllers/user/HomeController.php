<?php

namespace App\Http\Controllers\user;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NewsService;
use App\Models\Category;
use App\Models\News;
use App\Models\Guide;
use App\Models\Banner;
use App\Models\PressRelease;
use App\Models\DropManagement;
use App\Services\PressReleaseService;
use App\Services\DropManagementService;
use App\Models\Video_management;
use App\Models\CryptoJournal;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

use App\Models\ManagePages;
use App\Models\Subscribe;
use App\Models\Contact;
use App\Services\ManagePagesService;

use View, DB, Mail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newses          = News::orderBy('id', 'DESC')->get();
        $currentDate = date('d-m-Y');
        $result = array();
        $resultHomeNews     = array();
        $resultFeaturedDrop = array();
        $resultFeaturedNews = array();

        $featured_news = array();
        $i = 0;
        foreach($newses as $key => $news)
        {
            $result[$key] = $news;
            $result[$key]->news_type = $newsType = json_decode($news->newsType);
            if ($newsType->homeheader && $newsType->homeheader->start_date <= $currentDate && $newsType->homeheader->end_date >= $currentDate) {
                $result[$key]->is_homeheader = 1;
                $result[$key]->homeheader_start_date = $newsType->homeheader->start_date;
                $result[$key]->homeheader_end_date = $newsType->homeheader->end_date;
            }

            if ($newsType->homenews && $newsType->homenews->start_date <= $currentDate && $newsType->homenews->end_date >= $currentDate) 
            {
                $featured_news[$i] = $news;
                $featured_news[$i]->is_homenews = $result[$key]->is_homeheader = 1;
                $featured_news[$i]->homeheader_start_date = $result[$key]->homeheader_start_date = $newsType->homeheader->start_date;
                $featured_news[$i]->homeheader_end_date = $result[$key]->homeheader_end_date = $newsType->homeheader->end_date;
                $i++;
            }
            $resultFeaturedDrop[$key] = $news;
            $resultFeaturedDrop[$key]->news_type = $newsType = json_decode($news->newsType);
            if ($newsType->featureddrop && $newsType->featureddrop->start_date <= $currentDate && $newsType->featureddrop->end_date >= $currentDate) {
                $resultFeaturedDrop[$key]->is_featuredDrop = 1;
                $resultFeaturedDrop[$key]->featureddrop_start_date = $newsType->featureddrop->start_date;
                $resultFeaturedDrop[$key]->featureddrop_end_date = $newsType->featureddrop->end_date;  
            }

            $resultFeaturedNews[$key] = $news;
            $resultFeaturedNews[$key]->news_type = $newsType = json_decode($news->newsType);
            if ($newsType->featurednew && $newsType->featurednew->start_date <= $currentDate && $newsType->featurednew->end_date >= $currentDate) {
                $resultFeaturedNews[$key]->is_featurednew = 1;
                $resultFeaturedNews[$key]->featurednew_start_date = $newsType->featurednew->start_date;
                $resultFeaturedNews[$key]->featurednew_end_date = $newsType->featurednew->end_date;                
            }
        }

        $cryptoJournals      = CryptoJournal::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('fld_status', 'Active')->orderby('id','desc')->first();
        $pages               = ManagePages::all();
        $allNews             = News::take(10)->orderBy('orderIndex', 'asc')->get();
        $categories          = Category::all();
        $pressReleases       = PressRelease::orderBy('orderIndex', 'asc')->get();
        $allDropManagement   = DropManagementService::getLatestDropManagement();
        $getAllNewses        = News::orderBy('orderIndex', 'asc')->get();
        $videos              = Video_management::where('fld_status', 'Active')->where('videoType', 'Featured Video')->orderby('orderIndex','asc')->get();
        $guides              = Guide::all();
        $banners_small = Banner::where('location', 'hpmarnewsrect')->get()->toArray();
        $banners_horizontal = Banner::where('location', 'hpmarnewsfull')->get()->toArray();
        $settings = DB::table('settings')->where('id', 1)->first();

        $homeTopBanner = Banner::where('location', 'hplatnewsfull')->first();
        $homeSideBanner = Banner::where('location', 'hplatnewsrect')->first();

        return view('user.index', compact('homeSideBanner', 'homeTopBanner', 'cryptoJournals', 'settings', 'pages','videos', 'getAllNewses', 'result', 'featured_news', 'resultFeaturedDrop', 'resultFeaturedNews', 'allNews', 'categories', 'pressReleases', 'allDropManagement', 'guides', 'banners_small','banners_horizontal'));
    }

    public function userFilterVideos(Request $request)
    {
        $categoryId = $request->categoryId;
        if($categoryId == 0)
        {
            $videos    =  Video_management::take(10)->orderBy('orderIndex', 'asc')->get();
        }
        else
        {
            $videos    =  Video_management::where('categoryId', $categoryId)->orderBy('orderIndex', 'asc')->get();
        }
        
        $contents = View::make('user.videosDisplay')->with('videos', $videos);
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'text/plain');
        return $response;
    }

    public function userFilterCategoryNews($categoryId='')
    {
        $newses  = $getAllNewses  = News::orderBy('orderIndex', 'asc')->get();

        $currentDate = date('d-m-Y');
        $resultFeaturedNews = array();

        foreach($newses as $key => $news)
        {
            $resultFeaturedNews[$key] = $news;
            $resultFeaturedNews[$key]->news_type = $newsType = json_decode($news->newsType);
            if ($newsType->featurednew && $newsType->featurednew->start_date <= $currentDate && $newsType->featurednew->end_date >= $currentDate) 
            {
                $resultFeaturedNews[$key]->is_featurednew = 1;
                $resultFeaturedNews[$key]->featurednew_start_date = $newsType->featurednew->start_date;
                $resultFeaturedNews[$key]->featurednew_end_date = $newsType->featurednew->end_date;                
            }  
        }

        // $categoryId = $request->categoryId;
        $categories     = Category::all();
        $innerSideBanner = Banner::where('location', 'innerrec')->first();
        $newsTopBanner = Banner::where('location', 'latnewsfull')->first();

        $banners_small = Banner::where('location', 'hpmarnewsrect')->get()->toArray();
        $banners_horizontal = Banner::where('location', 'hpmarnewsfull')->get()->toArray();

        if($categoryId == 'All' || $categoryId == null || $categoryId == '')
        {
            $allNews    =  News::orderBy('orderIndex', 'asc')->paginate(10);
        }
        else
        {
            $getCategoryId = Category::select('id')->where('slug', $categoryId)->first();
            if($getCategoryId)
                $allNews    =  News::where('categoryId', $getCategoryId->id)->orderBy('orderIndex', 'asc')->paginate(10);
            else
                return redirect('userFilterCategory/All');
        }
        return view('user.news', compact('banners_small', 'banners_horizontal', 'newsTopBanner', 'innerSideBanner','getAllNewses', 'allNews', 'categories', 'resultFeaturedNews'));
        
        // $contents = View::make('user.newsDisplay')->with('allNews', $allNews);
        // $response = Response::make($contents, 200);
        // $response->header('Content-Type', 'text/plain');
        // return $response;
    }

    public function userFilterCategory(Request $request)
    {
        $categoryId = $request->categoryId;
        if($categoryId == 0)
        {
            $allNews    =  News::take(10)->orderBy('orderIndex', 'asc')->get();
        }
        else
        {
            $allNews    =  News::where('categoryId', $categoryId)->orderBy('orderIndex', 'asc')->paginate(10);
        }
        
        $contents = View::make('user.newsDisplay')->with('allNews', $allNews);
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'text/plain');
        return $response;
    }
    
    public function userFilterNFTDrops(Request $request)
    {
        $getAllNewses        = News::all();
        $categoryId = $request->categoryId;
        if($categoryId == 0)
        {
            $allDropManagement    =  DropManagement::orderBy('orderIndex', 'asc')->get();
        }
        else
        {
            $allDropManagement    =  DropManagement::where('categoryId', $categoryId)->orderBy('orderIndex', 'asc')->get();
        }
        
        $contents = View::make('user.NFTDropDisplay')->with('allDropManagement', $allDropManagement);
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'text/plain');
        return $response;
    }

    public function advertise()
    {
        $page = ManagePages::where('slug', 'advertise')->first();
        if(@$page == null)
        {
            $page = 'No Advertise Information Available..';
        }
        $advertiseTopBanner = Banner::where('location', 'advertisefull')->first();
        return view('user.advertise', compact('page','advertiseTopBanner'));
    }

    public function contact()
    {
        $fourRandomDigit = mt_rand(1000,9999);
        $contactTopBanner = Banner::where('location', 'contactfull')->first();
        return view('user.contact', compact('fourRandomDigit', 'contactTopBanner'));
    }
    public function sendMailForContact(Request $request)
    {
        $contactDetails = $request->only([
            'name',
            'email',
            'phone',
            'org',
            'loc',
            'nmeproj',
            'enquire_nature',
            'message',
            'captcha',
            'fourDigitRandom',
        ]);

        $validatedData = $request->validate([
            'name'           => 'required',
            'email'          => 'required|email',
            'phone'          => 'required',
            'enquire_nature' => 'required',
            'message'        => 'required',
            'captcha'        => 'required',
            //'email' => 'required|email|unique:users'
        ], [
            'name.required'             => 'Name is required',
            'email.required'            => 'Email is required',
            'phone.required'            => 'Phone is required',
            'enquire_nature.required'   => 'Enquiry Information is required',
            'message.required'          => 'Message is required',
            'captcha.required'          => 'Captcha is required',
        ]);

        if($request->captcha == $request->fourDigitRandom)
        {
            $mail = $this->mailData();

           //Mail Information
            //Recipients
            $mail->setFrom($request->email, 'Contact Information Mail From' . $request->name);
            $mail->addAddress('nftnews@infinitedryer.com', 'NFTNews');     //Add a recipient
            
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Contact Request Mail From User" . $request->email;
            $mail->Body    = 'Hello, This is mail from user for the contact to our admin here is give below the information of the user:<br>
            <!DOCTYPE html>
            <html>
            <head>
            <style>
            table, th, td {
            border: 1px solid white;
            border-collapse: collapse;
            }
            th, td {
            background-color: #96D4D4;
            }
            </style>
            </head>
            <body>

            <h2>User Contact Information</h2>

            <table style="width:100%">
            <tr>
                <th>Name</th>
                <th>Value</th> 
            </tr>
            <tr>
                <td>Full Name</td>
                <td>'. $request->name . '</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>'. $request->email . '</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>'. $request->phone . '</td>
            </tr>
            <tr>
                <td>Enquiry Nature</td>
                <td>'. $request->enquire_nature . '</td>
            </tr>
            <tr>
                <td>Message</td>
                <td>'. $request->message . '</td>
            </tr>
            </table>
            </body>
            </html>
            <br><br> <b>-Regards</b>';
            
            $mail->send();

            Contact::create($contactDetails);
            return redirect()->back()->with('success', 'Contact Information Submitted Successfully also Mail Has Been Sent Successfully To Our Admin We will Reach You Soon.');
        }
        else
        {
            return redirect()->back()->with('error', 'Invalid Captcha.');
        }
    }
    
    public function education()
    {
        $page = ManagePages::where('slug', 'education')->first();
        if(@$page == null)
        {
            $page = 'No Education Information available..';
        }
        $educationTopBanner = Banner::where('location', 'edufull')->first();
        return view('user.education', compact('page', 'educationTopBanner'));
    }

    public function services()
    {
        $page = ManagePages::where('slug', 'services')->first();
        if(@$page == null)
        {
            $page = 'No Services Information available..';
        }
        $serviceTopBanner = Banner::where('location', 'servicesfull')->first();
        return view('user.services', compact('serviceTopBanner', 'page'));
    }

    public function partners()
    {
        $page = ManagePages::where('slug', 'partners')->first();
        if(@$page == null)
        {
            $page = 'No Partners Information available..';
        }
        $partnerTopBanner = Banner::where('location', 'partnerfull')->first();
        return view('user.partners', compact('page', 'partnerTopBanner'));
    }

    public function privacyPolicy()
    {
        $page = ManagePages::where('slug', 'privacy-policy')->first();
        $banners = Banner::where('location', 'pripolfull')->first();
        if(@$page == null)
        {
            $page = 'No Privacy Policy Information available..';
        }
        return view('user.privacyPolicy', compact('page','banners'));
    }

    public function termsAndConditions()
    {
        $page = ManagePages::where('slug', 'terms-and-conditions')->first();
        $banners = Banner::where('location', 'termsfull')->first();
        if(@$page == null)
        {
            $page = 'No Terms And Conditions Information available..';
        }
        return view('user.termsAndConditions', compact('page','banners'));
    }

    public function gdpr()
    {
        $page = ManagePages::where('slug', 'gdpr')->first();
        if(@$page == null)
        {
            $page = 'No GDPR Information available..';
        }
        return view('user.gdpr', compact('page'));
    }

    public function termsOfService()
    {
        $page = ManagePages::where('slug', 'terms-of-service')->first();
        $banners = Banner::where('location', 'terserfull')->first();
        if(@$page == null)
        {
            $page = 'No Terms Of Service Information available..';
        }
        return view('user.termsOfService', compact('page','banners'));
    }

    public function investmentAndFunding()
    {
        $page = ManagePages::where('slug', 'investment-and-funding')->first();
        $banners = Banner::where('location', 'invfunfull')->first();
        if(@$page == null)
        {
            $page = 'No Investment & Funding Information available..';
        }
        return view('user.investmentAndFunding', compact('page','banners'));
    }

    public function mediaEnquiries()
    {
        $page = ManagePages::where('slug', 'media-enquiries')->first();
        $banners = Banner::where('location', 'medenqfull')->first();
        if(@$page == null)
        {
            $page = 'No Media Enquiries Information available..';
        }
        return view('user.mediaEnquiries', compact('page','banners'));
    }

    public function careers()
    {
        $page = ManagePages::where('slug', 'careers')->first();
        $banners = Banner::where('location', 'careerfull')->first();
        if(@$page == null)
        {
            $page = 'No Careers Information available..';
        }
        return view('user.careers', compact('page','banners'));
    }

    public function about()
    {
        $page = ManagePages::where('slug', 'about')->first();
        $banners = Banner::where('location', 'aboutfull')->first();
        if(@$page == null)
        {
            $page = 'No About Page Information available..';
        }
        return view('user.about', compact('page','banners'));
    }

    public function featuredNews()
    {
        $newses          = News::orderBy('orderIndex', 'asc')->get();

        $currentDate = date('d-m-Y');
        $resultFeaturedNews = array();
        $resultFeaturedNews2 = array();
        foreach($newses as $key => $news)
        {
            
            $resultFeaturedNews[$key] = $news;
            $resultFeaturedNews[$key]->news_type = $newsType = json_decode($news->newsType);
            if ($newsType->featurednew && $newsType->featurednew->start_date <= $currentDate && $newsType->featurednew->end_date >= $currentDate) 
            {
                $resultFeaturedNews[$key]->is_featurednew = 1;
                $resultFeaturedNews[$key]->featurednew_start_date = $newsType->featurednew->start_date;
                $resultFeaturedNews[$key]->featurednew_end_date = $newsType->featurednew->end_date;                
            }  
        }

        $resultFeaturedNews2 = $resultFeaturedNews;
        $getAllNewses   = News::orderBy('orderIndex', 'asc')->get();
        $banners_small = Banner::where('location', 'hpmarnewsrect')->get()->toArray();
        $banners_horizontal = Banner::where('location', 'hpmarnewsfull')->get()->toArray();

        return view('user.featuredNews', compact('banners_small', 'banners_horizontal', 'getAllNewses', 'resultFeaturedNews', 'resultFeaturedNews2'));
    }

    public function filterFeaturedNews(Request $request)
    {
        $newses          = News::orderBy('orderIndex', 'asc')->paginate(1);

        $currentDate = date('d-m-Y');
        $resultFeaturedNews2 = array();
        foreach($newses as $key => $news)
        {
            $resultFeaturedNews2[$key] = $news;
            $resultFeaturedNews2[$key]->news_type = $newsType = json_decode($news->newsType);
            if ($newsType->featurednew && $newsType->featurednew->start_date <= $currentDate && $newsType->featurednew->end_date >= $currentDate) 
            {
                $resultFeaturedNews2[$key]->is_featurednew = 1;
                $resultFeaturedNews2[$key]->featurednew_start_date = $newsType->featurednew->start_date;
                $resultFeaturedNews2[$key]->featurednew_end_date = $newsType->featurednew->end_date;                
            }  
        }
        
        $getAllNewses   = News::orderBy('orderIndex', 'asc')->get();

        $banners_small = Banner::where('location', 'hpmarnewsrect')->get()->toArray();
        $banners_horizontal = Banner::where('location', 'hpmarnewsfull')->get()->toArray();

        $title      = $request->filterNewsTitle;
        $newses    = News::where('title', 'LIKE', '%'.$title.'%')->orderby('orderIndex','asc')->get();
        if($title == "" | $title == null)
        {
            $newses    = News::orderby('orderIndex','asc')->get();
        }
        $currentDate = date('d-m-Y');
        $resultFeaturedNews = array();
        foreach($newses as $key => $news)
        {
            
            $resultFeaturedNews[$key] = $news;
            $resultFeaturedNews[$key]->news_type = $newsType = json_decode($news->newsType);
            if ($newsType->featurednew && $newsType->featurednew->start_date <= $currentDate && $newsType->featurednew->end_date >= $currentDate) 
            {
                $resultFeaturedNews[$key]->is_featurednew = 1;
                $resultFeaturedNews[$key]->featurednew_start_date = $newsType->featurednew->start_date;
                $resultFeaturedNews[$key]->featurednew_end_date = $newsType->featurednew->end_date;                
            }  
        }
        

        // $allNews        = NewsService::getNews();
        // $categories     = Category::all();
        $getAllNewses   = News::orderby('orderIndex','asc')->get();
        return view('user.featuredNews', compact('banners_horizontal', 'banners_small', 'getAllNewses', 'resultFeaturedNews', 'resultFeaturedNews2'));

    }

    public function newsHomeSearch(Request $request)
    {
        $homeSearch = $request->homeSearch;

        $newses          = News::orderBy('orderIndex', 'asc')->get();

        $currentDate = date('d-m-Y');
        $resultFeaturedNews = array();

        foreach($newses as $key => $news)
        {
            $resultFeaturedNews[$key] = $news;
            $resultFeaturedNews[$key]->news_type = $newsType = json_decode($news->newsType);
            if ($newsType->featurednew && $newsType->featurednew->start_date <= $currentDate && $newsType->featurednew->end_date >= $currentDate) 
            {
                $resultFeaturedNews[$key]->is_featurednew = 1;
                $resultFeaturedNews[$key]->featurednew_start_date = $newsType->featurednew->start_date;
                $resultFeaturedNews[$key]->featurednew_end_date = $newsType->featurednew->end_date;                
            }  
        }
        // dd($resultFeaturedNews);
        $allNews        = News::orderby('orderIndex','asc')->paginate(10);
        $categories     = Category::all();
        $getAllNewses   = News::orderby('orderIndex','asc')->get();
        return view('user.news', compact('getAllNewses', 'allNews', 'categories', 'resultFeaturedNews','homeSearch'));
    }

    public function mailData()
    {
        //Load Composer's autoloader
        require base_path("vendor/autoload.php");
        
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        
        $mail->SMTPDebug  = 2;
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Host       = 'tls://smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Port       = 587;                           //SMTP password
        $mail->SMTPKeepAlive = true;
        $mail->Mailer = "tls";
        $mail->Username   = 'nftnews@infinitedryer.com';                     //SMTP username
        $mail->Password   = 'np;0H3Y;!Iqj';                               //SMTP password
        $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        ));

        return $mail;
    }

    public function subscribe()
    {
        $fourRandomDigit = mt_rand(1000,9999);
        return view('user.subscribe', compact('fourRandomDigit'));
    }

    public function sendMailForSubscribe(Request $request)
    {
            $mail = $this->mailData();

            if($request->subscriberId != null)
            {
                    $subscribeDetails = $request->only([
                    'email',
                ]);

                //Mail Information
                //Recipients
                $mail->setFrom($request->email, 'Subscription Request Mail From User');
                $mail->addAddress('nftnews@infinitedryer.com', 'Admin');     //Add a recipient
                
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Subscription Request Mail From User';
                $mail->Body    = 'Hello, This is subscription request mail from the <b>' . $request->email . '</b>. Please contact them for further process. <br><br> -Regards.';
                $mail->send();
                
                Subscribe::create($subscribeDetails);
                return redirect()->back()->with('success', 'Subscription Information Submitted Successfully also Mail Has Been Sent Successfully To Our Admin We will Reach You Soon.');
            }

        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $subject = $request->subject;
        $message = $request->message;
        $captcha = $request->captcha;
        $fourDigitRandom = $request->fourDigitRandom;

        $validatedData = $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
            'captcha' => 'required',
            //'email' => 'required|email|unique:users'
        ], [
            'name.required'     => 'Name is required',
            'email.required'    => 'Email is required',
            'captcha.required'  => 'Captcha is required',
        ]);

        $subscribeDetails = $request->only([
            'name',
            'email',
            'phone',
            'subject',
            'message',
        ]);

        if($request->captcha == $fourDigitRandom)
        {
            //Mail Information
            //Recipients
            $mail->setFrom($email, 'Subscription Request Mail From' . $name);
            $mail->addAddress('nftnews@infinitedryer.com', 'Admin');     //Add a recipient
            
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Subscription Request Mail From User" . $subject;
            $mail->Body    = 'Hello, This is subscription request mail from the ' . '<b>' . $name . '</b>' . '. You can directly contact the user for further details through contact information given here:<br>
            <!DOCTYPE html>
            <html>
            <head>
            <style>
            table, th, td {
            border: 1px solid white;
            border-collapse: collapse;
            }
            th, td {
            background-color: #96D4D4;
            }
            </style>
            </head>
            <body>

            <h2>User Information</h2>

            <table style="width:100%">
            <tr>
                <th>Name</th>
                <th>Value</th> 
            </tr>
            <tr>
                <td>Full Name</td>
                <td>'. $request->name . '</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>'. $request->email . '</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>'. $request->phone . '</td>
            </tr>
            <tr>
                <td>Subject</td>
                <td>'. $request->subject . '</td>
            </tr>
            <tr>
                <td>Message</td>
                <td>'. $request->message . '</td>
            </tr>
            </table>
            </body>
            </html>
            <br><br> <b>-Regards</b>';
        
            $mail->send();

            Subscribe::create($subscribeDetails);
            return redirect()->back()->with('success', 'Subscription Information Submitted Successfully also Mail Has Been Sent Successfully To Our Admin We will Reach You Soon.');
        }
        else
        {
            return redirect()->back()->with('error', 'Invalid Captcha.');
        }
    }  
}