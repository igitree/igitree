<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\User\UserAuthenticationController;
use App\Http\Controllers\auth\User\UserProfileController;
use App\Http\Controllers\auth\User\GoogleAuthController;
use App\Http\Controllers\Family\FamilyCreationController;
use App\Http\Controllers\Family\AddNewFamilyMemberController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'igitree'],function(){
Route::POST('register',[UserAuthenticationController::class,'Register']);
Route::middleware('auth:sanctum')->get('/usersList', function () {
    $response=[
                'Users'=>\App\Models\User::all(),
                'Message'=>'Access rights granted'
            ];
    return response($response,201);
});

Route::POST('login',[UserAuthenticationController::class,'Login']);
Route::POST('/auth/google',[GoogleAuthController::class,'index']);
Route::POST('/auth/google/callback',[GoogleAuthController::class,'saveLogin' ]);

});


Route::group(['middleware'=>'auth:sanctum','prefix'=>'igitree'],function(){
//User related apis
Route::POST('logout',[UserAuthenticationController::class,'Logout']);
Route::PUT('update/user',[UserAuthenticationController::class,'Update']); 
Route::PUT('update/password',[UserAuthenticationController::class,'updatePassword']);
Route::PUT('update/imge/user',[UserAuthenticationController::class,'updateProfileImage']);
Route::get('user/view/{user}/profile',[UserProfileController::class,'Profile']);

//family members and family creation
Route::get('/family',[FamilyCreationController::class,'index']);
Route::POST('family/save',[FamilyCreationController::class,'SaveFamily']); 

// adding family member on tree
Route::POST('family/add/{user}/new',[AddNewFamilyMemberController::class,'AddNewMember']); 

});