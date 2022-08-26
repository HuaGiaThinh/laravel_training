<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

$prefixAdmin = 'admin';
Route::group(['prefix' => $prefixAdmin, 'middleware' => ['auth']], function () {

    // ================================= USERS =================================
    $prefix = 'users';
    $controller = UserController::class;
    Route::group(['prefix' => $prefix], function () use ($prefix, $controller) {
        Route::get('', [$controller, 'index'])->name($prefix);
        Route::get('form/{id?}', [$controller, 'form'])->where('id', '[0-9]+')->name("$prefix.form");
        Route::post('save', [$controller, 'save'])->name("$prefix.save");
        Route::get('delete/{id}', [$controller, 'delete'])->where('id', '[0-9]+')->name("$prefix.delete");
        Route::get('change-status/{status}-{id}', [$controller, 'changeStatus'])->name("$prefix.changeStatus");
    });

    // ================================= CATEGORIES =================================
    $prefix = 'categories';
    $controller = CategoryController::class;
    Route::group(['prefix' => $prefix], function () use ($prefix, $controller) {
        Route::get('', [$controller, 'index'])->name($prefix);
        Route::get('form/{id?}', [$controller, 'form'])->where('id', '[0-9]+')->name("$prefix.form");
        Route::post('save', [$controller, 'save'])->name("$prefix.save");
        Route::get('delete/{id}', [$controller, 'delete'])->where('id', '[0-9]+')->name("$prefix.delete");
        Route::get('change-status/{status}-{id}', [$controller, 'changeStatus'])->name("$prefix.changeStatus");
        Route::get('update-tree', [$controller, 'updateTree'])->name("$prefix.updateTree");
    });

    // ================================= POSTS =================================
    $prefix = 'posts';
    $controller = PostController::class;
    Route::group(['prefix' => $prefix], function () use ($prefix, $controller) {
        Route::get('',              [$controller, 'index'])->name($prefix);
        Route::get('form/{id?}', [$controller, 'form'])->where('id', '[0-9]+')->name("$prefix.form");
        Route::post('save', [$controller, 'save'])->name("$prefix.save");
        Route::get('delete/{id}', [$controller, 'delete'])->where('id', '[0-9]+')->name("$prefix.delete");
        Route::get('change-status/{status}-{id}', [$controller, 'changeStatus'])->name("$prefix.changeStatus");
        Route::get('change-selectBox/{category_id}-{id}', [$controller, 'changeSelectBox'])->name("$prefix.changeSelectBox");
    });
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
