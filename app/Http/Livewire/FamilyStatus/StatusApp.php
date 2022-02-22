<?php

namespace App\Http\Livewire\FamilyStatus;

use Livewire\Component;

use Livewire\WithFileUploads;
use App\Models\Status;
use App\Models\Family;
use Image;
use App\Models\User;
use DB;
use Carbon\Carbon;

use Ramsey\Uuid\Uuid; 
use Notification;
use Mail;

class StatusApp extends Component
{


    use WithFileUploads; 
    public $s_photo; 
    public $s_text;
    public $status;
    public $diffHours;
    public $useText;
    public $UseIMage;
    public $Status;
    public $condition;
    protected $rules = [
        's_photo' => 'mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        's_text'=>'string',
    
    ];
 

    public function useText()
    {
       $this->useText=true;
       $this->UseIMage=false;
    }

    public function UseIMage()
    {
        $this->UseIMage=true;
        $this->useText=false;
    }
   
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->s_photo='';
        $this->s_text='';
        $this->UseIMage='';
        $this->useText='';
        $this->UseIMage=false;
        $this->useText=false;
    }
    public function save()
        {
            $userInfo=Family::where('f_id',auth()->user()->u_id)->get()->first();
       
            $s_id=Uuid::uuid4()->toString();
            $details = [    
                    's_id'=>$s_id,
                    'user'=>auth()->user()->u_id,
                    'type'=>'stories',
                    'family_id'=> $userInfo->f_indentity,
                ];
            if (!empty($this->s_text) and empty($this->s_photo)) {
                
                $status=Status::create([
                        's_id'=>$s_id,
                        'user_id'=>auth()->user()->u_id,
                        'family_id'=>($userInfo->f_indentity)? $userInfo->f_indentity:'d6c86f4d-e261-4757-bd7b-9ec3892dabe0',
                        's_image'=>'',
                        's_text'=>$this->s_text,
                ]);

                Notification::send(auth()->user(), new \App\Notifications\StoriesNotification($details)); 

                $this->resetForm(); 
                return redirect()->route('status');      
                $this->dispatchBrowserEvent('success',['message'=>'Text added successful ']);

           
            }elseif(!empty($this->s_photo) and empty($this->s_text)){
                $image = $this->s_photo;
                $input['file'] = time().'.'.$image->getClientOriginalExtension();

                $imgFile = Image::make($image->getRealPath()); 

                try {

                // $imgFile->resize(1080,1920);
                $imgFile->save(public_path('/storage/status').'/'.$input['file']);

                   $s_photo=Status::create([
                                    's_id'=>$s_id,
                                    'user_id'=>auth()->user()->u_id,
                                    'family_id'=>($userInfo->f_indentity)? $userInfo->f_indentity:'d6c86f4d-e261-4757-bd7b-9ec3892dabe0',
                                    's_image'=>$input['file'],
                                    's_text'=>'',
                            ]);

                Notification::send(auth()->user(), new \App\Notifications\StoriesNotification($details));
                
                    $this->resetForm(); 
                    return redirect()->route('status'); 
                    $this->dispatchBrowserEvent('success',['message'=>'Photo added successful ']);

                     if ($s_photo) {
                           return back(); 
                            $this->dispatchBrowserEvent('success',['message'=>'Photo added successful ']);
                           $this->resetForm();

                        }else{
                            
                             $this->dispatchBrowserEvent('error',['message'=>'Photo Not added ']);
                             $this->resetForm();
                            }

                } catch (Exception $e) {
                    $this->dispatchBrowserEvent('error',['message'=>'Error while sending file ']);
                    return redirect()->route('status'); 
                }

                    
            }elseif (!empty($this->s_text) and !empty($this->s_photo)) { 
                    $image = $this->s_photo;
                    $input['file'] = time().'.'.$image->getClientOriginalExtension();

                    $imgFile = Image::make($image->getRealPath()); 

                    try {

                    // $imgFile->resize(1080,1920);
                    $imgFile->save(public_path('/storage/status').'/'.$input['file']);

                    $s_photo=Status::create([
                                        's_id'=>$s_id,
                                        'user_id'=>auth()->user()->u_id,
                                        'family_id'=>($userInfo->f_indentity)? $userInfo->f_indentity:'d6c86f4d-e261-4757-bd7b-9ec3892dabe0',
                                        's_image'=>$input['file'],
                                        's_text'=>$this->s_text,
                                ]);

                         
                         Notification::send(auth()->user(), new \App\Notifications\StoriesNotification($details));
   
                        $this->resetForm(); 
                        return redirect()->route('status'); 
                        $this->dispatchBrowserEvent('success',['message'=>'Photo added successful ']);

                         if ($s_photo) {
                               return back(); 
                                $this->dispatchBrowserEvent('success',['message'=>'Photo added successful ']);
                               $this->resetForm();

                            }else{
                                
                                 $this->dispatchBrowserEvent('error',['message'=>'Photo Not added ']);
                                 $this->resetForm();
                                }

                    } catch (Exception $e) {
                        $this->dispatchBrowserEvent('error',['message'=>'Error while sending file ']);
                        return redirect()->route('status'); 
                    }     


            }
            else{
               $this->dispatchBrowserEvent('error',['message'=>'Story Not added ']);
               return redirect()->route('status'); 
                $this->resetForm(); 
            } 
            
        }


    public function mount()
    {
     
    // $this->status=auth()->user()->status->groupBy('user_id')->toArray();
        $family_id=Family::where('f_id',auth()->user()->u_id)->get()->first();
        if (!empty($family_id)) {
            $this->status =DB::table('tbl_status')->where('family_id',$family_id->f_indentity)->orWhere('user_id',auth()->user()->u_id)->orderBy('created_at','asc')->get()->groupBy(function($data) {
                    $data=$data->user_id; 
                    return $data;
                 });  

            foreach ($this->status as $stat => $user){

               foreach($user as $date){
                $now = Carbon::now();
                $created_at = Carbon::parse($date->created_at);
                $this->diffHours = $created_at->diffInHours($now);  
              
               }
            }
        }else{
            return redirect()->route('tree')->with('error','You need to have family');
        }
        

    }

    public function render()
    {
       $this->Status=Status::all(); 
        return view('livewire.family-status.status-app');
    }
}
