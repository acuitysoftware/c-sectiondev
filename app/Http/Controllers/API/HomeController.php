<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

/**
 * @group  Home Management
 *
 * APIs for managing basic auth functionality
 */
class HomeController extends Controller
{
    /** 
     * @response  {
    "status": true,
    "data": {
        "id": 1,
        "logo": "images/1697115559-6211.png",
        "footer_logo": null,
        "header_text": null,
        "footer_text": null,
        "address": "kolkata",
        "address_2": null,
        "email": "animeshmondal832@gmail.com",
        "email_2": null,
        "phone": "9876543210",
        "phone_2": null,
        "order_link": "https://www.google.com/",
        "google_link": null,
        "razor_pay_key": "rzp_test_AlckoYRzH7ONlI",
        "razor_pay_secret": "AVsveQ6ZiIIuVLNchhsdsMZw",
        "reward_points": "10",
        "reward_points_to_inr": "5",
        "android_app_link": null,
        "ios_app_link": null,
        "google_recaptcha_key": "6LeNIu8mAAAAAHT9pJUEYmRZ71S15oXLhSruWF_w",
        "google_recaptcha_secret": "6LeNIu8mAAAAAIBh2KUjISnPSOqQ3cBbLyh-0O81",
        "map": null,
        "opening_hour": null,
        "login_link": "http://localhost/c-section/admin/cms/term-and-conditions",
        "signup_link": "http://localhost/c-section/admin/cms/term-and-conditions",
        "privacy_policy_link": "http://localhost/c-section/admin/cms/term-and-conditions",
        "term_condition_link": "http://localhost/c-section/admin/cms/term-and-conditions",
        "contact_link": "http://localhost/c-section/admin/cms/term-and-conditions",
        "created_at": "2023-10-09T07:56:10.000000Z",
        "updated_at": "2025-03-24T07:08:26.000000Z"
    }
}
     */
    public function siteSettings()
    {
        $setting = Setting::first();
        return response()->json(["status" => true, "data" => $setting]);
    }
}
