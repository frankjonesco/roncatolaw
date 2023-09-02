<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\TestimonialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// SITE CONRTROLLER

// SiteController (auth & guest)
Route::controller(SiteController::class)->group(function (){
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'viewAbout');
    Route::get('/terms', 'viewTerms');
});



// USER CONRTROLLER

// UserController (guest only)
Route::controller(UserController::class)->middleware('guest')->group(function(){
    Route::get('/login', 'login')->name('login');
    Route::post('/users/authenticate', 'authenticate');
    Route::get('/signup', 'create');
    Route::post('/users/store', 'store');
});

// UserController (auth only)
Route::controller(UserController::class)->middleware('auth')->group(function(){
    Route::post('/logout', 'logout');
    Route::get('/profile', 'viewProfile');
    
    Route::get('/profile/{user}/edit', 'edit');
    Route::post('/profile/{user}/update', 'update');
    Route::get('/profile/{user}/edit-password', 'editPassword');
    Route::post('/profile/{user}/update-password', 'updatePassword');
    Route::get('/profile/{user}/images/upload', 'selectImage');
    Route::post('/profile/{user}/images/upload', 'uploadImage');
    Route::get('/profile/{user}/images/crop', 'cropImage');
    Route::post('/profile/{user}/images/render', 'renderImage');

    Route::get('/profile/{user}', 'viewProfile');
});



// DASHBORD CONTROLLER

// DashboardController (auth only)
Route::controller(DashboardController::class)->middleware('auth')->group(function(){
    Route::get('/dashboard', 'index');
});



// CATEGORY CONTROLLER

// CategoryController (auth only)
Route::controller(CategoryController::class)->middleware('auth')->group(function(){
    Route::get('/dashboard/categories', 'adminIndex');
    Route::get('/dashboard/categories/create', 'create');
    Route::post('/dashboard/categories/store', 'store');
    Route::get('/dashboard/categories/{category}/edit', 'edit');
    Route::post('/dashboard/categories/{category}/update', 'update');
    Route::get('/dashboard/categories/{category}/images/upload', 'selectImage');
    Route::post('/dashboard/categories/{category}/images/upload', 'uploadImage');
    Route::get('/dashboard/categories/{category}/images/crop', 'cropImage');
    Route::post('/dashboard/categories/{category}/images/render', 'renderImage');
});

// CategoryController (auth and guest)

Route::controller(CategoryController::class)->group(function(){
    Route::get('/categories', 'index');
    Route::get('/categories/{category}/topics');
    Route::get('/categories/{category}', 'show');
});



// TOPIC CONTROLLER

// TopicController (auth only)
Route::controller(TopicController::class)->middleware('auth')->group(function(){
    Route::get('/dashboard/topics', 'adminIndex');
    Route::get('/dashboard/topics/create', 'create');
    Route::post('/dashboard/topics/store', 'store');
    Route::get('/dashboard/topics/{topic}/edit', 'edit');
    Route::post('/dashboard/topics/{topic}/update', 'update');
    Route::get('/dashboard/topics/{topic}/images/upload', 'selectImage');
    Route::post('/dashboard/topics/{topic}/images/upload', 'uploadImage');
    Route::get('/dashboard/topics/{topic}/images/crop', 'cropImage');
    Route::post('/dashboard/topics/{topic}/images/render', 'renderImage');
});



// ARTICLE CONTROLLER

// ArticleController (auth only)
Route::controller(ArticleController::class)->middleware('auth')->group(function(){
    Route::get('/dashboard/articles', 'adminIndex');
    Route::get('/dashboard/articles/create', 'create');
    Route::post('/dashboard/articles/store', 'store');
    Route::get('/dashboard/articles/{article}/edit', 'edit');
    Route::post('/dashboard/articles/{article}/update', 'update');
    Route::get('/dashboard/articles/{article}/images/upload', 'selectImage');
    Route::post('/dashboard/articles/{article}/images/upload', 'uploadImage');
    Route::get('/dashboard/articles/{article}/images/crop', 'cropImage');
    Route::post('/dashboard/articles/{article}/images/render', 'renderImage');
    Route::post('/dashboard/articles/{article}/upload-article-images', 'storeBodyImage')->name('image.upload');
});

// ArticleController (auth and guest)

Route::controller(ArticleController::class)->group(function(){
    Route::get('/articles', 'index');
    Route::get('/articles/{article}', 'show');
});



// PARTNER CONTROLLER

// PartnerController (auth only)
Route::controller(PartnerController::class)->middleware('auth')->group(function(){
    Route::get('/dashboard/partners', 'adminIndex');
    Route::get('/dashboard/partners/create', 'create');
    Route::post('/dashboard/partners/store', 'store');
    Route::get('/dashboard/partners/{partner}/edit', 'edit');
    Route::post('/dashboard/partners/{partner}/update', 'update');
    Route::get('/dashboard/partners/{partner}/images/upload', 'selectImage');
    Route::post('/dashboard/partners/{partner}/images/upload', 'uploadImage');
    Route::get('/dashboard/partners/{partner}/images/crop', 'cropImage');
    Route::post('/dashboard/partners/{partner}/images/render', 'renderImage');
});

// PartnerController (auth and guest)

Route::controller(PartnerController::class)->group(function(){
    
});



// TESTIMONIAL CONTROLLER

// TestimonialController (auth only)
Route::controller(TestimonialController::class)->middleware('auth')->group(function(){
    Route::get('/dashboard/testimonials', 'adminIndex');
    Route::get('/dashboard/testimonials/create', 'create');
    Route::post('/dashboard/testimonials/store', 'store');
    Route::get('/dashboard/testimonials/{testimonial}/edit', 'edit');
    Route::post('/dashboard/testimonials/{testimonial}/update', 'update');
    Route::get('/dashboard/testimonials/{testimonial}/images/upload', 'selectImage');
    Route::post('/dashboard/testimonials/{testimonial}/images/upload', 'uploadImage');
    Route::get('/dashboard/testimonials/{testimonial}/images/crop', 'cropImage');
    Route::post('/dashboard/testimonials/{testimonial}/images/render', 'renderImage');
});

// TestimonialController (auth and guest)

Route::controller(TestimonialController::class)->group(function(){
    
});



// SERVICES CONTROLLER

// ServicesController (auth and guest)
Route::controller(ServiceController::class)->group(function(){
    Route::get('/services', 'index');
});



// TESTIMONIALS CONTROLLER

// TestimonialController (auth and guest)
Route::controller(TestimonialController::class)->group(function(){
    Route::get('/testimonials', 'index');
});



// CONTACT CONTROLLER

// ContactController (auth and guest)
Route::controller(ContactController::class)->group(function(){
    Route::get('/contact', 'index');
});






