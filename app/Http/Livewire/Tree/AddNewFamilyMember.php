<?php

namespace App\Http\Livewire\Tree;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Family;
use DB;
use App\Models\NewFamily; 
use Mail;
use App\Mail\FamilyRequests; 
use App\Models\Request_User_Join_Family;
class AddNewFamilyMember extends Component
{
    public $UserRoot;
    public $state=[]; 
    public $email; 
    public $phone;
    public $error=0;
    public $success=0;
    public $userAddedId;
    public $familyFatherAndMother;
    public $gender;
    public $messages;
    public $RetrieveRelatives;
    public  $relativeMessage;
    public $RetrieveRelativesFamily;
    public $MotherFatherSearched;
    public $familycode;
    public $Cgender;
    public $AdduserByCode=0;
    public $code;
    public $FindUserCodes;
    public $userTosave;


    public function mount($id)
    { 
        $this->familyFMOnTree=User::where('u_id',$id)->get()->first(); 
             if(empty($this->familyFMOnTree)) { 
                return redirect()->route('tree');
                $this->dispatchBrowserEvent('error',['message'=>"Cant't find user"]); 
            }else{
                   if ($this->familyFMOnTree->u_gender == 'Male') {
                        $this->gender='M';
                    }else{
                        $this->gender='F';
                    } 
                }

        if(!empty($this->familyFMOnTree)){
            $this->familyFatherAndMother=Family::where('f_id',$this->familyFMOnTree->u_id)->get()->first();
        
        }

        $this->familyFMOnTreeAdmin=NewFamily::where('user_id',auth()->user()->u_id)->get()->first();
 

        if (empty($this->familyFMOnTreeAdmin)) {
            return redirect()->route('tree')->with('error', 'Unable to add family member');
            $this->dispatchBrowserEvent('error',['message'=>"Unable to add family member"]); 
        }else{
            $this->familycode=$this->familyFMOnTreeAdmin->id;
        }
    }

    public function searchRelatives()
    { 

        if(!empty($this->state)){ 
            if ($this->state['fullname']) {
               $this->RetrieveRelatives = User::where('u_phoneline',$this->phone)
                                ->orWhere('u_email',$this->email)
                                ->orWhere('u_phoneline',$this->state['fullname']) 
                                ->get();

            } 
            if (!empty($this->RetrieveRelatives)) { 

                $this->RetrieveRelativesFamily=DB::table('tbl_users')
                                    ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id') 
                                    ->where('tbl_family.f_id',$this->RetrieveRelatives[0]->u_id)
                                    ->get()->first();


              //   if (!empty($this->RetrieveRelativesFamily)) { 
              //        $this->MotherFatherSearched=DB::table('tbl_users')
              //                       ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id') 
              //                       ->whereIn('tbl_users.u_id',[$this->RetrieveRelativesFamily->f_fathers,$this->RetrieveRelativesFamily->f_mothers]) 
              //                       ->get()->first();  
              //                       dd($this->RetrieveRelativesFamily);
              //   }
              //   else{
              //        $this->relativeMessage="If any relative found they will be displayed here.";
              // } 
                                    

              }else{
                     $this->relativeMessage="If any relative found they will be displayed here.";
              }  
        }else{
           $this->relativeMessage="If any relative found they will be displayed here.";
        }
         

    }
 
    public function messages()
    {
         if ($this->state['relation']) {
            if ($this->state['relation']== 'Father') {
                $this->messages="Add father";
            }elseif ($this->state['relation']== 'Mother') {
                $this->messages="Add mother ";
            }elseif ($this->state['relation']== 'Child') {
                $this->messages="Add child ";
            }elseif ($this->state['relation']== 'Wife') {
               $this->messages="Add wife"; 
            }elseif ($this->state['relation']=='Husband') {
                $this->messages="Add husband"; 
            }else{
                $this->messages="";
            }
         }
    }


    public function changeTheWayToAddUser()
    { 
        if ($this->AdduserByCode=='info') {
            $this->AdduserByCode='info';
        }elseif($this->AdduserByCode=='code'){
            $this->AdduserByCode='code';
        }else{
            $this->AdduserByCode='';
        }
    }


    public function checkcodes()
    {
        $this->FindUserCodes= User::where('u_id',$this->code)
                        ->get()->first();

        if ($this->FindUserCodes) {
            if (!empty($this->FindUserCodes)) {
                $this->dispatchBrowserEvent('success',['message'=>'Records found']);

            }else{
                 $this->dispatchBrowserEvent('error',['message'=>'Error Occured User anot found']); 
            }
        }else{
             $this->dispatchBrowserEvent('error',['message'=>'Error Occured unable to find user']); 
        }
    }

