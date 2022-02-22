<?php

namespace App\Http\Livewire\Subcription;

use Livewire\Component;
use App\Models\Payments;
use Illuminate\Support\Facades\Http;
use Mail;
class Pricing extends Component
{
    public $amount;
    public $PaymentTime; 
    public $error;
    
    public function order()
    {

        if (!empty($this->PaymentTime)) {
            if ($this->PaymentTime == 'Monthly') {
                $this->amount=654;
            }elseif ($this->PaymentTime == 'Quarterly') {
                $this->amount=1357;
            }elseif ($this->PaymentTime == 'Semiannual') {
                $this->amount=3101;
            }elseif ($this->PaymentTime == 'Annual') {
                $this->amount=5790;
            }else{
                 $this->dispatchBrowserEvent('error',['message'=>'Error  found payment failed']);
                $this->error=1;
            }
        }else{ 
            $this->dispatchBrowserEvent('error',['message'=>'Empty space found']);
            $this->error=1;
        }

        if ($this->error==1) {
           $this->dispatchBrowserEvent('error',['message'=>'Error occued']);
            return redirect('')->route('pricing')->with('error','Payments canceled');
        }else{
                $order_number = random_int(10000, 99999);
                $Paymentss=Payments::where('p_id',auth()->user()->u_id)->get()->first();

                if (!empty($Paymentss)) {
                  $order = Payments::update([
                     'p_receipt'=>auth()->user()->u_id,   
                    'p_status'=>0,  
                    'p_amount'=>$this->amount,
                    'p_time'=>$this->PaymentTime,
                   ])->where('p_id',auth()->user()->u_id);

                }else{
                    $order = Payments::create([  
                    'p_id'=>$order_number,
                    'p_receipt'=>auth()->user()->u_id,   
                    'p_status'=>0,  
                    'p_amount'=>$this->amount,
                    'p_time'=>$this->PaymentTime,
                ]);
                }
        
        if ($order) {
            
                $u_fullname=auth()->user()->u_fullname;
                if (!empty(auth()->user()->u_phoneline)) {
                   $u_phoneline=auth()->user()->u_phoneline;
                }else{
                    $u_phoneline='0780809031';
                }
                
                $u_email=auth()->user()->u_email;

             $paymentUrl = $this->pay(
                $order_number,
                $this->amount,
                $u_fullname,
                $u_phoneline,
                $this->PaymentTime." Subscription",
                $u_email
            ); 
             
            return redirect()->away($paymentUrl["data"]["link"]);

        }else{
             $this->dispatchBrowserEvent('error',['message'=>'Error occued']);
            return redirect('')->route('pricing')->with('error','Payments canceled');
        }

        } 

        }
    

    private function pay($tx_ref, $amount, $o_fullname, $o_phoneline, $title, $o_email)
    {
//      $currentURL = Request::url();
        $URL = "https://api.flutterwave.com/v3/payments";
        $SECRET_KEY = "FLWSECK_TEST-56e0791576171d316a748cab6fb25bda-X";
        $response = Http::withToken($SECRET_KEY)->post($URL,
            [
                "tx_ref" => $tx_ref,
                "amount" => $amount,
                "currency" => "RWF",
                "redirect_url" => "http://127.0.0.1:8000/igitree/confirm/Subscription",
                "payment_options" => "card",
                "customer" => [
                    "phonenumber" => $o_phoneline,
                    "name" => $o_fullname,
                    "email" => $o_email
                ],
                "customizations" => [
                    "title" => "Igitree",
                    "description" => "Payment for DNA kit",
                ]
            ]
        );
        return json_decode($response, true);
    }
    public function render()
    {
        return view('livewire.subcription.pricing');
    }
}
