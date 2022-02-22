<?php
namespace App\Http\Livewire\Chat;

use Livewire\Component;
use App\Models\Chat;
use App\Models\User;
use App\Models\Family;
use DB;
use Carbon\Carbon;
use Mail;
class ChatApp extends Component
{
    public $recentChatFUser ;
    public $searchTerm;
    public $search;
    public $NewName;
    public $familycode;
    public $searchResults;
    public $closesearch=0;

    public function NewMessage()
    { 
        $this->closesearch=0;
        $this->familycode=Family::where('f_id',auth()->user()->u_id)->get()->first();
        if (!empty($this->familycode) and $this->familycode !=null) {
            $this->searchResults=DB::table('tbl_users')
                                    ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id') 
                                    ->where('tbl_users.u_fullname','like', '%'.$this->NewName.'%') 
                                    ->where('tbl_family.f_indentity',$this->familycode->f_indentity)
                                    ->get();

        
        }else{
            $this->dispatchBrowserEvent('error',['message'=>'No result found']);
        
        } 
    }

    public function closeSearching()
    {   $this->closesearch=1;
        $this->searchResults="";
        $this->NewName='';
        
    }

    public function searching()
    {
        try {
            $this->search=DB::table('tbl_users')
                                    ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id') 
                                    ->where('tbl_users.u_fullname',$this->searchTerm)
                                    ->get(); 
            
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('error',['message'=>'No result found']); 
        }

       

    }

    public function render()
    {   
       
        $this->recentChatFUser =DB::table('tbl_chats')->where('c_sender',auth()->user()->u_id)->orWhere('c_recipient',auth()->user()->u_id)->orderBy('c_date','desc')->get()->groupBy(function($data) {
                        if($data->c_sender == auth()->user()->u_id){
                            $data=$data->c_recipient;
                        }else{
                             $data=$data->c_sender;
                        }
                         
                    return $data;
                 }); 
                        
       
        return view('livewire.chat.chat-app');
    }
}
