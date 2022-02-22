<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User; 
use Ramsey\Uuid\Uuid;

class FacebookAuthController extends Controller
{
    public function index()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function saveLogin()
    {
        try{

        $user = Socialite::driver('facebook')->user();

        $userExisted = User::where('oauth_id', $user->id)->where('oauth_type','facebook')->first();
        if ($userExisted){
            Auth::login($userExisted);
            return redirect()->route('dashboard');

        }else { 
           $newUser=User::Create([ 
            'u_id'=>Uuid::uuid4()->toString(),
            'u_fullname'=> $user->getName(), 
            'u_email'=>$user->getEmail(),
            'oauth_id'=>$user->getId(),
            'oauth_type'=>'facebook', 
            //'u_image'=>$user->avatar_original,
            'u_password'=>Hash::make($user->getId()),
           ]);
           Auth::login($newUser);
             return redirect()->route('dashboard');
        }

    } catch(Exception $error){
        return redirect()->route('login')->with('error', 'Authentication failed');
    }

    }
}
