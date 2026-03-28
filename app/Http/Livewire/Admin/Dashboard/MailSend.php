<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Str;
use Mail;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\UserMailSend;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class MailSend extends Component
{
	use AlertMessage,WithFileUploads;
    public $to_mail, $subject, $content;

        
    public function saveOrUpdate()
    {
        $this->validate([
        	'to_mail' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,4}$/ix',
        	'subject' => 'required',
        	'content' => 'required',
        ]);    

        $data['subject'] = $this->subject;
        $data['message'] = $this->content;
        Mail::to($this->to_mail)->send(new UserMailSend($data));
                
        $msgAction = 'Mail send successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('admin.dashboard');
    }
    public function render()
    {
        return view('livewire.admin.dashboard.mail-send');
    }
}
