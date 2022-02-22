<?php

namespace App\Http\Controllers\auth\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Image;
use Illuminate\Support\Facades\Hash;
class UserAuthenticationController extends Controller
{
    public function Register(Request $request)
    {

       $request->validate([
                'fullname'=>'required|string',
                'email'=>'required|email|unique:tbl_users,u_email',
                'password'=>'required|confirmed|min:4'
        ]);

        $user=User::create([
            'u_id'=>Uuid::uuid4()->toString(),
            'u_fullname' => $request->fullname,
            'u_email' => $request->email,
            'u_password' => Hash::make($request->password),
        ]);
        
        $token= $user->createToken($request->email)->plainTextToken;

        $response=[
                'Message'=>'user created now',
                'User'=>$user,
                'Token'=>$token
            ];
        Auth::login($user);
        return response($response,  201);

    }
  
    public function Login(Request $request)
    { 
         $request->validate([ 
                'email'=>'required|email',
                'password'=>'required'
        ]);

        $user = User::where('u_email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->u_password)) {
               return response([ 
                    'email' => ['The provided credentials are incorrect.']
                ],404);
            }
            $token= $user->createToken($request->email)->plainTextToken;
        $response=[
            'Message'=>'User logged',
            'User'=>$user,
           
        ];
        Auth::login($user);
        return response($response, 201);


    }

    public function Logout(Request $request){
        
        auth()->user()->tokens()->delete(); 
        $response=[
            'Message'=>'Logged out'];
        return response($response, 201);
    }

    public function Update(Request $request){
        $request->validate([
                'fullname'=>'required|string',
                'email'=>'required|email|unique:tbl_users,u_email', 
                'dob'=>'required',
                'address'=>'required',
                'phoneline'=>'required',
                'country'=>'required',
                'phoneline'=>'required',
                'gender'=>'required',
        ]);
        $user=User::find(auth()->user()->u_id);
        $user->update([
                'u_fullname' => $request->fullname,
                'u_email' => $request->email,
                'u_dob'=>$request->dob,
                'u_address'=>$request->address,
                'u_phoneline'=>$request->phoneline, 
                'u_gender'=>$request->gender,
                'u_country'=>$request->country,
                ]);  
         $response=[
            'User'=> $user,
            'Message'=>'Updated'];
        return response($response, 201);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
                'current_password' =>'required', 
                'password'=>'required|confirmed|min:4'
        ]); 

            $user=User::where('u_id',auth()->user()->u_id)->first();

            if (! $user || ! Hash::check($request->current_password, $user->u_password)) {
               return response([ 
                    'Current password' => ['The provided cuurent password is incorrect.']
                ],404);
            }else{
                $user->update([
                            'u_password'=>Hash::make($request->password),
                            ]);
             $response=[
                        'Message'=>'User password changed',
                        'user'=>$user,
                    ];
            }

         return response($response, 201);

    }




    public function updateProfileImage(Request $request){
                
                $user=User::find(auth()->user()->u_id);
                $image = $request->profile_photo;

                $response=[
                                'Name'=> $request->all(),
                                'Message'=>'image is empty'];
                return response($response, 201);

                // if (!empty($image)) {
                    
                //     $input['file'] = time().'.'.$image->getClientOriginalExtension();
                //     $imgFile = Image::make($image->getRealPath()); 

                //     try { 

                //     $imgFile->save(public_path('/storage/profile-photos').'/'.$input['file']);
                //     $response=[
                //                 'message'=>' photo added'];
                //     } catch (Exception $e) {

                //         $response=[
                //                 'message'=>'Error Occured photo not added'];
                        
                //         return response($response, 201);
                //     }
                // }else{
                //      $response=[
                //                 'image'=> $image,
                //                 'message'=>'image is empty'];
                        
                //     return response($response, 201); 
                // }
    }


}
