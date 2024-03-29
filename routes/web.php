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
use App\Http\Controllers\MediaController;


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

Route::get('/filepopup', function () {
    return view('demofilepopup');
});

Route::group(['prefix' => 'siteadmin'], function () {
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
        Route::get('add_dropManagement/{id?}/{type?}', [DropManagementController::class, 'addDropManagement'])->name('add_dropManagement');
        Route::post('save_userDropManagement', [DropManagementController::class, 'saveUserDropManagement'])->name('save_userDropManagement');

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
        Route::get('filter_guide_category', [GuideCategoryController::class, 'filterCategory'])->name('filter_guide_category');

        // Media
        Route::get('media', [MediaController::class, 'index'])->name('media');
        Route::get('add_media/{id?}', [MediaController::class, 'create'])->name('add_media');
        Route::post('save_media', [MediaController::class, 'store'])->name('save_media');
        // Route::post('delete_media', [MediaController::class, 'destroy'])->name('delete_media');
        // Route::get('/filter_media', [MediaController::class, 'filtermedia'])->name('filter_media');
        Route::get('media_detail/{id}', [MediaController::class, 'mediaDetail'])->name('media_detail');

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

        Route::get('subscribersList', [ManagePagesController::class, 'subscribersList'])->name('subscribersList');
        Route::get('contactList', [ManagePagesController::class, 'contactList'])->name('contactList');

        // ckeditor image upload method
        Route::post('ckeditor/image_upload', [ManagePagesController::class, 'upload'])->name('upload');


        Route::get('logout', [AuthController::class, 'logout'])->name('logout');

        Route::post('saveFile', [MediaController::class, 'saveFile'])->name('saveFile');
        Route::get('/getMediaFiles', [MediaController::class, 'getMediaFiles'])->name('getMediaFiles');
        Route::post('filterMedia', [MediaController::class, 'filterMedia']);
        Route::post('delete_media', [MediaController::class, 'deleteMedia'])->name('delete_media');
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
Route::post('sendMailForSubscribe', [HomeController::class, 'sendMailForSubscribe'])->name('sendMailForSubscribe');

Route::get('featuredNews', [HomeController::class, 'featuredNews'])->name('user.featuredNews');
Route::post('featuredNews', [HomeController::class, 'filterFeaturedNews'])->name('user.filterFeaturedNews');

Route::post('newsHomeSearch', [HomeController::class, 'newsHomeSearch'])->name('user.newsHomeSearch');


Route::get('news', [UserNewsController::class, 'index'])->name('user.news');
Route::get('news/newsSearch', [UserNewsController::class, 'filterNews'])->name('user.filter_news');
Route::get('news/{category?}/{id}', [UserNewsController::class, 'newsDetail'])->name('user.news_detail');

Route::get('pressReleaseDetail/{id}', [UserPressController::class, 'pressDetail'])->name('user.press_detail');

Route::get('listNFTDrop', [UserNFTDropsController::class, 'listNFTDrop'])->name('user.list_nftDrops');
Route::get('listNFTDrop/NFTDropSearch', [UserNFTDropsController::class, 'filterNFTDrop'])->name('user.filter_nftdrops');
Route::get('listNFTDrop/{category?}/{id?}', [UserNFTDropsController::class, 'nftDropDetail'])->name('user.nftDrop_detail');
Route::get('listNFTDrop/submit-nft', [UserNFTDropsController::class, 'submitNFT'])->name('user.submitnft');
Route::post('listNFTDrop/submit-nft', [UserNFTDropsController::class, 'save_submitNFT'])->name('user.submitnftpost');



//Tag wise filter categories
Route::get('news/userFilterCategoryNews/{category?}/{id?}', [HomeController::class, 'userFilterCategoryNews'])->name('userFilterCategoryNews');
Route::get('userFilterCategory', [HomeController::class, 'userFilterCategory'])->name('userFilterCategory');

//Tag wise filter NFT Drops
Route::get('userFilterNFTDrops', [HomeController::class, 'userFilterNFTDrops'])->name('userFilterNFTDrops');

//Tag wise filter Videos
Route::get('userFilterVideos', [HomeController::class, 'userFilterVideos'])->name('userFilterVideos');

Route::get('markets', [UserMarketsController::class, 'index'])->name('user.markets');
Route::get('markets/marketSearch', [UserMarketsController::class, 'filterMarketNews'])->name('user.filter_marketsNews');

Route::get('videos', [UserVideosController::class, 'index'])->name('user.videos');
Route::get('videos/{category?}/{id}', [UserVideosController::class, 'videoDetail'])->name('user.video_detail');
Route::get('videos/videoSearch', [UserVideosController::class, 'videoSearch'])->name('user.videoSearch');
Route::post('videos', [UserVideosController::class, 'filterVideos'])->name('user.filter_videos');

Route::get('cryptoJournals', [UserCryptoController::class, 'index'])->name('user.cryptoJournals');
Route::get('cryptoJournals/{id}', [UserCryptoController::class, 'cryptoDetail'])->name('user.crypto_detail');
Route::get('cryptoJournals/cryptoJournalSearch', [UserCryptoController::class, 'filterCrypto'])->name('user.filter_crypto');

Route::get('guide', [UserGuideController::class, 'index'])->name('user.guide');
Route::get('guideList/{category}/{slug?}', [UserGuideController::class, 'guideList'])->name('user.guideList');


Route::get('pressRelease', [UserPressController::class, 'index'])->name('user.pressRelease');
Route::get('pressRelease/pressReleaseSearch', [UserPressController::class, 'filterPress'])->name('user.filterPress');

// Route::post('send_mail', [UserPressController::class, 'sendMail'])->name('send_mail');

Route::post('send_mail', [UserPressController::class, 'sendMail'])->name('send_mail');
