<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Hash;
use App\Models\Banner;
use App\Models\RewardPoint;
use App\Models\Exam;
use App\Models\User;
use App\Models\State;
use App\Models\Withdraw;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function withdraw()
    {
        $data['title'] = 'Withdraw';
        $data['banner'] = Banner::where('slug','my-account')->where('active', 1)->first();
        return view('frontend.pages.withdraw', $data);
    }
}
