<?php

namespace App\Http\Controllers\auth\User;

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
        return Socialite::driver('google')->redirect();
    }

    public function saveLogin()
    {
        try{
        $user = Socialite::driver('google')->user();

        $userExisted = User::where('oauth_id', $user->id)->where('oauth_type','google')->first();
        if ($userExisted){
            $token= $user->createToken($user->email)->plainTextToken; 
            // Auth::login($userExisted);
            return[
                'Message'=>'User logged',
                'User'=>$userExisted,
                 'Token'=>$token
            ];

        }else { 
           $newUser=User::Create([ 
            'u_id'=>Uuid::uuid4()->toString(),
            'u_fullname'=>$user->name, 
            'u_email'=>$user->email,
            'oauth_id'=>$user->id,
            'oauth_type'=>'google', 
            //'u_image'=>$user->avatar_original,
            'password'=>Hash::make($user->name),
           ]);
           $token= $user->createToken($user->email)->plainTextToken;
             return[
                'Message'=>'User account created',
                'User'=>$newUser,
                'Token'=>$token
            ];
        }

    } catch(Exception $error){
        return[
                'Message'=>'Authentication failed', 
            ];
    }

    }
}
