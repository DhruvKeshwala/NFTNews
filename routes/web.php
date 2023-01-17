<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\DropManagementController;
use App\Http\Controllers\PressReleaseController;
use App\Http\Controllers\VideoManagementController;
use App\Http\Controllers\CryptoJournalController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ManagePagesController;
use App\Http\Controllers\GuideCategoryController;

//User controllers
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\UserNewsController;
use App\Http\Controllers\user\UserPressController;
use App\Http\Controllers\user\UserNFTDropsController;
use App\Http\Controllers\user\UserMarketsController;
use App\Http\Controllers\user\UserVideosController;
use App\Http\Controllers\user\UserCryptoController;
use App\Http\Controllers\user\UserGuideController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
  
Route::get('siteadmin', [AuthController::class, 'index'])->name('login');
Route::get('siteadmin/login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 


Route::group(['prefix'=>'siteadmin'], function(){
    Route::middleware(['auth'])->group(function () {
        Route::get('news', [NewsController::class, 'index'])->name('news');
        Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); 

        // Category
        Route::get('category', [CategoryController::class, 'index'])->name('category');
        Route::get('add_category/{id?}', [CategoryController::class, 'addCategory'])->name('add_category');
        Route::post('save_category', [CategoryController::class, 'saveCategory'])->name('save_category');
        Route::post('delete_category', [CategoryController::class, 'deleteCategory'])->name('delete_category');
        Route::get('filter_category', [CategoryController::class, 'filterCategory'])->name('filter_category');

        // News
        Route::get('news', [NewsController::class, 'index'])->name('news');
        Route::get('add_news/{id?}', [NewsController::class, 'addNews'])->name('add_news');
        Route::get('news_detail/{id}', [NewsController::class, 'newsDetail'])->name('news_detail');
        Route::post('save_news', [NewsController::class, 'saveNews'])->name('save_news');
        Route::post('delete_news', [NewsController::class, 'deleteNews'])->name('delete_news');
        Route::get('/filter_news', [NewsController::class, 'filterNews'])->name('filter_news');
        Route::get('newsUpdateStatus/{id}', [NewsController::class, 'newsUpdateStatus'])->name('news_updateStatus');

        // Author
        Route::get('author', [AuthorController::class, 'index'])->name('author');
        Route::get('add_author/{id?}', [AuthorController::class, 'create'])->name('add_author');
        Route::post('save_author', [AuthorController::class, 'store'])->name('save_author');
        Route::post('delete_author', [AuthorController::class, 'destroy'])->name('delete_author');
        Route::get('/filter_author', [AuthorController::class, 'filterAuthor'])->name('filter_author');

        // Banner
        Route::get('banner', [BannerController::class, 'index'])->name('banner');
        Route::get('add_banner/{id?}', [BannerController::class, 'create'])->name('add_banner');
        Route::post('save_banner', [BannerController::class, 'store'])->name('save_banner');
        Route::post('delete_banner', [BannerController::class, 'destroy'])->name('delete_banner');
        Route::get('/filter_banner', [BannerController::class, 'filterBanner'])->name('filter_banner');

        // Drop Management
        Route::get('dropManagement', [DropManagementController::class, 'index'])->name('dropManagement');
        Route::get('add_dropManagement/{id?}', [DropManagementController::class, 'addDropManagement'])->name('add_dropManagement');
        Route::post('save_dropManagement', [DropManagementController::class, 'saveDropManagement'])->name('save_dropManagement');
        Route::get('dropManagement_detail/{id}', [DropManagementController::class, 'dropManagementDetail'])->name('dropManagement_detail');
        Route::post('delete_dropManagement', [DropManagementController::class, 'deleteDropManagement'])->name('delete_dropManagement');
        Route::get('/filter_dropManagement', [DropManagementController::class, 'filterDropManagement'])->name('filter_dropManagement');

        // Press Release
        Route::get('pressRelease', [PressReleaseController::class, 'index'])->name('pressRelease');
        Route::get('add_pressRelease/{id?}', [PressReleaseController::class, 'addPressRelease'])->name('add_pressRelease');
        Route::get('pressRelease_detail/{id}', [PressReleaseController::class, 'pressReleaseDetail'])->name('pressRelease_detail');
        Route::post('save_pressRelease', [PressReleaseController::class, 'savePressRelease'])->name('save_pressRelease');
        Route::post('delete_pressRelease', [PressReleaseController::class, 'deletePressRelease'])->name('delete_pressRelease');
        Route::get('/filter_pressRelease', [PressReleaseController::class, 'filterPressRelease'])->name('filter_pressRelease');
        Route::get('pressUpdateStatus/{id}', [PressReleaseController::class, 'pressUpdateStatus'])->name('press_updateStatus');
        
        // video management
        Route::get('videos', [VideoManagementController::class, 'index'])->name('videos');
        Route::get('add_video/{id?}', [VideoManagementController::class, 'addVideo'])->name('add_video');
        Route::get('video_detail/{id}', [VideoManagementController::class, 'videoDetail'])->name('video_detail');
        Route::post('save_video', [VideoManagementController::class, 'saveVideo'])->name('save_video');
        Route::post('delete_video', [VideoManagementController::class, 'deleteVideo'])->name('delete_video');
        Route::get('/filter_video', [VideoManagementController::class, 'filterVideo'])->name('filter_video');
        Route::get('videoUpdateStatus/{id}', [VideoManagementController::class, 'videoUpdateStatus'])->name('video_updateStatus');

        //Crypto Journal Management
        Route::get('cryptoJournal', [CryptoJournalController::class, 'index'])->name('cryptoJournal');
        Route::get('add_crypto/{id?}', [CryptoJournalController::class, 'addCrypto'])->name('add_crypto');
        Route::post('save_crypto', [CryptoJournalController::class, 'saveCrypto'])->name('save_crypto');
        Route::post('delete_crypto', [CryptoJournalController::class, 'deleteCrypto'])->name('delete_crypto');
        Route::get('/filter_crypto', [CryptoJournalController::class, 'filterCrypto'])->name('filter_crypto');
        Route::get('cryptoUpdateStatus/{id}', [CryptoJournalController::class, 'cryptoUpdateStatus'])->name('crypto_updateStatus');

        // Guide
        Route::get('guide', [GuideController::class, 'index'])->name('guide');
        Route::get('add_guide/{id?}', [GuideController::class, 'addGuide'])->name('add_guide');
        Route::post('save_guide', [GuideController::class, 'saveguide'])->name('save_guide');
        Route::post('delete_guide', [GuideController::class, 'deleteGuide'])->name('delete_guide');
        Route::get('guide_detail/{id}', [GuideController::class, 'guideDetail'])->name('guide_detail');
        Route::get('/filter_guide', [GuideController::class, 'filterGuide'])->name('filter_guide');
        
        //Guide Category
        Route::get('guide_category', [GuideCategoryController::class, 'index'])->name('guide_category');
        Route::get('add_guide_category/{id?}', [GuideCategoryController::class, 'addCategory'])->name('add_guide_category');
        Route::post('save_guide_category', [GuideCategoryController::class, 'saveCategory'])->name('save_guide_category');
        Route::post('delete_guide_category', [GuideCategoryController::class, 'deleteCategory'])->name('delete_guide_category');
        Route::post('filter_guide_category', [GuideCategoryController::class, 'filterCategory'])->name('filter_guide_category');

        //Manage Pages
        Route::get('managePages', [ManagePagesController::class, 'index'])->name('managePages');
        Route::get('add_page/{id?}', [ManagePagesController::class, 'addPage'])->name('add_page');
        Route::post('save_page', [ManagePagesController::class, 'savePage'])->name('save_page');
        Route::post('delete_page', [ManagePagesController::class, 'deletePage'])->name('delete_page');
        Route::get('page_detail/{id}', [ManagePagesController::class, 'pageDetail'])->name('page_detail');


        // Route::get('/filter_news', [GuideController::class, 'filterNews'])->name('filter_news');
        // Route::get('newsUpdateStatus/{id}', [GuideController::class, 'newsUpdateStatus'])->name('news_updateStatus');

        // Route::get('/changePassword', function(){
        //     return view('changePassword');
        // });

        //Change Password
        Route::get('changePassword', [AuthController::class, 'changePassword'])->name('changePassword');
        Route::post('save_changePassword', [AuthController::class, 'save_changePassword'])->name('save_changePassword'); 

        //Update Password
        Route::get('settings', [AuthController::class, 'updateSettings'])->name('settings');
        Route::post('update_settings', [AuthController::class, 'updateAdminSettings'])->name('update_settings'); 

        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
});

//User side
Route::get('/', [HomeController::class, 'index'])->name('user.home');
Route::get('advertise', [HomeController::class, 'advertise'])->name('user.advertise');
Route::get('contact', [HomeController::class, 'contact'])->name('user.contact');
Route::post('sendMailForContact', [HomeController::class, 'sendMailForContact'])->name('sendMailForContact');


Route::get('education', [HomeController::class, 'education'])->name('user.education');
Route::get('services', [HomeController::class, 'services'])->name('user.services');
Route::get('partners', [HomeController::class, 'partners'])->name('user.partners');
Route::get('privacyPolicy', [HomeController::class, 'privacyPolicy'])->name('user.privacyPolicy');
Route::get('termsAndConditions', [HomeController::class, 'termsAndConditions'])->name('user.termsAndConditions');
Route::get('GDPR', [HomeController::class, 'gdpr'])->name('user.gdpr');
Route::get('termsOfService', [HomeController::class, 'termsOfService'])->name('user.termsOfService');
Route::get('investmentAndFunding', [HomeController::class, 'investmentAndFunding'])->name('user.investmentAndFunding');
Route::get('mediaEnquiries', [HomeController::class, 'mediaEnquiries'])->name('user.mediaEnquiries');
Route::get('careers', [HomeController::class, 'careers'])->name('user.careers');
Route::get('about', [HomeController::class, 'about'])->name('user.about');



Route::get('mailData', [HomeController::class, 'mailData'])->name('user.mailData'); //For Mail Credentials




Route::get('subscribe', [HomeController::class, 'subscribe'])->name('user.subscribe');
Route::get('sendMailForSubscribe', [HomeController::class, 'sendMailForSubscribe'])->name('sendMailForSubscribe');

Route::get('featuredNews', [HomeController::class, 'featuredNews'])->name('user.featuredNews');
Route::post('featuredNews', [HomeController::class, 'filterFeaturedNews'])->name('user.filterFeaturedNews');

Route::post('newsHomeSearch', [HomeController::class, 'newsHomeSearch'])->name('user.newsHomeSearch');


Route::get('news', [UserNewsController::class, 'index'])->name('user.news');
Route::post('news', [UserNewsController::class, 'filterNews'])->name('user.filter_news');
Route::get('newsDetail/{id}', [UserNewsController::class, 'newsDetail'])->name('user.news_detail');

Route::get('pressReleaseDetail/{id}', [UserPressController::class, 'pressDetail'])->name('user.press_detail');

Route::get('listNFTDrop', [UserNFTDropsController::class, 'listNFTDrop'])->name('user.list_nftDrops');
Route::post('listNFTDrop', [UserNFTDropsController::class, 'filterNFTDrop'])->name('user.filter_nftdrops');
Route::get('nftDropDetail/{id}', [UserNFTDropsController::class, 'nftDropDetail'])->name('user.nftDrop_detail');
Route::get('submit-nft', [UserNFTDropsController::class, 'submitNFT'])->name('user.submitnft');
Route::post('submit-nft', [UserNFTDropsController::class, 'save_submitNFT'])->name('user.submitnftpost');



//Tag wise filter categories
Route::get('userFilterCategory', [HomeController::class, 'userFilterCategory'])->name('userFilterCategory');

//Tag wise filter NFT Drops
Route::get('userFilterNFTDrops', [HomeController::class, 'userFilterNFTDrops'])->name('userFilterNFTDrops');

//Tag wise filter Videos
Route::get('userFilterVideos', [HomeController::class, 'userFilterVideos'])->name('userFilterVideos');

Route::get('markets', [UserMarketsController::class, 'index'])->name('user.markets');
Route::post('markets', [UserMarketsController::class, 'filterMarketNews'])->name('user.filter_marketsNews');

Route::get('videos', [UserVideosController::class, 'index'])->name('user.videos');
Route::get('videoDetail/{id}', [UserVideosController::class, 'videoDetail'])->name('user.video_detail');
Route::post('videos', [UserVideosController::class, 'filterVideos'])->name('user.filter_videos');

Route::get('cryptoJournals', [UserCryptoController::class, 'index'])->name('user.cryptoJournals');
Route::get('cryptoDetail/{id}', [UserCryptoController::class, 'cryptoDetail'])->name('user.crypto_detail');
Route::post('cryptoJournals', [UserCryptoController::class, 'filterCrypto'])->name('user.filter_crypto');

Route::get('guide', [UserGuideController::class, 'index'])->name('user.guide');
Route::get('guideList/{category}/{slug?}', [UserGuideController::class, 'guideList'])->name('user.guideList');


Route::get('pressRelease', [UserPressController::class, 'index'])->name('user.pressRelease');
Route::post('pressRelease', [UserPressController::class, 'filterPress'])->name('user.filterPress');

// Route::post('send_mail', [UserPressController::class, 'sendMail'])->name('send_mail');

Route::post('send_mail', [UserPressController::class, 'sendMail'])->name('send_mail');

Route::get('send-email', function () {
   
//Load Composer's autoloader
require base_path("vendor/autoload.php");

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
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
    )
);
    //Recipients
    $mail->setFrom('desaipratik1462@gmail.com', 'Mail From Admin');
    $mail->addAddress('desaipratik1462@gmail.com', 'User');     //Add a recipient
    

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New Mail from Pratik';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        //Recipients
    $mail->setFrom('nftnews@infinitedryer.com', 'Mail From Admin');
    $mail->addAddress('desaipratik1462@gmail.com', 'User');     //Add a recipient


    //Content
    //$mail->isHTML(true);                                  //Set email format to HTML
    //$mail->Subject = 'New Mail from Admin';
    $mail->Body    = html_entity_decode('This is the HTML message body <b>in bold!</b>');
    //$mail->IsHTML(true);
   // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

        

});