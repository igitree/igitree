<?php

namespace App\Http\Livewire\Family;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\NewFamily;
use App\Models\Family;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State; 
use DB;
use Ramsey\Uuid\Uuid;
use App\Models\FamilyRequests;
use Mail;
class FamilyCreation extends Component
{
    public $state;
    public $user;
    public $family;
    public $chooseId=false;
    public $chooseInfo=false;
    public $searchBy;
    public $familyId; 
    public $created=false;
    public $error;
    public $name;
    public $showrequestForm=false;
    public $closerequestForm=false;
    public $userTosave;  
    public $fRelation;
    public $to;
    public $fAInfo;
    public $checkexistance;
    public $userTyped;

    public function switchSearch()
    {
        if ($this->searchBy == 'FamilyId') {
            $this->chooseInfo=false;
            $this->chooseId=true;
        }elseif ($this->searchBy == 'userInfo') {
           $this->chooseInfo=true;
            $this->chooseId=false;
        }else{
           $this->chooseInfo=false;
            $this->chooseId=false; 
        }

       
    }

    public function searching()
    {
        // $this->user=auth()->user()->u_id; 
        // $this->family = Family::Where('user_id',$this->user)->first();
        // if ($this->family) {
        // $this->state =$this->family->toArray(); 
        // }
        // $this->allCountries = Country::all(); 
        // $this->user=auth()->user();  
         if ($this->searchBy == 'FamilyId') {
            if (!empty($this->familyId)) { 
                $this->family=DB::table('tbl_users')
                        ->join('family__creators', 'family__creators.user_id', '=', 'tbl_users.u_id') 
                        ->join('tbl_family', 'family__creators.user_id','=','tbl_family.f_id')
                        ->where('family__creators.id',$this->familyId) 
                        ->get(); 

            }
           
            }elseif ($this->searchBy == 'userInfo'){ 
                if ($this->state != '') { 
                    if (!empty($this->state['u_fullname']) and empty($this->state['u_email'])) {
                         $this->family=DB::table('tbl_users')
                                        ->join('family__creators', 'family__creators.user_id', '=', 'tbl_users.u_id') 
                                        ->join('tbl_family', 'family__creators.user_id','=','tbl_family.f_id')
                                        ->where('tbl_users.u_fullname',$this->state['u_fullname']) 
                                         ->get(); 
                         $this->name=$this->state['u_fullname'];

                     }elseif(!empty($this->state['u_email']) and empty($this->state['u_fullname']) ){
                        $this->family=DB::table('tbl_users')
                                        ->join('family__creators', 'family__creators.user_id', '=', 'tbl_users.u_id') 
                                        ->join('tbl_family', 'family__creators.user_id','=','tbl_family.f_id')
                                        ->where('tbl_users.u_email',$this->state['u_email']) 
                                         ->get(); 
                         $this->name=$this->state['u_email'];

                     }elseif (!empty($this->state['u_email']) and !empty($this->state['u_fullname'])) {

                          $this->family=DB::table('tbl_users') 
                                        ->join('family__creators', 'family__creators.user_id', '=', 'tbl_users.u_id') 
                                        ->join('tbl_family', 'family__creators.user_id','=','tbl_family.f_id')
                                        ->where('tbl_users.u_email',$this->state['u_email']) 
                                        ->where('tbl_users.u_fullname',$this->state['u_fullname']) 
                                        ->get(); 

                         $this->name=$this->state['u_fullname'].", ".$this->state['u_email'];
                     }
                     else{
                        $this->error="Unkown information provided.";
                          $this->family=null;
                     }
              
                } 
            } 
    } 


   public function showrequestForm($user)
    { 
        $this->showrequestForm=true;  
        $this->userTosave=NewFamily::findOrfail($user);       
    }

    public function closerequestForm()
    {
        $this->showrequestForm=false; 
      $this->closerequestForm=true;  
    }


    public function searchingUserRelatedTo()
    {
      
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
                  try {
                    $familyFMOnTree=User::where('u_email',$this->to)
                                                ->orWhere('u_phoneline',$this->to)
                                                ->orWhere('u_fullname', $this->to)
                                                ->get()->first(); 
                        if (($familyFMOnTree != null)) {
                            $details = [ 
                                'title' => "Family invitation",
                                'body' => "New request from ".auth()->user()->u_fullname. " to join family as ".$this->fRelation ." of ".$familyFMOnTree->u_fullname, 
                              ]; 

                        $mail=Mail::to($familyFMOnTree->u_email)->send(new \App\Mail\familyRequests($details));
                        } 
                    } catch (Exception $e) {
                         $this->dispatchBrowserEvent('error',['message'=>"Unable to add notification mail"]);
                    }
                
            }else{
                $this->dispatchBrowserEvent('error',['message'=>"Unable to send request"]);  
            }
    }else{
         $this->dispatchBrowserEvent('error',['message'=>"Request already sent"]); 
    }



              
    }

    public function SaveFamily()
    {

        $family=NewFamily::where('user_id',auth()->user()->u_id)->get()->first();
        // if ($family) {
            if ($family==null){ 
                $savingfamily=NewFamily::Create([
                            'id'=>Uuid::uuid4()->toString(),
                            'user_id'=>auth()->user()->u_id, 
                        ]);
                if ($savingfamily) { 

                    $checkAddedByOFamily= Family::where('f_id',auth()->user()->u_id)
                                ->get()->first(); 
 
                        if ($checkAddedByOFamily==null) {
                            $family=NewFamily::where('user_id',auth()->user()->u_id)->get()->first(); 

                            if ($family !=null) {
                                $savingfamily=Family::Create([
                                    'f_id'=>$family->user_id,
                                    'f_indentity'=>$family->id, 
                                ]);
                                    return redirect()->route('tree');
                            }else{
                               $this->dispatchBrowserEvent('error',['message'=>"Error occurred unable to find user"]); 
                           }  
                        }else{
                            $family=NewFamily::where('user_id',auth()->user()->u_id)->get()->first();  
                            //send request to creator
                            Family::update(['f_identity'=>$family->id])->where('f_id',$family->user_id);
                             $this->dispatchBrowserEvent('success',['message'=>"Process done"]);
                        } 


                }else{
                    $this->dispatchBrowserEvent('error',['message'=>"Error occurred while creating family"]);
                } 
       
            }else{ 
                $this->dispatchBrowserEvent('error',['message'=>"You Already Created family"]);
            }
        // }else{
        //     dd("hgfdbg");
        //      $this->dispatchBrowserEvent('error',['message'=>"Error occurred while creating family"]);
        // } 
            
        return redirect()->back();



    } 



    public function render()
    { 
        $this->family=DB::table('tbl_users')
                        ->join('family__creators', 'family__creators.user_id', '=', 'tbl_users.u_id') 
                        ->join('tbl_family', 'family__creators.user_id','=','tbl_family.f_id')
                        ->where('family__creators.id',$this->familyId) 
                        ->get(); 
         $this->checkexistance=FamilyRequests::where('user_requested',auth()->user()->u_id)->get()->first();
        $this->created=NewFamily::where('user_id',auth()->user()->u_id)->get()->first();
        return view('livewire.family.family-creation');
    }
}
