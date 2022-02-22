<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;
use DB;
use App\Models\User;
use App\Models\Family;
use Ramsey\Uuid\Uuid;
use App\Models\NewFamily;
use App\Models\FamilyRequests;
use Mail;
class MakeSearch extends Component
{
    public $u_fullname;
    public $u_email;
    public $u_partener;
    public $u_address;
    public $family;
    public $u_dob;
    public $familycode;
    public $showrequestForm=false;
    public $closerequestForm=false;
    public $users;
    public $checkuserFamily;
    public $WivesorHusbands;
    public $AddSpouse=false;
    public $s_names;
    public $s_email;
    public $s_phone;
    public $spouseSuggestions;
    public $singlePerson;
    public $FamilyMemberSuggestions;
    public $f_code;
    public $fRelation;
    public $to;
    public $userTosave;
    public $fAInfo;
    public $familyidentification;

     public function closerequestForm()
    {
    $this->showrequestForm=false; 
      $this->closerequestForm=true;
      $this->WivesorHusbands=null;
        $this->FamilyMemberSuggestions =null; 
    }

     public function showrequestForm($user)
    { 

        $this->showrequestForm=true;
        $this->family=null;
        $this->userTyped=User::where('u_id',$user)->get();
        $this->to=$this->userTyped[0]->u_fullname;
        $this->userTosave=NewFamily::find($user); 
      
        $this->familyidentification=Family::find($user); 

    }

     public function searchingTypedUser()
    {  
        $this->userTyped=User::where('u_email',$this->to)
                            ->orWhere('u_phoneline',$this->to)
                            ->orWhere('u_fullname',$this->to)->get();
        
    }

    public function SendRequest()
    { 

       $this->checkexistance=FamilyRequests::where('user_requested',auth()->user()->u_id)->get()->first();

        if ($this->checkexistance == null) {
        if ( $this->userTosave != null) { 
            if (!empty($this->fAInfo) or !empty($this->fRelation) or !empty($this->to)) {
                    $sendrequest=FamilyRequests::create([
                        'family_id'=>$this->userTosave->id,
                        'user_requested'=>auth()->user()->u_id,
                        'info'=>$this->fAInfo,
                        'accepted'=>0,
                        'relation'=>$this->fRelation,
                        'to'=>$this->to,
                    ]);
                     $this->dispatchBrowserEvent('success',['message'=>"Request was successfully sent"]); 
                }else{
                    $this->dispatchBrowserEvent('error',['message'=>"Unable to send request"]);  
                }
            }else{

                if ($this->familyidentification != null) {
                     if (!empty($this->fAInfo) or !empty($this->fRelation) or !empty($this->to)) {
                        $sendrequest=FamilyRequests::create([
                            'family_id'=>$this->familyidentification->f_indentity,
                            'user_requested'=>auth()->user()->u_id,
                            'info'=>$this->fAInfo,
                            'accepted'=>0,
                            'relation'=>$this->fRelation,
                            'to'=>$this->to,
                        ]);
                         $this->dispatchBrowserEvent('success',['message'=>"Request was successfully sent"]); 
                    }else{
                        $this->dispatchBrowserEvent('error',['message'=>"Unable to send request"]);  
                    }

                }else{
                  $this->dispatchBrowserEvent('error',['message'=>"Unable to send request"]);   
                }
            }

        }else{
             $this->dispatchBrowserEvent('error',['message'=>"Request already sent"]); 
        }



    }

    public function AddFiltersSpouse()
    {
        $this->AddSpouse=true;
        $this->family=null;
        $this->WivesorHusbands=null;
        $this->FamilyMemberSuggestions =null; 
    }

    public function RemoveFiltersSpouse()
    {
         $this->AddSpouse=False;    
          $this->family=null;
          $this->WivesorHusbands=null;
        $this->FamilyMemberSuggestions =null; 
    }

    public function searching()
    { 

      if (!empty($this->u_fullname)) { 
            $this->family=DB::table('tbl_users')
                        ->join('tbl_family', 'tbl_family.f_id', '=', 'tbl_users.u_id')  
                        ->where('tbl_users.u_fullname','like', '%'.$this->u_fullname.'%') 
                        ->orWhere('tbl_users.u_email',$this->u_email) 
                        ->orWhere('tbl_users.u_dob', $this->u_dob)
                        ->get();  

             if ($this->AddSpouse) {  
                $this->WivesorHusbands=DB::table('tbl_users')
                        ->join('tbl_family', 'tbl_family.f_id', '=', 'tbl_users.u_id')  
                        ->where('tbl_users.u_fullname',$this->s_names) 
                        ->orWhere('tbl_users.u_email',$this->s_email) 
                        ->orWhere('tbl_users.u_phoneline', $this->s_phone)
                        ->get();  
                    }
 
              if (count($this->family) != 0 or count($this->family) >0) { 
            
                    $this->FamilyMemberSuggestions=DB::table('tbl_users')
                        ->join('tbl_family', 'tbl_family.f_id', '=', 'tbl_users.u_id')  
                        ->where('tbl_family.f_indentity',$this->family[0]->f_indentity) 
                        ->inRandomOrder() 
                        ->limit(4)
                        ->get(); 
                } 

        }
        if (!empty($this->f_code)) {
            $this->family=DB::table('tbl_users')
                        ->join('tbl_family', 'tbl_family.f_id', '=', 'tbl_users.u_id')
                        ->join('family__creators','family__creators.user_id','=','tbl_family.f_id')  
                        ->where('tbl_family.f_indentity',$this->f_code) 
                        ->limit(10)
                        ->get();

        }
        elseif(empty($this->f_code) and empty($this->u_fullname)){
            $this->dispatchBrowserEvent('error',['message'=>"error all information is required "]); 
        }




    }
    public function render()
    {
    
        return view('livewire.search.make-search');
    }
}
