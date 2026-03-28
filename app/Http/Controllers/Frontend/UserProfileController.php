<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Hash;
use Validator;
use Session;
use App\Models\Banner;
use App\Models\RewardPoint;
use App\Models\Withdraw;
use App\Models\Exam;
use App\Models\User;
use App\Models\State;
use App\Models\Subject;
use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function profile()
    {
        $data['title'] = 'My Account';
        $data['banner'] = Banner::where('slug','my-account')->where('active', 1)->first();
        return view('frontend.pages.profile', $data);
    }

    public function myAccount()
    {
    	$user = Auth::user();
        $data['title'] = 'Dashboard';
        $data['states'] = State::get();
        $data['exams'] = Exam::with('subject', 'chapter','questions')->withCount('questions')->where('user_id', $user->id)->get();
        $data['points'] = RewardPoint::with('joinUser')->where('user_id', $user->id)->get();
        $data['user'] =$user;
        $data['withdraws'] = Withdraw::where('user_id', $user->id)->get();
        $data['banner'] = Banner::where('slug','my-account')->where('active', 1)->first();
        return view('frontend.pages.my-account', $data);
    }

    public function myGroup()
    {
        $user = Auth::user();
        $data['title'] = 'My Group';
        $data['group_users'] = User::with('class')->where('active', 1)->where('id', '!=', $user->id)->where('board_class_id', $user->board_class_id)->where('class_group_id', $user->class_group_id)->get();
        $data['states'] = State::get();
        $data['points'] = RewardPoint::with('joinUser')->where('user_id', $user->id)->get();
        $data['user'] =$user;
        $withdraw_points = Withdraw::where('user_id', $user->id)->where('status', '!=' ,'2')->sum('reward_points');

        $total_points = RewardPoint::where([
                'user_id'=>$user->id,
            ])->sum('reward_points');

        $data['total_points']= ($total_points-$withdraw_points);
         $data['subjects'] = Subject::where('board_class_id', $data['user']->board_class_id)->get();
        $data['banner'] = Banner::where('slug','my-account')->where('active', 1)->first();
        return view('frontend.pages.my-group', $data);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);
        $user = Auth::user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = $request->password;
            $user->save();

            return redirect()->route('user.profile')->with('success', 'Password Change Successfully');

        } else {
            return redirect()->route('user.profile')->with('error', 'Invalid old password');
        } 
    }
    public function profileUpdate(Request $request)
    {

        $user = Auth::user();
       $request->validate([
            'name' => 'required',
            'father_name' => 'required',
            'phone' => 'required|unique:users,phone,'.$user->id,
            'address' => 'required',
            'state_id' => 'required',
            'ps' => 'required',
            'post_office' => 'required',
            'pin_code' => 'required|digits_between:6,6',
            'district' => 'required',
        ]);

       /* $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors(),'code'=>0]);
        }*/
    	
    	
    	if($request->hasFile('profile_image')){
            $image = time() . '-' . rand(1000, 9999) . '.' . $request->profile_image->getClientOriginalExtension();       
            $request->profile_image->storeAs('public/profile_images',$image);
            $fileName = 'profile_images/'.$image;
            if(isset($user->profile_photo_path))
            {
                @unlink(storage_path('app/public/' .$user->profile_photo_path));
            }
        }
        else{
            $fileName = $user->profile_photo_path;
        } 

    	$first_name = '';
		$last_name = null;
		$full_name = explode(" ",$request->name);
		$first_name = $full_name[0];
		if(count($full_name)>1)
		{
			$last_name = $full_name[1];
		}
    	$user->update([
    		'first_name' => $first_name,
        	'last_name' => $last_name,
        	'name' => $request->name,
            'phone' => $request->phone,
        	'address' => $request->address,
        	'ps' => @$request->ps,
            'post_office' => @$request->post_office,
        	'profile_photo_path' => $fileName,
        	'pin_code' => @$request->pin_code,
            'district' => @$request->district,
        	'state_id' => @$request->state_id,
    	]);

        /*Session::flash('success','Profile Update Successfully');
            return response ()->json (['code'=>1]);*/
        return redirect()->route('user.account')->with('success','Profile Update Successfully');
    }
}
