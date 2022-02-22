<?php

namespace App\Http\Livewire\UserProfile;

use Livewire\Component;
use App\Models\User;
use DB;
use App\Models\ALbums;
class UserProfile extends Component
    {
    public $user;
    public $Albums;
    public $Family;
    public function mount(User $user)
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
        }
        if (!empty($userFamily)) {
            if ($userFamily->f_indentity != $authFamily->f_indentity) {
                return redirect()->back()->with('danger','unauthorized access'); 
            }
        }
       

    }
    public function render()
    {
        return view('livewire.user-profile.user-profile');
    }
}
