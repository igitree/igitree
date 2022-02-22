<?php

namespace App\Http\Controllers\Stories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\Family;
class StoriesController extends Controller
{ 
    public function stories($status)
    {

        $family=Family::where('f_id',auth()->user()->u_id)->get()->first();
        if (!empty($family)) {
            $Status=Status::where('family_id',$family->f_indentity)->get();
        }else{
            return redirect()->route('status');
        }
        
        return view('stories',compact('Status'));
    }
    

}
