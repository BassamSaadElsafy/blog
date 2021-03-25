<?php

 namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{

  public function redirectToProviderGithub(){
    return Socialite::driver('github')->redirect();
  }

  public function redirectToProviderGoogle(){
    return Socialite::driver('google')->redirect();
  }

  public function handleProviderCallbackGithub()
  {

    try 
    {
        $user   = Socialite::driver('github')->stateless()->user();
        $data   = ['name' => $user->name , 'email' => $user->email , 'password' =>$user->token ];
        $userDB = User::where('email', $user->email)->first();
    
        if (is_null($userDB)) {
            $userDB = User::create($data);
        }

        Auth::login($userDB);
        return redirect()->route('posts.index');
    }catch(Exception $ex){

        session()->flash('error_msg' , 'Something went wrong!!');
        return redirect()->route('posts.login');
    }

  }

  public function handleProviderCallbackGoogle()
  {
    try 
    {
      $user     = Socialite::driver('google')->stateless()->user();
      $finduser = User::where('email', $user->email)->first();
      if($finduser)
      {
        Auth::login($finduser);

      }
      else
      {
        $newUser = User::create([
                                    'name'     => $user->name,
                                    'email'    => $user->email,
                                    'password' => $user->token
                                ]);
        Auth::login($newUser);
      }

    return redirect()->route('posts.index');

    }
    catch(Exception $ex) 
    {
      session()->flash('error_msg' , 'Something went wrong!!');
      return redirect()->route('posts.login');
    }
  }

}//end of controller