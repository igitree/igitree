<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;
use Livewire\WithFileUploads ; 
use App\Models\Chat;
use App\Models\User;
use DB;
use Carbon\Carbon;
use Notification;
use Mail;
class ViewMessages extends Component
{


use WithFileUploads; 

    // public $recentChat;
    public $users;
    public $userReceiverSendMessage;
    public $messages; 
    public $userInpuMessage;
    public $info;
    public $photo;
    public $recentChatMother;
    public $recentChatFather;
    public $recentChatWife;
    public $recentChat;
    public $error;
    public $document;


    public function mount(User $user)
    {
        $this->error;
        $this->userReceiverSendMessage=$user;   
       
        $this->recentChat=$this->userReceiverSendMessage;

       
    }

    public function messages()
    { 
        $this->messages=DB::table('tbl_chats')->where('c_sender',auth()->user()->u_id)->where('c_recipient',$this->userReceiverSendMessage->u_id)->orWhere('c_recipient',auth()->user()->u_id)->where('c_sender',$this->userReceiverSendMessage->u_id)->orderBy('c_date','asc')->get(); 
    }
 
    public function removeitem()
    {
      $this->document="";
      $this->photo='';
    }

    public function resetForm()
    {
    $this->userInpuMessage='';
    $this->photo='';
    $this->document="";
    

    } 

    public function SendMessage()
    {  
        $this->info="Windows";
        $s_id=date('is').rand(12,9000);
        $details = [

                    's_id'=>$s_id,
                    'user'=>auth()->user()->u_id,
                    'to'=>$this->userReceiverSendMessage->u_id,
                    'type'=>'message',
                ];

          if(empty($this->photo) and !empty($this->userInpuMessage and empty($this->document))){ 
            if(!empty($this->userInpuMessage)){
                if ($this->userInpuMessage != '') { 
                   Chat::create([
                    'c_id'=>$s_id,
                    'user_id'=>auth()->user()->u_id,
                    'c_sender'=>auth()->user()->u_id,
                    'c_recipient'=>$this->userReceiverSendMessage->u_id,
                    'c_message'=>$this->userInpuMessage,
                    'c_image'=>'',
                    'c_document'=>'',
                    'c_date'=>date('Y-m-d h:i:s'),
                    'c_device'=>$this->info,
                    'c_os_type'=>$this->info,
                    'c_status'=>1,
                   ]);

                   $this->resetForm();
                   Notification::send(auth()->user(), new \App\Notifications\MessagesNotification($details)); 

                   // $this->dispatchBrowserEvent('success',['message'=>'message sent successfully']);
               }else{
                $this->dispatchBrowserEvent('danger',['message'=>'Write something']);

               }
                }else{  
                    $this->resetForm();
                    $this->dispatchBrowserEvent('danger',['message'=>'Write something']); 

                } 
            }elseif (!empty($this->photo) and empty($this->userInpuMessage) and  empty($this->document)) {
     
                $ext = ['jpg','jpeg','png','webp','heic','heif','gif'];

                if ( in_array( $this->photo->guessExtension() ,  $ext ) ) {
                      Chat::create([
                    'c_id'=>$s_id,
                    'c_sender'=>auth()->user()->u_id,
                    'c_recipient'=>$this->userReceiverSendMessage->u_id,
                    'c_message'=>'null',
                    'c_image'=>$this->photo->hashName(),
                    'c_document'=>'',
                    'c_date'=>date('Y-m-d h:i:s'),
                    'c_device'=>$this->info,
                    'c_os_type'=>$this->info,
                    'c_status'=>1,
                   ]); 
                    $this->photo->store('photos','public');

                $this->resetForm();
                Notification::send(auth()->user(), new \App\Notifications\MessagesNotification($details));
            }else{
                $this->dispatchBrowserEvent('danger',['message'=>' Message failed to sent unsupported format']); 
            }
             $this->dispatchBrowserEvent('danger',['message'=>'Write something, Message failed to sent ']); 
            
            }elseif (!empty($this->photo) and !empty($this->userInpuMessage) and  !empty($this->document)) {
             
                $ext = ['jpg','jpeg','png','webp','heic','heif','gif'];

                if ( in_array( $this->photo->guessExtension() ,  $ext ) ) {
                      Chat::create([
                    'c_id'=>$s_id,
                    'c_sender'=>auth()->user()->u_id,
                    'c_recipient'=>$this->userReceiverSendMessage->u_id,
                    'c_message'=>$this->userInpuMessage,
                    'c_image'=>$this->photo->hashName(),
                    'c_date'=>date('Y-m-d h:i:s'),
                    'c_document'=>$this->document->hashName(),
                    'c_device'=>$this->info,
                    'c_os_type'=>$this->info,
                    'c_status'=>1,
                   ]); 
                    $this->photo->store('photos','public');

                $this->resetForm();
                Notification::send(auth()->user(), new \App\Notifications\MessagesNotification($details));


            }else{
                $this->dispatchBrowserEvent('danger',['message'=>' Message failed to sent unsupported format']); 
            }

        }elseif (!empty($this->document and empty($this->photo) and empty($this->userInpuMessage))) {


               $ext =  ['pdf','doc','docx','html','htm','xls','xlsx','txt','sql'];

                if ( in_array( $this->document->guessExtension() ,  $ext ) ) {
                      Chat::create([
                   'c_id'=>$s_id,
                    'c_sender'=>auth()->user()->u_id,
                    'c_recipient'=>$this->userReceiverSendMessage->u_id,
                    'c_message'=>'null',
                    'c_document'=>$this->document->hashName(),
                    'c_date'=>date('Y-m-d h:i:s'),
                    'c_device'=>$this->info,
                    'c_os_type'=>$this->info,
                    'c_status'=>1,
                   ]); 
                   $this->document->store('photos','public');

                $this->resetForm();
                Notification::send(auth()->user(), new \App\Notifications\MessagesNotification($details));


            }else{
                $this->dispatchBrowserEvent('danger',['message'=>' Message failed to sent unsupported format']); 
            }

            

        } 
        else{
                $this->resetForm();
                $this->error='Empty space found'; 
                    $this->dispatchBrowserEvent('danger',['message'=>'Write something, Empty space found']); 
            }
        $this->resetForm();
        }


