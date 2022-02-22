<?php

namespace App\Http\Livewire\DnaKit;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Orders;
class Payments extends Component
{
    public function render(Request $request)
    { 
        return view('livewire.dna-kit.payments');
    }
}
