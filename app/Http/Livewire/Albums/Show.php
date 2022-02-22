<?php

namespace App\Http\Livewire\Albums;

use Livewire\Component;
use App\Models\Albums;
use App\Models\Photos;
use DB;
use Livewire\WithFileUploads ; 
use Illuminate\Support\Facades\Validator;
class Show extends Component
{
    use WithFileUploads; 
    public $Album;
    public $Albums;
    public $state=[];

    public function mount($ablum_id)
    {
        $this->Albums =DB::table('tbl_users') 
                         ->join('albums','tbl_users.u_id','=','albums.user_id')
                         ->where('tbl_users.u_id',auth()->user()->u_id)
                         ->orderBy('created_at','desc') 
                         ->get(); 
        $this->Album=Albums::findOrFail($ablum_id);

       
    }

        public function save()
    {     

      $photo=Photos::create([
            'user_id'=>auth()->user()->u_id,
            'i_image' =>$this->state['photo']->hashName(),
            'album_id'=>$this->Album->id,
            'caption'=>$this->state['caption'],
        ]);  
        $this->state['photo']->store('photos','public'); 
        if ($photo) { 
            return back();
           session()->flash('success','photo added successful by'); 

        }else{
            return back();
             session()->flash('error','photo not added  ');  
        }

     
       
        
    }
    public function render()
    {
        return view('livewire.albums.show');
    }
}
