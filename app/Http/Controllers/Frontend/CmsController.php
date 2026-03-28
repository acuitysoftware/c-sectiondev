<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Str;
use Mail;
use App\Models\Cms;
use App\Models\User;
use App\Models\Seo;
use App\Models\Banner;
use App\Models\Setting;
use Razorpay\Api\Api;
use App\Models\BoardClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Livewire\Traits\AlertMessage;
class CmsController extends Controller
{

    public function subscriptions()
    {
        if(is_null(Auth::user()->payment)){
            $data['title'] = 'Subscriptions';
            $data['user'] = Auth::user();
            $data['banner'] = Banner::where('slug','subscriptions')->where('active', 1)->first();
            $data['cms'] = Cms::where('active', 1)->where('slug','subscriptions')->first();
            return view('frontend.pages.subscriptions', $data);
        }
        else{
             return redirect()->route('home')->with('warning','You have already a subscriptions plan');
        }
    }
    public function subscriptionSave(Request $request)
    {
        $setting = Setting::first();
        $id = Auth::user()->id;
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $phone = Auth::user()->phone;
        $class = BoardClass::where('id', Auth::user()->board_class_id)->first();
        $total_amount = round($class->price, 2);
        $receiptid = Str::random(20);
        //dd($total_amount);
        $api = new Api ($setting->razor_pay_key , $setting->razor_pay_secret);
        $order  = $api->order->create([
                'receipt'         => $receiptid,
                'amount'          => $total_amount*100,
                'currency'        => 'INR',
            ]);
        if($order)
        {
            //dd($order);
            return response ()->json (['order_id'=>$order->id, 'total_amount' => $total_amount,'id'=> $id,  'email'=> $email,'phone'=> $phone,  'name'=> $name ,'code'=>2]);
        }
        return response ()->json (['code'=>0]);
    }
	public function aboutUs()
    {
        $data['title'] = 'About Us';
        $data['banner'] = Banner::where('slug','about-us')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','about-us')->first();
        $data['aboutUsCms'] = Cms::where('active', 1)->where('slug','about-us')->first();
        return view('frontend.pages.about_us', $data);
    }

    public function visionStatement()
    {
        $data['banner'] = Banner::where('slug','vision-statement')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','vision-statement')->first();
        $data['aboutUsCms'] = Cms::where('active', 1)->where('slug','vision-statement')->first();
    	return view('frontend.pages.about_us', $data);
    }
    public function termAndConditions()
    {
        $data['banner'] = Banner::where('slug','term-and-conditions')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','term-and-conditions')->first();
        $data['cms'] = Cms::where('active', 1)->where('slug','term-and-conditions')->first();
    	return view('frontend.pages.term_and_conditions', $data);
    }
    public function privacyPolicy()
    {
        $data['banner'] = Banner::where('slug','privacy-policy')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','privacy-policy')->first();
        $data['cms'] = Cms::where('active', 1)->where('slug','privacy-policy')->first();
    	return view('frontend.pages.privacy_policy', $data);
    }
    public function sustainabilityDevelopmentGoal()
    {
        $data['banner'] = Banner::where('slug','sustainability-development-goal')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','sustainability-development-goal')->first();
        $data['aboutUsCms'] = Cms::where('active', 1)->where('slug','sustainability-development-goal')->first();
    	return view('frontend.pages.about_us', $data);
    }
    public function valuesEducation()
    {
        $data['banner'] = Banner::where('slug','values-education')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','values-education')->first();
        $data['aboutUsCms'] = Cms::where('active', 1)->where('slug','values-education')->first();
    	return view('frontend.pages.about_us', $data);
    }
    public function ourStaff()
    {
        $data['banner'] = Banner::where('slug','our-staff')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','our-staff')->first();
        $data['aboutUsCms'] = Cms::where('active', 1)->where('slug','our-staff')->first();
    	return view('frontend.pages.about_us', $data);
    }


    public function commitment()
    {
        $data['banner'] = Banner::where('slug','commitment')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','commitment')->first();
        $data['statutoryInformationCms'] = Cms::where('active', 1)->where('slug','commitment')->first();
    	return view('frontend.pages.statutory_information', $data);
    }

    public function policies()
    {
        $data['banner'] = Banner::where('slug','policies')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','policies')->first();
        $data['statutoryInformationCms'] = Cms::where('active', 1)->where('slug','policies')->first();
    	return view('frontend.pages.statutory_information', $data);
    }
    public function unrivalledSupport()
    {
        $data['banner'] = Banner::where('slug','unrivalled-support')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','unrivalled-support')->first();
        $data['statutoryInformationCms'] = Cms::where('active', 1)->where('slug','unrivalled-support')->first();
    	return view('frontend.pages.statutory_information', $data);
    }
    public function timeToThink()
    {
        $data['banner'] = Banner::where('slug','time-to-think')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','time-to-think')->first();
        $data['pupilZoneCms'] = Cms::where('active', 1)->where('slug','time-to-think')->first();
    	return view('frontend.pages.pupil_zone', $data);
    }
    public function resourcesAndFeatures()
    {
        $data['banner'] = Banner::where('slug','resources-and-features')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','resources-and-features')->first();
        $data['pupilZoneCms'] = Cms::where('active', 1)->where('slug','resources-and-features')->first();
    	return view('frontend.pages.pupil_zone', $data);
    }
    public function whyChooseUs()
    {
        $data['banner'] = Banner::where('slug','why-choose-us')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','why-choose-us')->first();
        $data['pupilZoneCms'] = Cms::where('active', 1)->where('slug','why-choose-us')->first();
    	return view('frontend.pages.pupil_zone', $data);
    }
    public function conclusion()
    {
        $data['banner'] = Banner::where('slug','conclusion')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','conclusion')->first();
        $data['pupilZoneCms'] = Cms::where('active', 1)->where('slug','conclusion')->first();
    	return view('frontend.pages.pupil_zone', $data);
    }
    public function howItWorks()
    {
        $data['banner'] = Banner::where('slug','how-it-works')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','how-it-works')->first();
        $data['pupilZoneCms'] = Cms::where('active', 1)->where('slug','how-it-works')->first();
    	return view('frontend.pages.pupil_zone', $data);
    }
    public function contactUs()
    {
        $data['banner'] = Banner::where('slug','contact-us')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','contact-us')->first();
        $data['pupilZoneCms'] = Cms::where('active', 1)->where('slug','contact-us')->first();
    	return view('frontend.pages.contact_us', $data);
    }
}
