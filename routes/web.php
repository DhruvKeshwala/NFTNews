<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthorController;

  
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
  
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 



Route::middleware(['auth'])->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('news');
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); 
    // Category
    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::get('add_category/{id?}', [CategoryController::class, 'addCategory'])->name('add_category');
    Route::post('save_category', [CategoryController::class, 'saveCategory'])->name('save_category');
    Route::post('delete_category', [CategoryController::class, 'deleteCategory'])->name('delete_category');
    // News
    Route::get('news', [NewsController::class, 'index'])->name('news');
    Route::get('add_news/{id?}', [NewsController::class, 'addNews'])->name('add_news');
    Route::get('news_detail/{id}', [NewsController::class, 'newsDetail'])->name('news_detail');
    Route::post('save_news', [NewsController::class, 'saveNews'])->name('save_news');
    Route::post('delete_news', [NewsController::class, 'deleteNews'])->name('delete_news');
    // Author
    Route::get('author', [AuthorController::class, 'index'])->name('author');
    Route::get('add_author/{id?}', [AuthorController::class, 'create'])->name('add_author');
    Route::post('save_author', [AuthorController::class, 'store'])->name('save_author');
    Route::post('delete_author', [AuthorController::class, 'destroy'])->name('delete_author');
    
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});