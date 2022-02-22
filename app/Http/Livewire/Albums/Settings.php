<?php

namespace App\Http\Livewire\Albums;

use Livewire\Component;
use App\Models\Albums;
use App\Models\Photos;

use Livewire\WithFileUploads ;

use Ramsey\Uuid\Uuid; 
use Image;


class Settings extends Component
{
    use WithFileUploads;  
    public $Album;
    public $Ablum_Id;
    public $photo;
    public $caption; 
    public $name;
    public $description;

    public function mount($ablum_id)
    { 
        $this->Album=Albums::findOrFail($ablum_id); 
        $this->name=$this->Album->title; 
        $this->description=$this->Album->description;
        $this->Ablum_Id=$this->Album->id;

    }

      public function resetForm()
    {
         $this->photo ='';
         $this->caption ='';

    }

    public function save()
    {   
         if ($this->photo != null) {

             $image = $this->photo;
            $input['file'] = time().'.'.$image->getClientOriginalExtension();

            $imgFile = Image::make($image->getRealPath());
            $watermark = Image::make('../public/IGITREE-01 (2).png');
            try {
                $watermark->resize(50, 50);
                
                $imgFile->insert($watermark, 'bottom-right', 0, 0);
                $imgFile->save(public_path('/storage/photos').'/'.$input['file']); 
                         
                 $photo=Photos::create([
                                'i_id'=>Uuid::uuid4()->toString(),
                                'i_user'=>auth()->user()->u_id,
                                'i_image' =>$input['file'],
                                'album_id'=>$this->Ablum_Id,
                                'caption'=>$this->caption,
                            ]);
                     
                    // $this->photo->store('photos','public');
                     $this->resetForm(); 
                    $this->dispatchBrowserEvent('success',['message'=>'Photo added successful ']);
                     if ($photo) {

                           return back(); 
                            $this->dispatchBrowserEvent('success',['message'=>'Photo added successful ']);
                           $this->resetForm();
                           return redirect()->back();

                        }else{
                            
                             $this->dispatchBrowserEvent('error',['message'=>'Photo Not added ']);
                             $this->resetForm();
                            }

                } catch (Exception $e) {
                    $this->dispatchBrowserEvent('error',['message'=>'Error while saving file ']);
            }
             
             
         }else{
             
            $this->resetForm();
            
                     $this->dispatchBrowserEvent('error',['message'=>'Empty space found']);
         }
         
       

    } 
     
     public function update($Ablum_Id)
     {       
      $album=Albums::where('id',$Ablum_Id)
                    ->update([ 
                        'title'=>$this->name,
                        'description'=>$this->description,
                    ]);  
          
           $this->dispatchBrowserEvent('success',['message'=>'Album Updated successful']);
        if ($album) { 
        }else{  
             $this->dispatchBrowserEvent('error',['message'=>'Album Not updated']);
        }

    }

    public function deletePhoto($ablum_id)
    {
      $album=Photos::delete()->whereIn('album_id', $album_id);
      // $delete->delete();
      if ($delete) { 
           $this->dispatchBrowserEvent('success',['message'=>'photos deleted successful']);

        }else{ 
             $this->dispatchBrowserEvent('error',['message'=>'photos not deleted']); 
        }
    }
  

     public function deleteAblum($ablum_id)
    {
      
      $album=Albums::delete()->where('id', $album_id);
      // $delete->delete();
      if ($delete) {
 
            $this->dispatchBrowserEvent('success',['message'=>'Album deleted successful']);

        }else{ 
            $this->dispatchBrowserEvent('error',['message'=>'Album not deleted']);  
        }
    }

     
    public function render()
    {
        return view('livewire.albums.settings');
    }
}
