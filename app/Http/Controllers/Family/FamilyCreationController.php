<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\NewFamily;
use App\Models\Family;
use App\Models\FamilyRequests;
use Mail;

class FamilyCreationController extends Controller
{

    public function index()
    {
        $Family= Family::where('f_id',auth()->user()->u_id)
                                ->get()->first(); 

        
           $response=[
            'View'=>1,
            'Message'=>'Data was retrieved',
            'Family'=>$Family,
           ];
        return response($response,  201); 
    }
   
   function SaveFamily()
   {
      $family=NewFamily::where('user_id',auth()->user()->u_id)->get()->first();
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

                                $response=[
                                    'Message'=>'Family Created by'.auth()->user()->u_fullname,
                                ];

                            }else{
                               $response= ['Message'=>"Error occurred unable to find user"]; 
                           }  
                        }else{
                            $family=NewFamily::where('user_id',auth()->user()->u_id)->get()->first();  
                           
                            Family::update(['f_identity'=>$family->id])->where('f_id',$family->user_id);
                             $response= ['Message'=>"Process done"]; 
                        } 


                }else{
                    $response=['Message'=>"Error occurred while creating family"];
                } 
       
            }else{ 
                $response=['Message'=>"You Already Created family"];
            } 
        return response($response,201); 
            
      
   }
}
