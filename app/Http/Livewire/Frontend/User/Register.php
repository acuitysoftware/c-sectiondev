<?php

namespace App\Http\Livewire\Frontend\User;

use Auth;
use Mail;
use Hash;
use Log;
use Validator;
use App\Models\Board;
use App\Models\ClassGroup;
use App\Models\Setting;
use App\Models\RewardPoint;
use App\Models\BoardClass;
use App\Models\State;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Mail\RegistrationMail;
use Livewire\Component;
use App\Http\Livewire\Traits\AlertMessage;

class Register extends Component
{
    use AlertMessage;
    public $name, $email, $phone, $board_id, $board_class_id, $referral_code, $user_referral_code, $boards = [], $classes = [], $password, $password_confirmation, $post_office, $father_name, $ps, $district, $state_id, $pin_code, $states = [], $address;

    public function mount()
    {
        $this->boards = Board::where('active', 1)->get();
        $this->states =  State::get();;
    }
    public function render()
    {
        return view('livewire.frontend.user.register');
    }

    public function updatedBoardId($id)
    {
        $this->classes = BoardClass::where('board_id', $id)->where('active', 1)->get();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required|unique:users',
            'board_id' => 'required',
            'post_office' => 'required',
            'father_name' => 'required',
            'ps' => 'required',
            'address' => 'required',
            'pin_code' => 'required|digits_between:6,6',
            'state_id' => 'required',
            'district' => 'required',
            'board_class_id' => 'required',
            'referral_code' => 'nullable|exists:users,user_referral_code',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,4}$/ix|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);




        $first_name = '';
        $last_name = null;
        $full_name = explode(" ", $this->name);
        $first_name = $full_name[0];
        if (count($full_name) > 1) {
            $last_name = $full_name[1];
        }
        /*try {*/

        $code = null;
        while (true) {
            $numSeed = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $shuffled = str_shuffle($numSeed);
            $code  =  substr($shuffled, 1, 6);
            $data = User::where('user_referral_code', $code)->count();
            if ($data == 0) {
                break;
            }
        }

        $setting = Setting::first();
        $group = ClassGroup::where('board_class_id', $this->board_class_id)->first();
        $user = User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'name' => $this->name,
            'username' => $first_name . '' . $this->phone,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => $this->password,
            'board_id' => $this->board_id,
            'board_class_id' => $this->board_class_id,
            'referral_code' => $this->referral_code,
            'district' => $this->district,
            'address' => $this->address,
            'ps' => $this->ps,
            'pin_code' => $this->pin_code,
            'state_id' => $this->state_id,
            'father_name' => $this->father_name,
            'post_office' => $this->post_office,
            'user_referral_code' => $code,
            'class_group_id' => @$group->id,
        ]);
        $user->assignRole('STUDENT');

        $getUser =  null;
        if ($this->referral_code) {

            $getUser = User::where('user_referral_code', $this->referral_code)->first();
        }

        if ($getUser) {
            RewardPoint::create([
                'type' => 1,
                'user_id' => $getUser->id,
                'join_user_id' => $user->id,
                'student_name' => $user->name,
                'reward_points' => $setting->reward_points,
            ]);
        }


        $last_user = User::find($user->id);
        $data = [
            'id' => $last_user->id,
            'password' => $this->password
        ];
        try {

            Mail::to($user->email)->send(new RegistrationMail($data));
        } catch (\Throwable $e) {
            \Log::error('Email send failed: ' . $e->getMessage());
        }

        Session::flash('success', 'Registration Successfully');
        return redirect()->route('user.login');

        /*} catch (\Exception $e) {
            Session::flash('error',$e->getMessage());
        	return redirect()->route('user.register');
        }*/
    }
}
