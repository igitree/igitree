<?php

namespace App\Http\Controllers\auth\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Models\ALbums;
class UserProfileController extends Controller
{
    public $user;
    public $Albums;
    public $Family;

    public function Profile(User $user)
    {
        $this->user=$user;  
        $this->Albums= $this->user->albums()->latest()->get();

        $authFamily=DB::table('tbl_family') 
                        ->where('tbl_family.f_id',auth()->user()->u_id)
                        ->get()->first();
        
        $userFamily=DB::table('tbl_family') 
                        ->where('tbl_family.f_id',$user->u_id)
                        ->get()->first(); 

        if (!empty($userFamily)) {
            $this->Family=DB::table('tbl_users')
                        ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id') 
                        ->where('tbl_family.f_indentity',$userFamily->f_indentity) 
                        ->get();

            if ($userFamily->f_indentity != $authFamily->f_indentity) {
                $response = [ 
                    'View'=>0,
                    'Message'=>'unauthorized access',
                    ];
            }
        }
        $response = [ 
                    'View'=>1,
                    'Message'=>'authorized access',
                    'User'=>$this->user,
                    'Family'=>$this->Family,
                    'Albums'=>$this->Albums,
                    ];

        return response($response,  201);

    }
}
