<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">

    	<x-admin.form-group>
	        <x-admin.lable value="Old Password" required />
	        <x-admin.input type="password" wire:model.defer="old_password" placeholder="Old Password"  />
	        <x-admin.input-error for="old_password" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Password" required />
	        <x-admin.input type="password" wire:model.defer="password" placeholder="Password" />
	        <x-admin.input-error for="password" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Confirm Password" required />
	        <x-admin.input type="password" wire:model.defer="password_confirmation" placeholder="Confirm Password" />
	        <x-admin.input-error for="password_confirmation" />
	    </x-admin.form-group>


	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('admin.dashboard')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>