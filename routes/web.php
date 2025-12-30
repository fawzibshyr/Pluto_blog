<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;



Route::view('/', 'get-started')->name('get-started');



Route::get('/home', [UserController::class, 'showDataInHome'])->name('home');


Route::get('/blog', [PostController::class, 'publicIndex'])->name('blog');
Route::get('/blog/load', [PostController::class, 'loadMore'])->name('blog.load');


Route::view('/about', 'about')->name('about');


Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');




Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');




Route::get('/dashboard', [UserController::class, 'home'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');


    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

});



Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {


    Route::get('/dashboard', [UserController::class, 'index'])->name('admin.dashboard');


    Route::get('/posts/edit', [AdminController::class, 'editIndex'])->name('admin.posts.edit.index');
    Route::get('/posts/delete', [AdminController::class, 'deleteIndex'])->name('admin.posts.delete.index');


    Route::get('/posts/{id}/edit', [AdminController::class, 'editPostPage'])->name('admin.posts.edit.page');


    Route::post('/posts/{id}/edit', [AdminController::class, 'updatePostSave'])->name('admin.posts.update');


    Route::post('/posts/{id}/delete', [AdminController::class, 'deletePostDo'])->name('admin.posts.destroy');

});



require __DIR__.'/auth.php';