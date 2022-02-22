<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use Mail;

class App extends Component
{
    public $state=[];

    public function resetForm()
    {
        $this->state='';
    }
    public function contactUs()
    {

        if (!empty($this->state)) {
            try {
                $details=[
                    'Name'=>$this->state['m_name'],
                    'Email'=>$this->state['m_email'],
                    'm_subject'=>$this->state['m_subject'],
                    'm_message'=>$this->state['m_message'],

                ];
                $to="iradukundajob3@gmail.com";
                $mail=Mail::to(env('MAIL_FROM_ADDRESS',$to))->send(new \App\Mail\ContactUs($details));
                    $this->resetForm();
                     $this->dispatchBrowserEvent('success',['message'=>"Thank you for contacting us"]);
                
            } catch (Exception $e) {
               $this->dispatchBrowserEvent('error',['message'=>"Unable to send  mail"]);
                           
            }
            }else{
               $this->dispatchBrowserEvent('error',['message'=>"Empty space found"]); 
            }
       
        
    }
    public function render()
    {
        return view('livewire.contact.app');
    }
}
