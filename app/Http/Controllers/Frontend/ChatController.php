<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
    	$data['title'] = 'Super Chat';
        /* $data['seo'] = Seo::where('slug','chat')->first();
        $data['cms'] = Cms::where('active', 1)->where('slug','chat')->first(); */
        
    	return view('frontend.pages.chat', $data);
    }
}
