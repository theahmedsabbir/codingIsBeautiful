<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

//=============== Basic Routes ====================//
Route::get('cache', function () {
    \Artisan::call('cache:forget spatie.permission.cache');
    \Artisan::call('view:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    // session()->flush();
    dd("All clear!");
});

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

        //============ Product ================//
        Route::get('/product/manage', [App\Http\Controllers\Backend\ProductController::class, 'index']);
        Route::get('/product/create', [App\Http\Controllers\Backend\ProductController::class, 'create']);
        Route::post('/product/store', [App\Http\Controllers\Backend\ProductController::class, 'store']);
        Route::get('/product/edit/{product}', [App\Http\Controllers\Backend\ProductController::class, 'edit']);
        Route::post('/product/update/{product}', [App\Http\Controllers\Backend\ProductController::class, 'update']);
        Route::get('/product/delete/{product}', [App\Http\Controllers\Backend\ProductController::class, 'destroy']);
    });
});
