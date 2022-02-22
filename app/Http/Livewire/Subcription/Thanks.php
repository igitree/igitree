<?php

namespace App\Http\Livewire\Subcription;

use Livewire\Component;
use App\Models\Payments;
class Thanks extends Component
{

    public function mount()
    {

        if(request()->get('tx_ref') and request()->get('status') and request()->get('transaction_id')){
            $this->orders=Payments::where('p_id',request()->get('tx_ref'))
                                    ->where('p_status','!=',2)
                                    ->where('p_receipt',auth()->user()->u_id)->get()->first();
            if (!empty($this->orders)) {
                  if(request()->get('status')=='successful')
                        {
                            $this->orders=Payments::where('p_id',request()->get('tx_ref'));
                            $this->orders->update([
                            'p_status'=>2,
                            'p_transaction_id'=>request()->get('transaction_id'),
                        ]); 
                        return redirect()->route('pricing')->with('success','Subscription done');
                    }elseif(request()->get('status')=='cancelled'){ 
                        return redirect()->route('pricing')->with('error','Subscription canceled');
                    }
            }else{
                return redirect()->route('pricing')->with('error','Error Occured');
            }
            
            
        }


         if(request()->get('status'))
            {
                if (request()->get('status')=='cancelled') {
                    return redirect()->route('pricing')->with('error','Subscription canceled');
                }else{
                return redirect()->route('pricing')->with('error','Error Occured');
                } 
            }else{
                return redirect()->route('pricing')->with('error','Error Occured');
            }
    }
    public function render()
    {            
        return view('livewire.subcription.thanks');
    }
}
