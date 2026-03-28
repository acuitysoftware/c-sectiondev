<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    
    public function edit()
    {
        $setting = Setting::first();
        return view('admin.settings.settings-edit',compact('setting'));
    }

    public function socialLinks()
    {
        $setting = Setting::first();
        return view('admin.settings.social-links-edit',compact('setting'));
    }

    public function socialLinksList()
    {
        return view('admin.settings.social-links-list');
    }
    public function changePassword()
    {
        return view('admin.settings.change-password');
    }

}
