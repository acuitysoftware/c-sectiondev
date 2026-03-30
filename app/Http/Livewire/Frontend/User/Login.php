<?php

namespace App\Http\Livewire\Frontend\User;

use Auth;
use Mail;
use Hash;
use Log;
use Validator;
use App\Models\Board;
use App\Models\BoardClass;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Mail\RegistrationMail;
use Livewire\Component;
use App\Http\Livewire\Traits\AlertMessage;

class Login extends Component
{
	use AlertMessage;
	public $name, $email, $password,$username;
    public function render()
    {
        return view('livewire.frontend.user.login');
    }

    public function save()
    {
    	
    	$this->validate([
             'username' => 'required|exists:users,username',
            'password' => 'required|min:6',
        ]);
        

        

        try {

            $user = User::role('STUDENT')->where(['username'=> $this->username,'active' => 1])->first();

            if (!$user || !Hash::check($this->password, $user->password)) {
                $deactive_user = User::where(['username'=> $this->username,'active' => 0])->exists();

                if($deactive_user){
                    $this->showToastr('error', 'User is not active.Please contact to admin', false);
                    return false;
                }
                else{
                    $this->showToastr('error', 'Your email/password combination was incorrect', false);
                    return false;
                }
               
            }
            else{
                $credentials = ['email' => $user->email, 'password' => $this->password, 'active' => 1];

                if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
                    $this->showToastr('success', 'Logged In Successfully');
                    return redirect()->route('home');
                }
            }

        } catch (\Exception $e) {
            $this->showToastr('error', 'Your email/password combination was incorrect', false);
            return false;

        }
    }
}
