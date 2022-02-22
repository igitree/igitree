<?php

namespace App\Http\Livewire\Notify;

use Livewire\Component;
use DB;
use App\Models\NewFamily;
use App\Models\User;
 use App\Models\FamilyRequests;
 use App\Models\Family;
 use Mail;
 use App\Models\Request_User_Join_Family;
class AllUpdates extends Component
{
    public $family;
    public $checkUserDetails;
    public $gender;
    public $checkingUsertobeRelatedTo; 
    public $success;
    public $error;
    public $notifications;

    public function Approve($user)
    {
        $checkexistanceofuser=User::where('u_id',$user)->get()->first();

            if ($checkexistanceofuser->u_gender == 'Male') {
                $this->gender='M';
            }else{
                $this->gender='F';
            }   

             if (empty($checkexistanceofuser)) { 
                $this->dispatchBrowserEvent('error',['message'=>'Error Occured User not added to family']); 

                }else{ 
                $this->checkUserDetails=FamilyRequests::where('user_requested',$user)
                    ->get()->first(); 

                $this->checkingUsertobeRelatedTo=User::where('u_email',$this->checkUserDetails->to)
                                                ->orWhere('u_phoneline',$this->checkUserDetails->to)
                                                ->orWhere('u_fullname', $this->checkUserDetails->to)
                                                ->get()->first();  

                    if (!empty($this->checkingUsertobeRelatedTo)) { 

                         //checking the user who sent the request
                        $userInFamily=Family::where('f_id',$user)->get()->count();

                        if ($userInFamily == 0) {

                             //adding him/her on the family first if not found

                            $userCreation=Family::create([
                                'f_id'=>$user,
                                'f_gender'=>$this->gender, 
                                'f_indentity'=>$this->family->id, 
                                ]); 

                            if ($userCreation) {
                                $this->error=1;
                            }else{
                                $this->error=2;
                            } 
                        }else{

                        }

                        //checking the user who sent the request after added to family t

                        $userAddedToFamily=Family::where('f_id',$user)->get()->first();

                        if($userAddedToFamily){
                            if (!empty($userAddedToFamily)) {  

                                //getting user suggested to be related  

                                $userRequestedInFamily=Family::where('f_id',$this->checkingUsertobeRelatedTo->u_id)->get()->first(); 

                                if (!empty($userRequestedInFamily)) {
                                    
                                    if ($this->checkUserDetails->relation== 'Sibling') {

                                        if(!empty($userRequestedInFamily->f_fathers) or !empty($userRequestedInFamily->f_mothers)){


                                            //this will add user father and mother from requested user to be related

                                            $attachUser=Family::where('f_id',$user) 
                                                ->update([ 
                                                    'f_mothers'=>$userRequestedInFamily->f_mothers, 
                                                    'f_fathers'=>$userRequestedInFamily->f_fathers,
                                                    'f_indentity'=>$this->checkUserDetails->family_id,
                                                ]);
                                            if ($attachUser) { 
                                                  $this->success=2;
                                            }

                                        }else{
                                            $this->error=1;
                                            $this->dispatchBrowserEvent('error',['message'=>'requested user does not have either father or mother']);
                                        }
                                    }elseif($this->checkUserDetails->relation== 'Father'){
                                        
                                        if(empty($userRequestedInFamily->f_fathers)){ 
                                            $attachUser=Family::where('f_id', $this->checkingUsertobeRelatedTo->u_id) 
                                                ->update([ 
                                                    'f_fathers'=>$this->checkUserDetails->user_requested,
                                                    'f_indentity'=>$this->checkUserDetails->family_id,
                                                ]);

                                            if ($attachUser) { 
                                                  $this->success=2;
                                            }
                                        }else{
                                            $this->error=1;
                                            $this->dispatchBrowserEvent('error',['message'=>'processing request failed user already have father']); 
                                            }

                                    }elseif ($this->checkUserDetails->relation== 'Mother') {
                                       
                                        if(empty($userRequestedInFamily->f_mothers)){ 
                                            $attachUser=Family::where('f_id', $this->checkingUsertobeRelatedTo->u_id) 
                                                ->update([ 
                                                    'f_mothers'=>$this->checkUserDetails->user_requested,
                                                    'f_indentity'=>$this->checkUserDetails->family_id,
                                                ]);

                                            if ($attachUser) { 
                                                  $this->success=2;
                                            }
                                        }else{
                                            $this->error=1;
                                            $this->dispatchBrowserEvent('error',['message'=>'processing request failed user already have father']); 
                                            }

                                    }
                                    else{
                                         $this->dispatchBrowserEvent('error',['message'=>'This feature is for Parents and siblings only']);  
                                    } 

                                    if ($this->success==2) {
                                        $this->checkUserDetails=FamilyRequests::where('user_requested',$user)->update([
                                                    'accepted'=>1
                                                    ]);

                                        return redirect()->route('tree');
                                    } 


                                }else{
                                    $this->error=1;
                                    $this->dispatchBrowserEvent('error',['message'=>'requested user does not have family yet']);
                                }

                            }else{
                                $this->dispatchBrowserEvent('error',['message'=>'Member not added user details not found']);
                                $this->error=1;
                            } 

                        }else{
                            $this->error=1;
                            $this->dispatchBrowserEvent('error',['message'=>'Member not added Error occured']);
                        } 

                       }else{
                        $this->dispatchBrowserEvent('error',['message'=>'Member not added user details not found']);
                       }


                    if ($this->error==1) {
                        $this->dispatchBrowserEvent('error',['message'=>'Member not added Error occured']);
                     }elseif ($this->success==2) {
                         $this->dispatchBrowserEvent('error',['message'=>'Member  added to family']);

                            try { 
                                $details = [ 
                                            'title' => "Family invitation",
                                            'body' => "congratulations ". $this->checkingUsertobeRelatedTo->u_fullname. " you have been added to family",
                                            'url'=>'http://127.0.0.1:8000/tree/view',
                                          ]; 

                                $mail=Mail::to($this->checkingUsertobeRelatedTo->u_email)->send(new \App\Mail\RequestAcceptedDeleted($details));

                            } catch (Exception $e) {
                                 $this->dispatchBrowserEvent('error',['message'=>"Unable to add notification mail"]);
                            }
                     } 

           }


    }