    public function AddNewFamilyMember()
    {     
        if ($this->AdduserByCode == 'code') {
            
            if (!empty($this->FindUserCodes)) {
               
                $FindUserCodesFromFamily= Family::where('f_id',$this->FindUserCodes->u_id)
                                        ->get()->first();   

                if (!empty($FindUserCodesFromFamily)) {
                    $this->dispatchBrowserEvent('error',['message'=>'User already had family']);
                }else{

                    if (!empty($this->state)) { 
                          try{

                             $details = [ 
                                    'title' => "Family invitation",
                                    'body' => "You've been invited by ".auth()->user()->u_fullname. " to join family as ".$this->state['relation']. " of ".$this->familyFMOnTree->u_fullname,

                                  ]; 
                                 $sendrequest=Request_User_Join_Family::create([
                                                'family_id'=>$this->familyFMOnTreeAdmin->id,
                                                'request_sent_by'=>auth()->user()->u_id,
                                                'user_requested'=>$this->familyFMOnTree->u_id,
                                                'accepted'=>0,
                                                'relation'=>$this->state['relation'],
                                                'to'=>$this->FindUserCodes->u_id,
                                            ]); 
                                $mail=Mail::to($this->FindUserCodes->u_email)->send(new familyRequests($details));

                                if ($sendrequest) {
                                    $this->dispatchBrowserEvent('success',['message'=>'Request sent successfully']);
                                }else{
                                    $this->dispatchBrowserEvent('error',['message'=>'Error Occured unable to send request']);
                                }
                            
                         }catch (Exception $e) {
                              $this->dispatchBrowserEvent('error',['message'=>'Error Occured unable to send request']); 
                         } 
                    }else{ 
                         $this->dispatchBrowserEvent('error',['message'=>'Error Occured unable to send request choose relation']);
                    } 
                        
                }

            }else{
                $this->dispatchBrowserEvent('error',['message'=>'Error Occured unable to find user check codes again']); 
            }


        }else{
             if (!empty($this->familyFMOnTree)) {
                if (!empty($this->email or $this->phone)) { 
                    $usersFindCountToBeAdded = User::where('u_email',$this->email)
                            ->Where('u_phoneline',$this->phone)
                            ->get()->first();

                     if (empty($usersFindCountToBeAdded)) {  
                        $userAdded=User::create([
                            'u_fullname'=>$this->state['fullname'],
                            'u_dob'=>$this->state['dob'],
                            'u_email'=>$this->email,
                            'u_gender'=>$this->state['gender'],
                            'u_phoneline'=>$this->phone,
                            'u_address'=>$this->state['address'], 
                            'u_country'=>$this->state['country'], 
                            ]); 

                         if ($userAdded) {

                            $RetrieveUserAdded = User::where('u_email',$this->email)
                                    ->where('u_phoneline',$this->phone)
                                    ->get()->first(); 

                            if (!empty($RetrieveUserAdded)) {

                                $RetrieveUserAddedFromFamily= Family::where('f_id',$RetrieveUserAdded->u_id)
                                    ->get()->first();

                                if (!empty($RetrieveUserAddedFromFamily)) { 
                                    $this->dispatchBrowserEvent('error',['message'=>'Error Occured User already added to family']); 

                                }else{ 
                                    
                                    //creating user to family  
                                    if ($this->state['relation']) {

                                        $familyUserCheckingBCreation=Family::where('f_id',$this->familyFMOnTree->u_id)->get()->first();

                                        if (empty($familyUserCheckingBCreation)) { 
                                            $userCreation=Family::create([
                                                    'f_id'=>$this->familyFMOnTree->u_id, //will be changed according to selected user 
                                                    'f_indentity'=>$this->familycode, 
                                                    ]); 
                                        }else{
                                            $userCreation=true;
                                        } 
                                        if (empty($RetrieveUserAddedFromFamily)) {
                                                $userCreation=Family::create([
                                                    'f_id'=>$RetrieveUserAdded->u_id, //will be changed according to selected user  
                                                     'f_indentity'=>$this->familycode, 
                                                    ]); 
                                        }

                                     if (!$userCreation) { 
                                        $this->dispatchBrowserEvent('error',['message'=>'Error Occured User not added to family']); 
         
                                        }else{
                                            if ($this->state['relation']=='Father') {  
                                                $familyUserCreation=Family::where('f_id',$this->familyFMOnTree->u_id) 
                                                                    ->update([
                                                                        'f_fathers'=>$RetrieveUserAdded->u_id,//user created    
                                                                        'f_gender'=>$this->gender,
                                                                         'f_indentity'=>$this->familycode,
                                                                 ]);

                                                if (empty($this->familyFMOnTree->f_mothers)) { 

                                                  $familyUserCreation=Family::where('f_id',$this->familyFMOnTree->f_mothers) 
                                                                    ->update([
                                                                        'f_husbands'=>$RetrieveUserAdded->u_id,//user created    
                                                                        'f_gender'=>$this->gender,
                                                                         'f_indentity'=>$this->familycode,
                                                                 ]); 
                                                }

                                                 if ($familyUserCreation) {

                                                       $motherandaddhusband =Family::where('f_id',$this->familyFMOnTree->u_id)->get()->first();

                                                       if ($motherandaddhusband) {
                                                           Family::where('f_id',$motherandaddhusband->f_mothers)
                                                            ->update(['f_husbands'=>$motherandaddhusband->f_fathers]);
                                                       }
                                                    }


                                                $details = [ 
                                                        'title' => "Family invitation",
                                                        'body' => "You've been added by ".auth()->user()->u_fullname. " as ".$this->state['relation']. " of ".$this->familyFMOnTree->u_fullname,

                                                      ];

                                                $mail=Mail::to($RetrieveUserAdded->u_email)->send(new familyRequests($details));

                                                $this->success=1;
                                           }elseif ($this->state['relation'] == 'Mother') {

                                                $familyUserCreation=Family::where('f_id',$this->familyFMOnTree->u_id) 
                                                                    ->update([
                                                                        'f_mothers'=>$RetrieveUserAdded->u_id,//user created    
                                                                        'f_gender'=>$this->gender,
                                                                        'f_indentity'=>$this->familycode,
                                                                    ]);

                                                 if (empty($this->familyFMOnTree->f_fathers)) { 

                                                $familyUserCreation=Family::where('f_id',$this->familyFMOnTree->f_fathers) 
                                                                    ->update([
                                                                        'f_wives'=>$RetrieveUserAdded->u_id,//user created    
                                                                        'f_gender'=>$this->gender,
                                                                         'f_indentity'=>$this->familycode,
                                                                 ]); 

                                                                }


                                                    if ($familyUserCreation) {

                                                       $motherandaddhusband =Family::where('f_id',$this->familyFMOnTree->u_id)->get()->first();

                                                       if ($motherandaddhusband) {
                                                           Family::where('f_id',$motherandaddhusband->f_fathers)
                                                            ->update(['f_wives'=>$motherandaddhusband->f_mothers]);
                                                       }
                                                    }
                                                $details = [ 
                                                        'title' => "Family invitation",
                                                        'body' => "You've been added by ".auth()->user()->u_fullname. " as ".$this->state['relation']. " of ".$this->familyFMOnTree->u_fullname,

                                                      ];

                                                $mail=Mail::to($RetrieveUserAdded->u_email)->send(new familyRequests($details));


                                                $this->success=1;
                                           }elseif ($this->state['relation']== 'Sibling') {
                                                if ($this->state['gender']=='Male') {
                                                       $this->Cgender="M";
                                                    }elseif ($this->state['gender']=='Female') {
                                                       $this->Cgender="F";
                                                    }else{
                                                       $this->Cgender=""; 
                                                    }
                                                    
                                                    $familyUserCreation=Family::where('f_id',$RetrieveUserAdded->u_id) 
                                                                    ->update([ 
                                                                        'f_fathers'=>$this->familyFatherAndMother->f_fathers,
                                                                        'f_mothers'=>$this->familyFatherAndMother->f_mothers,
                                                                        'f_gender'=>$this->Cgender, 
                                                                        'f_indentity'=>$this->familycode,
                                                                    ]);  
                                                    $this->success=1; 

                                                    $details = [ 
                                                        'title' => "Family invitation",
                                                        'body' => "You've been added by ".auth()->user()->u_fullname. " as ".$this->state['relation']. " of ".$this->familyFMOnTree->u_fullname,

                                                      ];

                                                $mail=Mail::to($RetrieveUserAdded->u_email)->send(new familyRequests($details));
                                                  

                                           }
                                           elseif ($this->state['relation'] == 'Child') { 
                                            
                                                if ($this->familyFMOnTree->u_gender=='Male') { 
                                                    if ($this->state['gender']=='Male') {
                                                       $this->Cgender="M";
                                                    }elseif ($this->state['gender']=='Female') {
                                                       $this->Cgender="F";
                                                    }else{
                                                       $this->Cgender=""; 
                                                    }
                                                    $familyUserCreation=Family::where('f_id',$RetrieveUserAdded->u_id) 
                                                                    ->update([ 
                                                                        'f_fathers'=>$this->familyFMOnTree->u_id, 
                                                                        'f_gender'=>$this->Cgender, 
                                                                        'f_indentity'=>$this->familycode,
                                                                    ]);

                                                    $details = [ 
                                                        'title' => "Family invitation",
                                                        'body' => "You've been added by ".auth()->user()->u_fullname. " as ".$this->state['relation']. " of ".$this->familyFMOnTree->u_fullname,

                                                      ];

                                                $mail=Mail::to($RetrieveUserAdded->u_email)->send(new familyRequests($details));


                                                    $this->success=1;
                                                }elseif ($this->familyFMOnTree->u_gender=='Female') { 
                                                    $familyUserCreation=Family::where('f_id',$RetrieveUserAdded->u_id) 
                                                                    ->update([ 
                                                                        'f_mothers'=>$this->familyFMOnTree->u_id, 
                                                                        'f_gender'=>$this->Cgender, 
                                                                        'f_indentity'=>$this->familycode,
                                                                    ]); 
                                                    $this->success=1;

                                                    $details = [ 
                                                        'title' => "Family invitation",
                                                        'body' => "You've been added by ".auth()->user()->u_fullname. " as ".$this->state['relation']. " of ".$this->familyFMOnTree->u_fullname,

                                                      ];

                                                $mail=Mail::to($RetrieveUserAdded->u_email)->send(new familyRequests($details));
                                                }
                                                   

                                           }elseif ($this->state['relation'] =='Wife') {

                                               $familyUserCreation=Family::where('f_id',$this->familyFMOnTree->u_id) 
                                                                    ->update([
                                                                        'f_wives'=>$RetrieveUserAdded->u_id,//user created    
                                                                        'f_gender'=>$this->gender,
                                                                        'f_indentity'=>$this->familycode,
                                                                    ]);

                                                $details = [ 
                                                        'title' => "Family invitation",
                                                        'body' => "You've been added by ".auth()->user()->u_fullname. " as ".$this->state['relation']. " of ".$this->familyFMOnTree->u_fullname,

                                                      ];

                                                $mail=Mail::to($RetrieveUserAdded->u_email)->send(new familyRequests($details));

                                                $this->success=1;
                                           }elseif($this->state['relation'] =='Husband'){

                                                $familyUserCreation=Family::where('f_id',$this->familyFMOnTree->u_id) 
                                                                    ->update([
                                                                        'f_husbands'=>$RetrieveUserAdded->u_id,//user created    
                                                                        'f_gender'=>$this->gender,
                                                                        'f_indentity'=>$this->familycode,
                                                                    ]);
                                                $details = [
                                                        'sentFrom'=>auth()->user()->u_fullname,
                                                        'title' => "Family invitation",
                                                        'body' => "You've been added by ".auth()->user()->u_fullname. " as ".$this->state['relation']. " of ".$this->familyFMOnTree->u_fullname,

                                                      ];

                                                $mail=Mail::to($RetrieveUserAdded->u_email)->send(new familyRequests($details));
                                                $this->success=1;
                                           }else{
                                            $this->$error=1;
                                              $this->dispatchBrowserEvent('error',['message'=>'unkown relation']);  
                                           }

                                        if ($this->success==1) {
                                            return redirect()->route('tree');
                                            $this->dispatchBrowserEvent('error',['message'=>'Member added']);
                                        }else{
                                            $this->dispatchBrowserEvent('error',['message'=>'Member not added']);
                                        } 


                                        }

                                    } 
                                    else{

                                        $this->dispatchBrowserEvent('error',['message'=>'Empty space found for relation']);  
                                    }
                                }

                            }else{
                                  $this->dispatchBrowserEvent('error',['message'=>'Error Occured User not found']); 
                            } 
                        }else{
                           $this->dispatchBrowserEvent('error',['message'=>'Error Occured User Not Created']);   
                        }

                     }else{
                        $this->AdduserByCode=1;
                        // $this->dispatchBrowserEvent('error',['message'=>'Error Occured User already created']);


                        $this->checkexistance=\App\Models\FamilyRequests::where('user_requested',auth()->user()->u_id)->get()->first();

                            if ($this->checkexistance == null) { 
                                if (!empty($this->fAInfo) or !empty($this->fRelation) or !empty($this->to)) {
                                        $sendrequest=\App\Models\FamilyRequests::create([
                                            'family_id'=>$this->familyFMOnTreeAdmin->id,
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
                                 $this->dispatchBrowserEvent('error',['message'=>"Request already sent"]); 
                            }
                        
                        //Send him/her invitation to join


                    } 
               }else{

                    $this->dispatchBrowserEvent('error',['message'=>'Empty space found']); 
                }

            }else{
                 $this->dispatchBrowserEvent('error',['message'=>'selected user not found']); 
            }
             
        }

           






    }
    public function render()
    {
        return view('livewire.tree.add-new-family-member');
    }
}
