<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\posts\PostsController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/', [App\Http\Controllers\posts\PostsController::class, 'index'])->name('welcome');

Route::get('/home', [App\Http\Controllers\posts\PostsController::class, 'index'])->name('home');

Route::group(['prefix' => 'posts'], function(){
    Route::get('/index', [App\Http\Controllers\posts\PostsController::class, 'index'])->name('posts.index');
    Route::get('/single/{id}', [App\Http\Controllers\posts\PostsController::class, 'single'])->name('posts.single');
    Route::post('/comment-store', [App\Http\Controllers\posts\PostsController::class, 'storeComment'])->name('comment.store');
    Route::get('/create-post', [App\Http\Controllers\posts\PostsController::class, 'CreatePost'])->name('posts.create');
    Route::post('/post-store', [App\Http\Controllers\posts\PostsController::class, 'storePost'])->name('posts.store');
    Route::get('/post-delete/{id}', [App\Http\Controllers\posts\PostsController::class, 'deletePost'])->name('posts.delete');

//update
Route::get('/post-edit/{id}', [App\Http\Controllers\posts\PostsController::class, 'editPost'])->name('posts.edit');
Route::post('/post-update/{id}', [App\Http\Controllers\posts\PostsController::class, 'updatePost'])->name('posts.update');


});

Route::group(['prefix' => 'categories'], function(){
    Route::get('/category/{name}', [App\Http\Controllers\categories\CategoriesController::class, 'category'])->name('category.single');
});

Route::group(['prefix' => 'users'], function(){
    Route::get('/edit/{id}', [App\Http\Controllers\Users\UsersController::class, 'editProfile'])->name('users.edit');
    Route::any('/update/{id}', [App\Http\Controllers\Users\UsersController::class, 'updateProfile'])->name('users.update');
});







