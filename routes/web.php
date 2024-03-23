<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/article/{slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'show'])->name('show');
Route::post('/article/{slug}/react', [App\Http\Controllers\Frontend\FrontendController::class, 'react'])->name('react');
Route::get('/category/{slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'showCategoryPosts'])->name('showCategoryPosts');
Route::get('/tag/{slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'showTagPosts'])->name('showTagPosts');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    //=============== Post ====================//
    Route::get('/new', [App\Http\Controllers\Frontend\PostController::class, 'new'])->name('new');
    Route::get('/dashboard', [App\Http\Controllers\Frontend\PostController::class, 'dashboard'])->name('dashboard');
    Route::post('/new/submit', [App\Http\Controllers\Frontend\PostController::class, 'store'])->name('post.store');
    Route::get('/post/edit/{slug}', [App\Http\Controllers\Frontend\PostController::class, 'editPost'])->name('post.edit');
    Route::post('/post/update/{slug}', [App\Http\Controllers\Frontend\PostController::class, 'updatePost'])->name('post.update');
    Route::post('/post/delete/{slug}', [App\Http\Controllers\Frontend\PostController::class, 'deletePost'])->name('post.delete');

});

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

        //============ Tag ================//
        Route::get('/tag/manage', [App\Http\Controllers\Backend\TagController::class, 'index']);
        Route::get('/tag/create', [App\Http\Controllers\Backend\TagController::class, 'create']);
        Route::post('/tag/store', [App\Http\Controllers\Backend\TagController::class, 'store']);
        Route::get('/tag/edit/{tag}', [App\Http\Controllers\Backend\TagController::class, 'edit']);
        Route::post('/tag/update/{tag}', [App\Http\Controllers\Backend\TagController::class, 'update']);
        Route::get('/tag/delete/{tag}', [App\Http\Controllers\Backend\TagController::class, 'destroy']);

        //============ Product ================//
        Route::get('/product/manage', [App\Http\Controllers\Backend\ProductController::class, 'index']);
        Route::get('/product/create', [App\Http\Controllers\Backend\ProductController::class, 'create']);
        Route::post('/product/store', [App\Http\Controllers\Backend\ProductController::class, 'store']);
        Route::get('/product/edit/{product}', [App\Http\Controllers\Backend\ProductController::class, 'edit']);
        Route::post('/product/update/{product}', [App\Http\Controllers\Backend\ProductController::class, 'update']);
        Route::get('/product/delete/{product}', [App\Http\Controllers\Backend\ProductController::class, 'destroy']);

        //============ Post ================//
        Route::get('/post/manage', [App\Http\Controllers\Backend\PostController::class, 'index']);
        Route::get('/post/create', [App\Http\Controllers\Backend\PostController::class, 'create']);
        Route::post('/post/store', [App\Http\Controllers\Backend\PostController::class, 'store']);
        Route::get('/post/edit/{post}', [App\Http\Controllers\Backend\PostController::class, 'edit']);
        Route::post('/post/update/{post}', [App\Http\Controllers\Backend\PostController::class, 'update']);
        Route::get('/post/delete/{post}', [App\Http\Controllers\Backend\PostController::class, 'destroy']);
    });
});
