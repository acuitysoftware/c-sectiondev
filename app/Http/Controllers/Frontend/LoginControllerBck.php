<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Hash;
use Str;
use Log;
use Mail;
use Validator;
use App\Models\Board;
use App\Models\BoardClass;
use App\Models\Setting;
use App\Models\Payment;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ProductOrderMail;

class LoginControllerBck extends Controller
{
    public function login()
    {
        $data['title'] = 'Login';
    	return view('frontend.pages.login', $data);
    }

     public function register()
    {
        $data['title'] = 'Register';
    	return view('frontend.pages.register', $data);
    }

    public function loginSubmit(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        $setting = Setting::first();
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors(),'code'=>0]);
        }
        try {

            $user = User::role('STUDENT')->where(['email'=> $request->email,'active' => 1])->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                $deactive_user = User::where(['email'=> $request->email,'active' => 0])->exists();

                if($deactive_user){
                    return response ()->json (['error'=>['custom_error' => 'User is not active.Please contact to admin'],'code'=>0]);
                }
                else{
                    return response ()->json (['error'=>['custom_error' => 'Your email/password combination was incorrect.'],'code'=>0]);
                }
            }
            else{
                $credentials = ['email' => $request->email, 'password' => $request->password, 'active' => 1];

                if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {

                    if(is_null(Auth::user()->payment)){
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
                        Auth::logout();
                        if($order)
                        {
                            //dd($order);
                            return response ()->json (['order_id'=>$order->id, 'total_amount' => $total_amount,'id'=> $id,  'email'=> $email,'phone'=> $phone,  'name'=> $name ,'code'=>2]);
                        }
                        
                        return response ()->json (['error'=>['custom_error' => 'User is not active.Please contact to admin'],'code'=>2]);
                    }
                    //dd(Auth::user()->payment);
                    Session::flash('success','Logged In Successfully');
                    return response ()->json (['code'=>1]);
                }
            }

        } catch (\Exception $e) {
            Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            abort(500);
        }
    }

    public function logout(Request $request)
    {
      Auth::logout();
      return redirect()->route('home')->with('success','Logout Successfully');
    }
    public function payment(Request $request)
    {
      $user = User::find($request->id);
       $class = BoardClass::where('id', $user->board_class_id)->first();
       $start_date = date('Y-m-d');

        $expiry_date = date('Y-m-d', strtotime($start_date. '365days'));
      if($user){
        $payment = Payment::create([
            'user_id'=> $user->id,
            'board_class_id'=> $class->id,
            'sub_total'=> $class->price,
            'total'=> $class->price,
            'start_date' => $start_date,
            'expiry_date' => $expiry_date,
            'r_oder_id'=> $request->razorpay_order_id,
            'r_payment_id'=> $request->razorpay_payment_id,
        ]);

        if($payment)
        {   Auth::login($user, true);
            $data['id'] = $payment->id;
            $data['name'] = $user->name;
            Mail::to($user->email)->send(new ProductOrderMail($data));
            
            return response ()->json (['status'=>true]);
            
        }
        
        return response ()->json (['status'=>false]);

      }
    }

    
}
