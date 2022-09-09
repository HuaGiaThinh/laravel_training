<?php

use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use Illuminate\Support\Facades\Route;

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

$prefixNews  = '';
Route::group(['prefix' => $prefixNews], function () {
    // ============================== HOMEPAGE ==============================
    $prefix         = '';
    $controller     = HomeController::class;
    Route::group(['prefix' =>  $prefix], function () use ($controller) {
        Route::get('/', [$controller, 'index'])->name('home');
    }); 

    // ============================== POSTS ==============================
    $prefix         = 'post';
    $controller     = PostController::class;
    Route::group(['prefix' =>  $prefix], function () use ($controller) {
        Route::get('/{post_name}.{post_id}', [$controller, 'index'])
            ->where('post_name', '[0-9a-zA-z_-]+')
            ->where('post_id', '[0-9]+')
            ->name('posts.index');
        Route::get('generate-voucher-code/{id}', [$controller, 'generateVoucherCode'])->middleware('auth')->name('posts.generateVoucherCode');
    }); 
    
    // ============================== CATEGORY ==============================
    $prefix         = 'category';
    $controller     = CategoryController::class;
    Route::group(['prefix' =>  $prefix], function () use ($controller) {
        Route::get('/{category_name}.{category_id}', [$controller, 'index'])
            ->where('category_name', '[0-9a-zA-z_-]+')
            ->where('category_id', '[0-9]+')
            ->name('categories.index');
    }); 
});

// auth
Route::get('login', [LoginController::class, 'login'])->middleware('check.login')->name('login');
Route::post('post-login', [LoginController::class, 'store'])->name('postLogin');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('dashboard', [LoginController::class, 'home'])->name('dashboard')->middleware('auth');

Route::get('not-permission', function () {
    return view('frontend.pages.notify.not-permission');  
})->middleware('auth')->name('not-permission');