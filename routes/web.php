<?php

use App\Http\Controllers\CreatePostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LatestNewsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UpdateUser;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;


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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get("/login", [\App\Http\Controllers\Auth\LoginController::class, "index"]);

//LATEST POST
Route::get('/latest-posts', [LatestNewsController::class, 'index'])->name('latestPosts');

//ROUTE POST
Route::get("/post/create", [App\Http\Controllers\CreatePostController::class,"index"])->name('post.create');
Route::post("/post/create", [App\Http\Controllers\CreatePostController::class, "store"])->name('submitPost');
Route::get("/post/{id}", [App\Http\Controllers\CreatePostController::class,"show"])->name('post.show');
Route::post("/post/{id}", [App\Http\Controllers\CreatePostController::class,"update"])->name('post.update');
Route::delete("/post/{id}", [App\Http\Controllers\CreatePostController::class,"delete"])->name('post.destroy');


//ROUTE PROFILE
Route::get("/profile", [App\Http\Controllers\ProfileController::class, "index"])->name('profile');
Route::get("/profile/update/{id}", [App\Http\Controllers\ProfileController::class, "show"])->name('profile.update');
Route::post("/profile/update", [App\Http\Controllers\ProfileController::class, "update"])->name('submitUser');


//ROUTE HOME
Route::get("/dashboard", [App\Http\Controllers\HomeController::class, "index"])->name('home');



// ROUTES FAQ
Route::get("/faq",[App\Http\Controllers\FaqController::class,"index"])->name('faq');
Route::delete('/faq/{id}', [App\Http\Controllers\FaqController::class,"destroy"])->name('faq.destroy');
Route::get('/faq/{id}', [App\Http\Controllers\FaqController::class,"show"])->name('faq.show');
Route::get('/create/faq', 'App\Http\Controllers\FaqController@create')->name('faq.create');
Route::post("/create/faq",/*'App\Http\Controllers\FaqController@store'*/[App\Http\Controllers\FaqController::class,"store"])->name('submitFaq');
// Route::post("/create/faq",[App\Http\Controllers\FaqController::class,"store"])->name('submitFaq');

Route::post("/faq/{id}",[App\Http\Controllers\FaqController::class,"update"])->name('faq.update');


//ROUTES COMMENTS
Route::delete('/comments/{id}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.destroy');
Route::post('/comments/create', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');


Auth::routes();

//ROUTE CONTACT 
Route::get('/contact', [App\Http\Controllers\ContactController::class,"index"])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class,"sendEmail"])->name('sendEmail');

// Route for creating a like or removing a like
Route::post('/like/{userId}/{postId}', [App\Http\Controllers\LikeController::class, 'create'])->name('like.create');

//RESTRICTED ROUTES 
Route::middleware(['auth', 'admin'])->group(function () {
    // ROUTES SETTINGS
    Route::get("/settings", [App\Http\Controllers\SettingsController::class, "index"])->name('settings');
//ROUTE CATEGORIES
    Route::get("/categories", [App\Http\Controllers\CategoryController::class, "index"])->name('category');
    Route::get("/categories", 'App\Http\Controllers\CategoryController@index')->name('category');

    Route::post("/categories", [App\Http\Controllers\CategoryController::class, "store"])->name('category.store');
    Route::patch('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.delete');
    Route::delete('/categories', [App\Http\Controllers\CategoryController::class, 'destroy2'])->name('category.delete2');
    // Route::delete('/categories/{id}', 'App\Http\Controllers\CategoryController@destroy')->name('category.delete');


});





