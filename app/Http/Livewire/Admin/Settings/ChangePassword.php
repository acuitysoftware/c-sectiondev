<?php

namespace App\Http\Livewire\Admin\Settings;

use Str;
use Hash;
use Auth;
use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class ChangePassword extends Component
{
	use AlertMessage,WithFileUploads;
	public $old_password, $password, $password_confirmation, $user;

	public function mount()
	{
		$this->user = Auth::user();
	}

	public function saveOrUpdate()
	{
		$this->validate([
            'old_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);
        if (Hash::check($this->old_password, $this->user->password)) {
            $this->user->password = $this->password;
            $this->user->save();


            $msgAction = 'Password Change Successfully';
	        $this->showToastr("success", $msgAction);
	        return redirect()->route('change.password');

        } else {
        	$msgAction = 'Invalid old password';
	        $this->showToastr("error", $msgAction);
	        return redirect()->route('change.password');
	 	}       
	}
	

    public function render()
    {
        return view('livewire.admin.settings.change-password');
    }
}
