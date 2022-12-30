<?php
  
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

//User controllers
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\UserNewsController;
use App\Http\Controllers\user\UserPressController;
use App\Http\Controllers\user\UserNFTDropsController;
use App\Http\Controllers\user\UserMarketsController;
use App\Http\Controllers\user\UserVideosController;
use App\Http\Controllers\user\UserCryptoController;
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

        Route::get('/changePassword', function(){
            return view('changePassword');
        });

        //Change Password
        Route::get('changePassword', [AuthController::class, 'changePassword'])->name('changePassword');
        Route::post('save_changePassword', [AuthController::class, 'save_changePassword'])->name('save_changePassword'); 

        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
});

//User side
Route::get('/', [HomeController::class, 'index'])->name('user.home');

Route::get('news', [UserNewsController::class, 'index'])->name('user.news');
Route::post('news', [UserNewsController::class, 'filterNews'])->name('user.filter_news');
Route::get('newsDetail/{id}', [UserNewsController::class, 'newsDetail'])->name('user.news_detail');

Route::get('pressReleaseDetail/{id}', [UserPressController::class, 'pressDetail'])->name('user.press_detail');

Route::get('listNFTDrop', [UserNFTDropsController::class, 'listNFTDrop'])->name('user.list_nftDrops');
Route::get('nftDropDetail/{id}', [UserNFTDropsController::class, 'nftDropDetail'])->name('user.nftDrop_detail');

//Tag wise filter categories
Route::get('userFilterCategory', [HomeController::class, 'userFilterCategory'])->name('userFilterCategory');

//Tag wise filter NFT Drops
Route::get('userFilterNFTDrops', [HomeController::class, 'userFilterNFTDrops'])->name('userFilterNFTDrops');

//Tag wise filter Videos
Route::get('userFilterVideos', [HomeController::class, 'userFilterVideos'])->name('userFilterVideos');

Route::get('markets', [UserMarketsController::class, 'index'])->name('user.markets');

Route::get('videos', [UserVideosController::class, 'index'])->name('user.videos');
Route::get('videoDetail/{id}', [UserVideosController::class, 'videoDetail'])->name('user.video_detail');

Route::get('cryptoJournals', [UserCryptoController::class, 'index'])->name('user.cryptoJournals');
Route::get('cryptoDetail/{id}', [UserCryptoController::class, 'cryptoDetail'])->name('user.crypto_detail');