    public function deleteMessage($message)
    {
        $deleteMessage=Chat::where('c_id',$message)->delete();
        if($deleteMessage){
             $this->dispatchBrowserEvent('success',['message'=>'Message deleted successfully']);
        }else{
            $this->dispatchBrowserEvent('danger',['message'=>'Something Went Wrong']); 
        }
    }

    public function deleteAllMessage($user)
    { 
        $deleteMessage=Chat::where('c_sender',auth()->user()->u_id)->where('c_recipient',$user)->delete();

        if($deleteMessage){
             $this->dispatchBrowserEvent('success',['message'=>'Message deleted successfully']);
        }else{
            $this->dispatchBrowserEvent('danger',['message'=>'Something Went Wrong']); 
        }
    }




    public function render()
    {
//         $date = $info->created_at;
// {{ \Carbon\Carbon::parse($date)->diffForHumans() }}

         $this->messages=DB::table('tbl_chats')->where('c_sender',auth()->user()->u_id)->where('c_recipient',$this->userReceiverSendMessage->u_id)->orWhere('c_recipient',auth()->user()->u_id)->where('c_sender',$this->userReceiverSendMessage->u_id)->orderBy('c_date')->get()->groupBy(function($data) {
                    $date=$data->c_date;
                    return Carbon::parse($date)->format('d l Y');
                 });
         


        //  $students = Student::orderBy('created_at')->get()->groupBy(function($data) {
        //     return $data->created_at->format('Y-m-d');
        // });

        return view('livewire.chat.view-messages',['messages'=>$this->messages]); 
    }
}
