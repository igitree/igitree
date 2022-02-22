<?php
namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\User;

class AddNewFamilyMemberController extends Controller
{
    public $selectedUser;
    public $Admin;
    public function AddNewMember($user)
    {
        $this->Admin=auth()->user()->UserFamilyIsAdmin;
        if (!empty($this->Admin)) { 
            $this->selectedUser=User::find($user);
            if (!empty($this->selectedUser)) {

                $response=[
                    'View'=>auth()->user()->family,
                    'Message'=>'Access rights granted'
                ];
            }else{
              $response=[
                'View'=>0,
                    'Message'=>'User not found'
                ];  
            }
             
        }else{
            $response=[
                'View'=>0,
                'Admin'=>$Admin,
                'Message'=>'Access denied'
            ]; 
        }
        
        return response($response,201);
    }
}