    public function Accept($user)
    { 
        $checkexistanceofuser=User::where('u_id',$user)->get()->first();
      
            if ($checkexistanceofuser->u_gender == 'Male') {
                $this->gender='M';
            }else{
                $this->gender='F';
            } 
            
            if (empty($checkexistanceofuser)) { 
                $this->dispatchBrowserEvent('error',['message'=>'Error Occured User not added to family']); 

            }else{ 

                $this->checkUserDetails=FamilyRequests::where('user_requested',$user)
                    ->get()->first(); 

                $this->checkingUsertobeRelatedTo=User::where('u_email',$this->checkUserDetails->to)
                                                ->orWhere('u_phoneline',$this->checkUserDetails->to)
                                                ->orWhere('u_fullname', $this->checkUserDetails->to)
                                                ->get()->first(); 

                if (!empty($this->checkingUsertobeRelatedTo) and !empty($this->checkUserDetails)) {
                    //checking the user who sent the request
                    $userInFamily=Family::where('f_id',$this->checkUserDetails->user_requested)->get()->first();
                  
                    if (empty($userInFamily)) { 
                         //adding him/her on the family first if not found

                            $userCreation=Family::create([
                                'f_id'=>$this->checkUserDetails->user_requested,
                                'f_gender'=>$this->gender, 
                                'f_indentity'=>$this->checkUserDetails->family_id, 
                                ]);  
                                if ($userCreation) {
                                    $this->error=1;
                                }else{
                                    $this->error=2;
                                } 
                        }


                        //checking the user who sent the request after added to family t

                        $userAddedToFamily=Family::where('f_id',$user)->get()->first();
                        $userRequestedInFamily=Family::where('f_id',$this->checkingUsertobeRelatedTo->u_id)->get()->first();
                        if ($userAddedToFamily) {

                           if ($this->checkUserDetails->relation == 'Sibling') {

                                if(!empty($userRequestedInFamily->f_fathers) or !empty($userRequestedInFamily->f_mothers)){

                                    //this will add user father and mother from requested user to be related

                                    $attachUser=Family::where('f_id',$user) 
                                        ->update([ 
                                            'f_mothers'=>$userRequestedInFamily->f_mothers, 
                                            'f_fathers'=>$userRequestedInFamily->f_fathers,
                                            'f_indentity'=>$this->checkUserDetails->family_id,
                                        ]);
                                    if ($attachUser) { 
                                          $this->success=2;
                                    }

                                }else{
                                    $this->error=1;
                                    $this->dispatchBrowserEvent('error',['message'=>'requested user does not have either father or mother']);
                                }

                           }elseif($this->checkUserDetails->relation== 'Father'){
                                        
                                if(empty($userRequestedInFamily->f_fathers)){ 
                                    $attachUser=Family::where('f_id', $this->checkingUsertobeRelatedTo->u_id) 
                                        ->update([ 
                                            'f_fathers'=>$this->checkUserDetails->user_requested,
                                            'f_indentity'=>$this->checkUserDetails->family_id,
                                        ]);

                                    if ($attachUser) { 
                                          $this->success=2;
                                    }
                                }else{
                                    $this->error=1;
                                    $this->dispatchBrowserEvent('error',['message'=>'processing request failed user already have father']); 
                                    }

                                }elseif ($this->checkUserDetails->relation== 'Mother') {

                                  if(empty($userRequestedInFamily->f_mothers)){ 
                                    $attachUser=Family::where('f_id', $this->checkingUsertobeRelatedTo->u_id) 
                                        ->update([ 
                                            'f_mothers'=>$this->checkUserDetails->user_requested,
                                            'f_indentity'=>$this->checkUserDetails->family_id,
                                        ]);

                                    if ($attachUser) { 
                                          $this->success=2;
                                    }
                                }else{
                                    $this->error=1;
                                    $this->dispatchBrowserEvent('error',['message'=>'processing request failed user already have father']); 
                                    }
                               } else{
                                    $this->dispatchBrowserEvent('error',['message'=>'This feature is for Parents and siblings only']);  
                                    }

                            if ($this->success==2) {
                                $this->checkUserDetails=FamilyRequests::where('id',$this->checkUserDetails->id)->update([
                                            'accepted'=>1
                                            ]);

                             try { 
                                $details = [ 
                                            'title' => "Family invitation",
                                            'body' => "congratulations ". $this->checkingUsertobeRelatedTo->u_fullname. " you have been added to family",
                                            'url'=>'http://127.0.0.1:8000/tree/view',
                                          ]; 

                                $mail=Mail::to($this->checkingUsertobeRelatedTo->u_email)->send(new \App\Mail\RequestAcceptedDeleted($details));

                            } catch (Exception $e) {
                                 $this->dispatchBrowserEvent('error',['message'=>"Unable to add notification mail"]);
                            }


                                return redirect()->route('tree');
                            } 
  

                        }
                }
            }
    }




