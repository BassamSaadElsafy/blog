<?php

 namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

 class SocialiteController extends Controller
 {

 public function redirect($provider)
 {
     return Socialite::driver($provider)->redirect();        //provider like google, github or facebook
 }

 public function callback(Request $request)
 {
 	// dd('callback');

     dd($request->provider);

   $getInfo = Socialite::driver('')->user(); 
   dd($getInfo);
   $user = $this->create($getInfo,''); 
   Auth::login($user); 
   return redirect()->to('/home');
 }

 function create($getInfo,$provider)
 {

   $user = User::where('provider_id', $getInfo->id)->first();
   if (!$user) {
        $user = User::create([
           'name'     => $getInfo->name,
           'email'    => $getInfo->email,
           'provider' => $provider,
           'provider_id' => $getInfo->id
       ]);
     }
     return $user;
  }

}