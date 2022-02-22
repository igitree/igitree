<?php

namespace App\Http\Livewire\DnaKit;

use Livewire\Component;
use App\Models\Orders;

use Illuminate\Support\Facades\Http;

class Checkout extends Component
{
    public $o_uid;
     public $o_fullname;
     public $o_address;
     public $o_phoneline;
     public $o_email;
     public $o_status;
     public $o_notes;
     public $orders;
    public function order()
    {
       $amount=100;
        $order_number = random_int(10000, 99999);

        $order = Orders::create([  
            'o_uid'=>$order_number,
            'o_fullname'=>$this->o_fullname,
            'o_address'=>$this->o_address,
            'o_phoneline'=>$this->o_phoneline,
            'o_email'=>$this->o_email,
            'o_status'=>0,
            'o_notes'=>$this->o_notes, 
            'o_amount'=>100000,
        ]); 

         $paymentUrl = $this->pay(
            $order_number,
            $amount,
            $this->o_fullname,
            $this->o_phoneline,
            "Payment for DNA kit",
            $this->o_email
        ); 
         // dd($paymentUrl["data"]["link"]);
        return redirect()->away($paymentUrl["data"]["link"]);


    }

    private function pay($tx_ref, $amount, $o_fullname, $o_phoneline, $title, $o_email)
    {
//       $currentURL = Request::url();
        $URL = "https://api.flutterwave.com/v3/payments";
        $SECRET_KEY = "FLWSECK_TEST-56e0791576171d316a748cab6fb25bda-X";
        $response = Http::withToken($SECRET_KEY)->post($URL,
            [
                "tx_ref" => $tx_ref,
                "amount" => $amount,
                "currency" => "RWF",
                "redirect_url" => "http://127.0.0.1:8000/dna/confirm/payments",
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
        $this->orders=Orders::where('o_email',auth()->user()->u_email)->get();
        return view('livewire.dna-kit.checkout');
    }
}
