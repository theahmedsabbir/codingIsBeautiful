<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

//=============== Basic Routes ====================//
Route::get('cache', function () {
    \Artisan::call('cache:forget spatie.permission.cache');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:cache');
    \Artisan::call('route:cache');
    \Artisan::call('view:cache');
    \Artisan::call('cache:clear');
    // session()->flush();
    dd("All clear!");
});

// Route::post('admin/category/store', function () {
//     dd('yes');
// });

//=============== Frontend Routes ====================//

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index'])->name('root');
Route::get('/sp', [App\Http\Controllers\Frontend\FrontendController::class, 'sp'])->name('sp');

Auth::routes();


//=============== Admin Login ====================//
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [App\Http\Controllers\Backend\AdminController::class, 'loginForm']);
    Route::post('/login', [App\Http\Controllers\Backend\AdminController::class, 'login']);
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/dashboard', [App\Http\Controllers\Backend\AdminController::class, 'dashboard']);
        Route::post('/logout', [App\Http\Controllers\Backend\AdminController::class, 'logout']);

        //============ Category ================//
        Route::get('/category/manage', [App\Http\Controllers\Backend\CategoryController::class, 'index']);
        Route::get('/category/create', [App\Http\Controllers\Backend\CategoryController::class, 'create']);
        Route::post('/category/store', [App\Http\Controllers\Backend\CategoryController::class, 'store']);
        Route::get('/category/edit/{category}', [App\Http\Controllers\Backend\CategoryController::class, 'edit']);
        Route::post('/category/update/{category}', [App\Http\Controllers\Backend\CategoryController::class, 'update']);
        Route::get('/category/delete/{category}', [App\Http\Controllers\Backend\CategoryController::class, 'destroy']);

        //============ Product ================//
        Route::get('/product/manage', [App\Http\Controllers\Backend\ProductController::class, 'index']);
        Route::get('/product/create', [App\Http\Controllers\Backend\ProductController::class, 'create']);
        Route::post('/product/store', [App\Http\Controllers\Backend\ProductController::class, 'store']);
        Route::get('/product/edit/{product}', [App\Http\Controllers\Backend\ProductController::class, 'edit']);
        Route::post('/product/update/{product}', [App\Http\Controllers\Backend\ProductController::class, 'update']);
        Route::get('/product/delete/{product}', [App\Http\Controllers\Backend\ProductController::class, 'destroy']);
    });
});
