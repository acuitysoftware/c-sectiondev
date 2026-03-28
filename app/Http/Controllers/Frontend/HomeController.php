<?php

namespace App\Http\Controllers\Frontend;

use Mail;
use Stripe\Stripe;
use App\Models\Cms;
use App\Models\User;
use App\Models\Seo;
use App\Models\Banner;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\Menu;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactMailSendToUser;
use App\Mail\ContactMailSendToAdmin;
use App\Http\Livewire\Traits\AlertMessage;


class HomeController extends Controller
{
    use AlertMessage;
	public function index()
    {
    	$data['title'] = 'Home';
        $data['seo'] = Seo::where('slug','home')->first();
        $data['homeCms'] = Cms::where('active', 1)->where('slug','home')->first();
        
    	return view('frontend.pages.home', $data);
    }

    public function contactForm(Request $request)
    {

        $data = $request->validate([
            'name' =>'required',
            'email' =>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,4}$/ix',
           'phone' =>'required',
            'message' =>'required',
            'g-recaptcha-response' =>['required',new Recaptcha()],
        ],['g-recaptcha-response.required' => 'This captcha field is required']);

        $admin = Setting::first();
        
        Mail::to($admin->email)->send(new ContactMailSendToAdmin($data));
                
        
        $mail_data  = ['email' => $request->email];
        Mail::to($request->email)->send(new ContactMailSendToUser($mail_data));

        return redirect()->back()->with('success', 'Mail Send Successfully');
        /*return redirect()->route('contact.us')->with('success', 'Mail Send Successfully');*/

    }

}
