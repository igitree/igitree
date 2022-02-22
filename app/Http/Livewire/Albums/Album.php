<?php

namespace App\Http\Livewire\Albums;

use Livewire\Component;
use App\Models\Albums;
use DB;
use Ramsey\Uuid\Uuid;
use App\Models\User;
use App\Models\Family;

class Album extends Component
{
    public $Albums;
    public $state=[];
    public $CreateAlbumsForChatImages=false;
    public $CheckChatAlbum=false;
    public function mount()
    {
        // if (!empty($family_id)) {
        //  $family_id=Family::where('f_id',auth()->user()->u_id)->get()->first();
        //     }else{
        //         return redirect()->route('tree')->with('error','You need to have family');
        //                         
        $user=auth()->user(); 



        $this->Albums =DB::table('tbl_users') 
                         ->join('albums','tbl_users.u_id','=','albums.user_id')
                         ->where('tbl_users.u_id',auth()->user()->u_id)
                         ->orderBy('created_at','desc') 
                         ->get(); 

        // $this->Albums= $user->albums()->latest()->get(); 

        $this->messagesAlbums = DB::table('tbl_chats')->select('c_image')->where('c_sender',auth()->user()->u_id)

        ->orWhere('c_recipient',auth()->user()->u_id)->get();
      
        foreach ($this->messagesAlbums as $c_image) {
            if ($c_image->c_image != '') {
                $this->CreateAlbumsForChatImages=true;
               }   
        }
        if ($this->CreateAlbumsForChatImages == true) {
            foreach($this->Albums as $Album){
                if ($Album->title != 'Chat Album') { 
                    $this->CheckChatAlbum=true;
                }else{
                    $this->CheckChatAlbum=false;
                }
            }

            if ($this->CheckChatAlbum == true) {
                $user=auth()->user();

                $chatAblumCount=$user->albums()->where('title','Chat Album')->get()->count();
              
                if ($chatAblumCount <= 0) {
                    $save=Albums::create([
                            'id'=>Uuid::uuid4()->toString(),
                            'user_id'=>auth()->user()->u_id,
                            'title'=>"Chat Album",
                            'description'=>'Ablum that holds all photos from chat messages.',
                    ]); 
                    $this->CheckChatAlbum=false; 
                }
                $this->CheckChatAlbum=false; 

            }
           
        }
    }

    public function save()
    {
        $save=Albums::create([
                'id'=>Uuid::uuid4()->toString(),
                'user_id'=>auth()->user()->u_id,
                'title'=>$this->state['title'],
                'description'=>$this->state['description'],
        ]);
        return redirect()->route('album');
            session()->flash('success','Album created successfully');
    }
    public function render()
    {
        // if (!empty($family_id)) {
        //  $family_id=Family::where('f_id',auth()->user()->u_id)->get()->first();
        //     }else{
        //         return redirect()->route('tree')->with('error','You need to have family');
        //         }
        return view('livewire.albums.album');
    }
}
