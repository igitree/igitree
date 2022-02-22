<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User; 
use App\Http\Livewire\UserProfile\UserProfile;
use App\Http\Livewire\Family\FamilyCreation;
use App\Http\Livewire\Members\NewFamilyMember;
use App\Http\Livewire\Albums\Album;
use App\Http\Livewire\Albums\Show;
use App\Http\Livewire\Albums\Settings;
use App\Http\Livewire\Contact\App;
use App\Http\Livewire\Subcription\Pricing;
use App\Http\Livewire\Subcription\Thanks;
use App\Http\Livewire\Tree\TreeApp;
use App\Http\Livewire\Tree\AddNewFamilyMember;
use App\Http\Livewire\Chat\ChatApp;
use App\Http\Livewire\Chat\ViewMessages;
use App\Http\Livewire\DnaKit\DnaOrder;
use App\Http\Livewire\DnaKit\Checkout;
use App\Http\Livewire\DnaKit\Payments;
use Ramsey\Uuid\Uuid;
use App\Http\Livewire\FamilyStatus\StatusApp;
use App\Http\Livewire\FamilyStatus\ViewStatus;
use App\Http\Livewire\Notify\AllUpdates;
use App\Http\Livewire\Search\MakeSearch; 
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Http\Controllers\Stories\StoriesController;


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

Route::get('/', function () { 
    return redirect('/login');
}); 

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard')->with('success', 'Authenticated successfully');
})->name('dashboard'); 
Route::middleware('auth:sanctum','verified')->get('/profile/{user}',UserProfile::class)->name('singleprofile');
Route::middleware(['auth:sanctum', 'verified'])->get('/family',FamilyCreation::class)->name('family');

//tree
Route::middleware(['auth:sanctum', 'verified'])->get('/tree/view',TreeApp::class)->name('tree');
Route::middleware(['auth:sanctum', 'verified'])->get('/tree/view/{id}/add/member',AddNewFamilyMember::class)->name('newMember');

//chat
Route::middleware(['auth:sanctum', 'verified'])->get('/chat',ChatApp::class)->name('chat');
Route::middleware(['auth:sanctum', 'verified'])->get('/chat/user/{user}/chat',ViewMessages::class)->name('chat.user');

//Album
Route::middleware(['auth:sanctum', 'verified'])->get('/Album',Album::class)->name('album');
Route::middleware(['auth:sanctum', 'verified'])->get('/Album/{ablum_id}',Show::class)->name('albums.show');
Route::middleware(['auth:sanctum', 'verified'])->get('/Album/{ablum_id}/settings',Settings::class)->name('albums.settings');

//pricing
Route::middleware(['auth:sanctum', 'verified'])->get('/pricing',Pricing::class)->name('pricing');
Route::middleware(['auth:sanctum', 'verified'])->get('/igitree/confirm/Subscription',Thanks::class)->name('subscription');

//contact
Route::middleware(['auth:sanctum', 'verified'])->get('/contact',App::class)->name('contact');

//DNA kit
Route::middleware(['auth:sanctum', 'verified'])->get('/dna/order',DnaOrder::class)->name('dna');
Route::middleware(['auth:sanctum', 'verified'])->get('/dna/order/checkout',Checkout::class)->name('dnacheckout');

Route::middleware(['auth:sanctum','verified'])->get('/dna/confirm/payments',function(){ 
    if(request()->get('tx_ref') and request()->get('status') and request()->get('transaction_id')){
            if(request()->get('status')=='successful')
                {
                    $this->orders=Orders::where('o_uid',request()->get('tx_ref'));
                    $this->orders->update([
                    'o_status'=>2
                ]); 
                return redirect('/dna/order/checkout')->with('success','Payments done');
            }elseif(request()->get('status')=='cancelled'){ 
                return redirect('/dna/order/checkout')->with('error','Payments canceled');
            }
            
        }
})->name('payment');

//status
Route::middleware(['auth:sanctum', 'verified'])->get('/family/status',StatusApp::class)->name('status');

//updated
Route::middleware(['auth:sanctum', 'verified'])->get('/family/updates',AllUpdates::class)->name('updates');

//Status
Route::middleware(['auth:sanctum', 'verified'])->get('/family/status',StatusApp::class)->name('status');
// Route::middleware(['auth:sanctum', 'verified'])->get('/family/status/{status}/view',ViewStatus::class)->name('status.show');
Route::get('/family/status/{status}/view',[\App\Http\Controllers\Stories\StoriesController::class,'stories' ])->name('status.show');
//search  
Route::get('/family/search',MakeSearch::class)->name('search');

//Google login  
Route::get('/auth/google',[\App\Http\Controllers\auth\GoogleAuthController::class,'index' ])->name('loginwithgoogle'); 
Route::get('/auth/google/callback',[\App\Http\Controllers\auth\GoogleAuthController::class,'saveLogin' ]);


//facebook login  
Route::get('/auth/facebook',[\App\Http\Controllers\auth\FacebookAuthController::class,'index' ])->name('loginwithfacebook'); 
Route::get('/auth/facebook/callback',[\App\Http\Controllers\auth\FacebookAuthController::class,'saveLogin' ]);