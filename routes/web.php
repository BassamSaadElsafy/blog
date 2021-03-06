<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SocialiteController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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


//group route for posts using auth middleware
Route::middleware('auth')->group(function () {
    
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::post('/posts/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::get('/posts/show/ajax', [PostController::class, 'get_post_response'])->name('posts.ajax_show');
    Route::any('/posts/logout', [PostController::class, 'logout'])->name('posts.logout');

});

Auth::routes();             //contains all routes related to Auth Middleware
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//==========================================Socialite Routes================================================//
Route::get('/auth/redirect', [SocialiteController::class, 'redirectToProviderGithub'] )->name('github.login');
Route::get('auth/google', [SocialiteController::class, 'redirectToProviderGoogle'])->name('google.login');

Route::get('/auth/callback', [SocialiteController::class, 'handleProviderCallbackGithub']);
Route::get('/auth/google/callback',  [SocialiteController::class, 'handleProviderCallbackGoogle']);
//==========================================================================================================//