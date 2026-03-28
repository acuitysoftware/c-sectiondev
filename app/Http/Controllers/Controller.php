<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Cms;
use App\Models\Setting;
use App\Models\SocialLink;
use App\Models\Slider;
use View;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        ini_set('max_execution_time', 3000);
        $contactUs = Cms::where('slug','contact-us')->first();
        $getHomeCms = Cms::where('slug','home')->first();
        $socialLinks = SocialLink::where('active',1)->orderBY('id','asc')->get();
        $sliders = Slider::where('active', 1)->latest()->get();
        $slider = Slider::where('active', 1)->first();
        $sliderImages=[];
        if(count($sliders))
        {
          foreach($sliders as $sliderData)
          {
            $sliderImages[]=url('storage/app/public/')."/".$sliderData->image;
          }
        }
        //dd($sliderImages);
        $siteSetting = Setting::first();
        View::share('contactUs', $contactUs);
        View::share('siteSetting', $siteSetting);
        View::share('socialLinks', $socialLinks);
        View::share('getHomeCms', $getHomeCms);
        View::share('sliderImages', $sliderImages);
        View::share('slider', $slider);
    }
}