    public function delete($id)
    {
      
      $DeletefamilyRequest=FamilyRequests::where('id',$id)->get()->first();
        if (!empty($DeletefamilyRequest)) {
            $DeletefamilyRequest->delete();
        }else{
           $this->dispatchBrowserEvent('error',['message'=>'Request not found ']); 
        }
      
      if ($DeletefamilyRequest) {
        $user=User::where('u_id',$DeletefamilyRequest->user_requested)->get()->first();
            if ($user!=null) {
                 try { 
                    $details = [ 
                                'title' => "Family invitation",
                                'body' => "Oops ".$user->u_fullname. " request have been deleted",
                                'url'=>'http://127.0.0.1:8000/tree/view',
                              ]; 

                    $mail=Mail::to($DeletefamilyRequest->u_email)->send(new \App\Mail\RequestAcceptedDeleted($details));

                } catch (Exception $e) {
                     $this->dispatchBrowserEvent('error',['message'=>"Unable to add notification mail"]);
                }
            } 
        $this->dispatchBrowserEvent('success',['message'=>'Request deleted successfully']);
      }else{
        $this->dispatchBrowserEvent('error',['message'=>'Request not deleted ']);
      }
    }

    public function deleteRequest($id)
    {
        $DeletefamilyRequest=Request_User_Join_Family::where('id',$id)->get()->first();
        if (!empty($DeletefamilyRequest)) {
            $DeletefamilyRequest->delete();
        }else{
           $this->dispatchBrowserEvent('error',['message'=>'Request not found ']); 
        }
      
      if ($DeletefamilyRequest) {
        $user=User::where('u_id',$DeletefamilyRequest->request_sent_by)->get()->first();
            if ($user!=null) {

                 try { 
                    $details = [ 
                                'title' => "Family invitation",
                                'body' => "Oops ".$user->u_fullname. " request have been deleted",
                                'url'=>'http://127.0.0.1:8000/tree/view',
                              ]; 

                    $mail=Mail::to($DeletefamilyRequest->u_email)->send(new \App\Mail\RequestAcceptedDeleted($details));

                } catch (Exception $e) {
                     $this->dispatchBrowserEvent('error',['message'=>"Unable to add notification mail"]);
                }
            } 

        $this->dispatchBrowserEvent('success',['message'=>'Request deleted successfully']);
      }else{
        $this->dispatchBrowserEvent('error',['message'=>'Request not deleted ']);
      }
    }

    public function markAsRead($notification)
    {
        $markAsRead=auth()->user()->unreadNotifications->where('id',$notification)->markAsRead();
        $this->dispatchBrowserEvent('success',['message'=>'Marked as read successfully']);
        
      

    }

    public function markAsReadGoto($notification)
    { 
        $markAsRead=auth()->user()->unreadNotifications->where('id',$notification)->markAsRead();
        return redirect()->route('chat');
        
    }

    public function render()
    {       
      $this->family=NewFamily::where('user_id',auth()->user()->u_id)->get()->first();
      if (!empty($this->family)) {
            $this->checkUserDetails=DB::table('tbl_users')
                                ->join('family_requests', 'tbl_users.u_id', '=', 'family_requests.user_requested') 
                                ->where('family_requests.family_id',$this->family->id) 
                                ->where('accepted',0)
                                ->get(); 
            }

        $this->Request_User_Join_Family=Request_User_Join_Family::where('to',auth()->user()->u_id)->get()->first();
        if (!empty($this->Request_User_Join_Family)) {
              $this->UserDetails=DB::table('tbl_users')
                                ->join('request__user__join__families', 'tbl_users.u_id', '=', 'request__user__join__families.to') 
                                ->where('request__user__join__families.to',$this->Request_User_Join_Family->to) 
                                ->where('accepted',0)
                                ->get(); 
        }


        $this->notifications=auth()->user()->unreadNotifications;
         return view('livewire.notify.all-updates');
    }



}
