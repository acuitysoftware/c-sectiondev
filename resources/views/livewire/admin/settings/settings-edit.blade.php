<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">

    	<x-admin.form-group>
	        <x-admin.lable value="Email ID" required />
	        <x-admin.input type="text" wire:model.defer="email" placeholder="Email ID"  />
	        <x-admin.input-error for="email" />
	    </x-admin.form-group>	    

	    <x-admin.form-group>
	        <x-admin.lable value="Phone Number" required />
	        <x-admin.input type="text" wire:model.defer="phone" placeholder="Phone Number" />
	        <x-admin.input-error for="phone" />
	    </x-admin.form-group>

	   
	   <x-admin.form-group>
	        <x-admin.lable value="Google Recaptcha Key" required/>
	        <x-admin.input type="text" wire:model.defer="google_recaptcha_key" placeholder="Google Recaptcha Key" />
	        <x-admin.input-error for="google_recaptcha_key" />
	    </x-admin.form-group>

		<x-admin.form-group>
	        <x-admin.lable value="Google Recaptcha Secret" required/>
	        <x-admin.input type="text" wire:model.defer="google_recaptcha_secret" placeholder="Google Recaptcha Secret" />
	        <x-admin.input-error for="google_recaptcha_secret" />
	    </x-admin.form-group>


		<x-admin.form-group class="col-lg-12">
	        <x-admin.lable value="Quick Link" required/>
	        <x-admin.input type="text" wire:model.defer="order_link" placeholder="Quick Link" />
	        <x-admin.input-error for="order_link" />
	    </x-admin.form-group>

		<x-admin.form-group>
	        <x-admin.lable value="Sign Up Link" required/>
	        <x-admin.input type="text" wire:model.defer="signup_link" placeholder="Sign Up Link" />
	        <x-admin.input-error for="signup_link" />
	    </x-admin.form-group>

		<x-admin.form-group>
	        <x-admin.lable value="Login Link" required/>
	        <x-admin.input type="text" wire:model.defer="login_link" placeholder="Login Link" />
	        <x-admin.input-error for="login_link" />
	    </x-admin.form-group>

		<x-admin.form-group>
	        <x-admin.lable value="Term & Conditions Link" required/>
	        <x-admin.input type="text" wire:model.defer="term_condition_link" placeholder="Term & Conditions Link" />
	        <x-admin.input-error for="term_condition_link" />
	    </x-admin.form-group>

		<x-admin.form-group>
	        <x-admin.lable value="Privacy Policy Link" required/>
	        <x-admin.input type="text" wire:model.defer="privacy_policy_link" placeholder="Privacy Policy Link" />
	        <x-admin.input-error for="privacy_policy_link" />
	    </x-admin.form-group>

		<x-admin.form-group>
	        <x-admin.lable value="Contact Link" required/>
	        <x-admin.input type="text" wire:model.defer="contact_link" placeholder="Contact Link" />
	        <x-admin.input-error for="contact_link" />
	    </x-admin.form-group>

	    <!-- <x-admin.form-group>
	        <x-admin.lable value="IOS App Link"  />
	        <x-admin.input type="text" wire:model.defer="ios_app_link" placeholder="IOS App Link"  />
	        <x-admin.input-error for="ios_app_link" />
	    </x-admin.form-group>


	    <x-admin.form-group>
	        <x-admin.lable value="Android App Link"  />
	        <x-admin.input type="text" wire:model.defer="android_app_link" placeholder="Android App Link"  />
	        <x-admin.input-error for="android_app_link" />
	    </x-admin.form-group> -->

	    <x-admin.form-group>
	        <x-admin.lable value="Reward Point for User profile" required />
	        <x-admin.input type="text" wire:model.defer="reward_points" placeholder="Reward Point for User profile"  />
	        <x-admin.input-error for="reward_points" />
	    </x-admin.form-group>
	    <x-admin.form-group>
	        <x-admin.lable value="1 Reward Point equal to INR" required />
	        <x-admin.input type="text" wire:model.defer="reward_points_to_inr" placeholder="1 Reward Point equal to INR"  />
	        <x-admin.input-error for="reward_points_to_inr" />
	    </x-admin.form-group>

	    

	    <x-admin.form-group>
	        <x-admin.lable value="Razor Pay Key" required />
	        <x-admin.input type="text" wire:model.defer="razor_pay_key" placeholder="Razor Pay Key"  />
	        <x-admin.input-error for="razor_pay_key" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Razor Pay Secret" required />
	        <x-admin.input type="text" wire:model.defer="razor_pay_secret" placeholder="Razor Pay Secret"  />
	        <x-admin.input-error for="razor_pay_secret" />
	    </x-admin.form-group>

	    	

    	
        <x-admin.form-group>
	        <x-admin.lable value="Address" required />
	        <x-admin.textarea type="text" rows="5" wire:model.defer="address" placeholder="Address"  />
	        <x-admin.input-error for="address" />
	    </x-admin.form-group>

	    <!--  <x-admin.form-group>
	        <x-admin.lable value="Address 2" required />
	        <x-admin.textarea type="text" rows="5" wire:model.defer="address_2" placeholder="Address 2"  />
	        <x-admin.input-error for="address_2" />
	    </x-admin.form-group> -->

	    <!-- <x-admin.form-group >
	        <x-admin.lable value="Map" required />
	        <x-admin.textarea type="text" rows="5" wire:model.defer="map" placeholder="Map"  />
	        <x-admin.input-error for="map" />
	    </x-admin.form-group> -->

	    

	    <x-admin.form-group>
	        <x-admin.lable value="Logo" required />
	        <x-admin.filepond wire:model="logo"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
	        <x-admin.input-error for="logo" />
			    @if($setting->logo)
		          <img src="{{asset('storage/app/public/'.$setting->logo) }}" style="width: 100px; height:100px;" alt=""  />
			    @endif
	    </x-admin.form-group>

	    
	    

	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('admin.dashboard')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>