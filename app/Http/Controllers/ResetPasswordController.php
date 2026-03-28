<?php

namespace App\Http\Controllers;

use Mail;
use DB;
use Auth;
use Hash;
use Str;
use Session;
use Validator;
use Carbon\Carbon;
use App\Mail\ForgotPasswordMail;
use App\Http\Livewire\Traits\AlertMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
	use AlertMessage;
    public function forgotPasswordView(Request $request)
    {
        if(Auth::user() && Auth::user()->hasRole('STUDENT'))
        {
            return redirect()->route('home');
        }
        $data['title'] = 'Forgot Password';
        return view('frontend.pages.forgot_password', $data);
    }
    public function forgotPassword(Request $request)
    {
    	
		$rules = [
            'email' => ['required', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,4}$/ix', 'max:255','exists:users,email'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors(),'code'=>0]);
        }

		$user = User::where('email', $request->email)->first();
		if(is_null($user))
		{

	        Session::flash('success','Email not found! Please try again');
            return response ()->json (['code'=>0]);
		}

		$token = Str::random(120);
		DB::table('password_resets')
		->where('email', $request->email)->delete();

            DB::table('password_resets')->insert([
		    'email' => $request->email,
		    'token' => $token,
		    'created_at' => Carbon::now()
		]);
            
        $url = route('reset_password',['email'=>$user->email, 'token' =>$token]);
        $data['name'] = $user->full_name;
        $data['email'] = $user->email;
        $data['url'] = $url;
        Mail::to($user->email)->send(new ForgotPasswordMail($data));
        
        Session::flash('success','Reset mail send. Please check your email');
         return response ()->json (['code'=>1]);
	}

    public function adminForgotPassword(Request $request)
    {
        $rules = [
            'email' => ['required', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,4}$/ix', 'max:255'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors(),'code'=>0]);
        }

        $user = User::where('email', $request->email)->first();
        if(is_null($user))
        {

            $msgAction = 'Email not found! Please try again';
            $this->showToastr("error",$msgAction);
            return redirect()->route('login');
        }

        $token = Str::random(120);
        DB::table('password_resets')
        ->where('email', $request->email)->delete();

            DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
            
        $url = route('reset_password',['email'=>$user->email, 'token' =>$token]);
        $data['name'] = $user->full_name;
        $data['email'] = $user->email;
        $data['url'] = $url;
        Mail::to($user->email)->send(new ForgotPasswordMail($data));
        
        $msgAction = 'Reset mail send. Please check your email';
        $this->showToastr("success",$msgAction);
         return redirect()->route('login');
    }
    
    public function resetPassword(Request $request)
    {
    	$data['title'] ='Reset Password';
    	$userData = DB::table('password_resets')->where('email', $request->email)->where('token', $request->token)->first();
    	if($userData)
    	{
    		$user = User::where('email', $request->email)->first();
    		
    		$data['user'] = $user;
            if($user->hasRole('STUDENT'))
        		return view('frontend.pages.reset_password', $data);
            else
                return view('auth.reset-password', $data);
    	}
    	else
    	{
    		return redirect()->route('user.login')->with('error', 'Something went wrong');
    	}
    }

    public function resetPasswordSave(Request $request)
	{
		$request->validate([
			'password' => ['required', 'min:6','confirmed'],
			'password_confirmation' => ['required', 'min:6'],
		]);
		$user = User::where('email', $request->email)->first();
		if(is_null($user))
		{
			$msgAction = 'User not found! Please try again.';
	        $this->showToastr("success",$msgAction);
		}
		$user->update(['password' => $request->password]);
		DB::table('password_resets')->where('email', $request->email)->delete();
		$msgAction = 'Password changed successfully';
        $this->showToastr("success",$msgAction);
        if($user->hasRole('STUDENT'))
            return redirect()->route('user.login');
        else
            return redirect()->route('login');
	}
}
