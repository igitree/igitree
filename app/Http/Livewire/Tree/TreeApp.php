<?php

namespace App\Http\Livewire\Tree;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Family;
use DB;
class TreeApp extends Component
{ 
    public $familyFM;
    public $users;
    public $showEditModel=false;
    public $WHtree;
    public $MFtree;
    public $message;
    public $wife=false;
    public $WmFID;
    public $Siblingtree;
    public $AUtree;
    public $GMGFtree;
    public $showrequestForm=false;
    public $closerequestForm=false;
    public $wiveshusbandtree;
    public $children;
    public $childwifehusband;
    public $AddRelatives=false;
    public $data;
    public $familyFMCheckdata;
    public function ShowUserInfo(User $user)
    {  
     $this->showrequestForm=true;  
    $this->closerequestForm=false;    

        $this->users=DB::table('tbl_users')
                        ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id') 
                        ->where('tbl_family.f_id',$user->u_id)
                        ->get(); 
                   

        // $this->state =$user->toArray(); 

        $this->dispatchBrowserEvent('show-form');
       

    }

     public function proceed()
    {
        $this->message=" "  ;
        session()->flash('message',"Before creating new family search and check if you can't find matching family");
        return redirect()->route("family");
    }


    public function closerequestForm()
    {
    $this->showrequestForm=false; 
      $this->closerequestForm=true;  
    }


    public function render()
    { 

        
        $this->familyFMCheckdata=DB::table('tbl_users')
                ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id') 
                ->where('tbl_family.f_id',auth()->user()->u_id)
                ->get()->count();

 
         $this->familyFM=DB::table('tbl_users')
                ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id') 
                ->where('tbl_family.f_id',auth()->user()->u_id)
                ->get();  



            if($this->familyFMCheckdata !=0 and $this->familyFMCheckdata > 0){
                if ($this->familyFM[0]->f_mothers != null or $this->familyFM[0]->f_fathers != null) {
                   
                    if (!empty($this->familyFM)){  
                   

                        //wives or husband

                        $this->wiveshusbandtree =DB::table('tbl_users')
                                ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id')
                                ->whereIn('tbl_family.f_id', [$this->familyFM[0]->f_husbands,$this->familyFM[0]->f_wives])
                                ->get();


                        //children of creator

                        $this->children =DB::table('tbl_users')
                                ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id')
                                ->where('tbl_family.f_fathers',$this->familyFM[0]->f_id)
                                ->orWhere('tbl_family.f_mothers',$this->familyFM[0]->f_id)
                                ->get();  

                    //children wife or husband

                    $childrenwifehusband=array();

                        foreach($this->children as $tree){ 
                            array_push($childrenwifehusband,$tree->f_wives,$tree->f_husbands);
                            } 

                    $this->childwifehusband =DB::table('tbl_users')
                                ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id')
                                ->whereIn('tbl_family.f_id',$childrenwifehusband) 
                                ->get();

                       //grandchildren
                                 
                    $grandchild=array();

                        foreach($this->childwifehusband as $tree){ 
                            array_push($grandchild,$tree->f_id);
                            } 

                   $this->grandchildren =DB::table('tbl_users')
                                ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id')
                                ->where('tbl_family.f_fathers',$grandchild)
                                ->orWhere('tbl_family.f_mothers',$grandchild)
                                ->get(); 

                       // siblings

                        $this->Siblingtree =DB::table('tbl_users')
                                ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id')
                                ->where('tbl_family.f_fathers', $this->familyFM[0]->f_fathers)
                                ->where('tbl_family.f_mothers',$this->familyFM[0]->f_mothers)  
                                ->get();  
                          }

                       // Father and Mother 

                        $this->MFtree= DB::table('tbl_users')
                                ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id') 
                                ->where('tbl_users.u_id', $this->familyFM[0]->f_fathers) 
                                ->orWhere('tbl_users.u_id',$this->familyFM[0]->f_mothers)  
                                ->get();  

                         // aunt and uncle 

                        $aucleAndaunt=array();

                        foreach($this->MFtree as $tree){ 
                            array_push($aucleAndaunt,$tree->f_fathers,$tree->f_mothers);
                            } 
                        $this->AUtree= DB::table('tbl_users')
                                ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id') 
                                ->whereIn('tbl_family.f_fathers', $aucleAndaunt)  
                                ->orwhereIn('tbl_family.f_mothers', $aucleAndaunt) 
                                ->get(); 

                        //grand mother and father 
                                
                         $GrandfatherAndGrandmother=array(); 

                        foreach($this->MFtree as $tree){ 
                            array_push($GrandfatherAndGrandmother,$tree->f_fathers,$tree->f_mothers);
                            }  
                         $this->GMGFtree= DB::table('tbl_users')
                                ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id') 
                                ->whereIn('tbl_family.f_id', $GrandfatherAndGrandmother)   
                                ->get(); 


                        //grand grand mother and father

                        $GrandGrandfatherAndGrandGrandmother=array();

                         foreach($this->GMGFtree as $tree){ 
                            array_push($GrandGrandfatherAndGrandGrandmother,$tree->f_fathers,$tree->f_mothers);
                            }  
                         $this->GGMGGFtree= DB::table('tbl_users')
                                ->join('tbl_family', 'tbl_users.u_id', '=', 'tbl_family.f_id') 
                                ->whereIn('tbl_family.f_id', $GrandGrandfatherAndGrandGrandmother)   
                                ->get(); 

                       

           
                    }
            }








 // $this->data=DB::table('tbl_familycopy')->get();

 //    // $this->data=json_encode($this->data);  
    

        return view('livewire.tree.app');
    }
}






