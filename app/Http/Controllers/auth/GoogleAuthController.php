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


class GoogleAuthController extends Controller
{
    public function index()
    {
     try{ 
        return Socialite::driver('google')->redirect();
        } catch(Exception $error){
        return redirect()->route('login')->with('error', 'Authentication failed');
    }
    
    }

    public function saveLogin()
    {
        try{

        $user = Socialite::driver('google')->user();

        $userExisted = User::where('oauth_id', $user->id)->where('oauth_type','google')->first();
        if ($userExisted){
            Auth::login($userExisted);
            return redirect()->route('dashboard');

        }else { 
           $newUser=User::Create([ 
            'u_id'=>Uuid::uuid4()->toString(),
            'u_fullname'=>$user->name, 
            'u_email'=>$user->email,
            'oauth_id'=>$user->id,
            'oauth_type'=>'google', 
            //'u_image'=>$user->avatar_original,
            'u_password'=>Hash::make($user->id),
           ]);
           Auth::login($newUser);
             return redirect()->route('dashboard');
        }

    } catch(Exception $error){
        return redirect()->route('login')->with('error', 'Authentication failed');
    }

    }
}
