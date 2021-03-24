<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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


Route::get('/auth/redirect', function () {

    return Socialite::driver('github')->redirect();
    
})->name('github.login');

Route::get('/auth/callback', function () {
    
    $user = Socialite::driver('github')->stateless()->user();

    $data = ['name' => $user->name , 'email' => $user->email , 'password' =>$user->token ];
    
    $userDB = User::where('email' , $user->email)->first(); 
    
    if(is_null($userDB)){
        
        $userDB = User::create($data);
    }


    Auth::login($userDB);

    return redirect()->route('posts.index');

});



Route::get('auth/google', function(){
    return Socialite::driver('google')->redirect();
})->name('google.login');
Route::get('auth/google/callback', function(){
    try {
    
        $user = Socialite::driver('google')->user();
 
        $finduser = User::where('email', $user->email)->first();
 
        if($finduser){
 
            Auth::login($finduser);

            return redirect()->route('posts.index');
 
        }else{
            $newUser = User::create([
                'name'     => $user->name,
                'email'    => $user->email,
                'password' => $user->token
            ]);

            Auth::login($newUser);
 
            return redirect()->route('posts.index');
        }

    } catch (Exception $e) {
        dd($e->getMessage());
    }

});
