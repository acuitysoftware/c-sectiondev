<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Cookie;
use Hash;
use App\Http\Livewire\Traits\AlertMessage;
use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthController extends Controller
{
	use AlertMessage;
    public function signout()
    {
        Auth::guard('web')->logout();
        return redirect('/admin');
    }

    public function login(Request $request)
    {
    	$credentials = $request->validate([
            'email' => 'required|email',
            'password' =>'required'
        ]);
       
        
        if (Auth::attempt($credentials)) 
        {
        	$user = Auth::user();
			if ($user->active == '0') 
			{
    			Auth::guard('web')->logout();
    			$msgAction = 'User not active! Contact admin.';
    	        $this->showToastr("error",$msgAction);
    			return redirect()->back();
			}
			Auth::login($user);
			$msgAction = 'Logged In Successfully.';
	        $this->showToastr("success",$msgAction);
			return redirect()->route('admin.dashboard');
        }
        else
        {
        	$msgAction = 'Invalid credentials';
	        $this->showToastr("success",$msgAction);
          	return redirect()->back();
        }
    }
}
