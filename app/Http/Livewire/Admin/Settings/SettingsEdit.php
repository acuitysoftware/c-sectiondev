<?php

namespace App\Http\Livewire\Admin\Settings;

use Str;
use Livewire\Component;
use App\Models\Setting;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class SettingsEdit extends Component
{
	use AlertMessage,WithFileUploads;
	public $address, $address_2, $email, $phone, $footer_text, $map, $logo,$setting, $opening_hour, $razor_pay_secret, $tax, $paypal_client_id, $phone_2, $stripe_secret, $isEdit=false, $android_app_link, $ios_app_link, $razor_pay_key, $reward_points, $reward_points_to_inr,$google_recaptcha_secret, $google_recaptcha_key,$order_link;
    public $modeList =[];
    public $signup_link, $login_link, $privacy_policy_link,$term_condition_link,$contact_link;
	public function mount($setting = null)
    {
        if ($setting) {
            $this->setting = $setting;
            $this->fill($this->setting);
            $this->isEdit=true;
        }
        else
            $this->setting=new Setting;

        $this->modeList=[
            ['value'=>"", 'text'=> "Select Status"],
            ['value'=>'Sandbox', 'text'=> "Sandbox"],
            ['value'=>'Live', 'text'=> "Live"]
        ];
        
    }
    
    public function validationRuleForUpdate(): array
    {
        return[
                'email'=>['required','email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                'phone'=>['required'],
                'address'=>['required'],
                'logo'=>['required'],
                'razor_pay_key'=>['required'],
                'razor_pay_secret'=>['required'],
                'reward_points'=>['required'],
                'order_link'=>['required'],
                'google_recaptcha_secret'=>['required'],
                'google_recaptcha_key'=>['required'],
                'reward_points_to_inr'=>['required'],
                'login_link'=>['required'],
                'signup_link'=>['required'],
                'privacy_policy_link'=>['required'],
                'term_condition_link'=>['required'],
                'contact_link'=>['required'],
                /*'android_app_link'=>['nullable'],
                'ios_app_link'=>['nullable'],*/
                
                
            ];
    }

    public function saveOrUpdate()
    {
        $this->setting->fill($this->validate($this->validationRuleForUpdate()))->save();

        if(gettype($this->logo) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->logo->getClientOriginalExtension();       
            $this->logo->storeAs('public/images',$image);
            $fileName = 'images/'.$image;
            if(isset($this->setting->logo))
        	{
        		@unlink(storage_path('app/public/' .$this->setting->logo));
        	}
        }
        else{

            $fileName = $this->setting->logo;
        } 
        $this->setting->update([
        	'logo' => $fileName,
        ]);
        
        $msgAction = 'Setting was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('settings.edit');
    }

    public function render()
    {
        return view('livewire.admin.settings.settings-edit');
    }
}
