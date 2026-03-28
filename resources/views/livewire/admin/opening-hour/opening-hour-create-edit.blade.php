<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
    	<x-admin.form-group>
	        <x-admin.lable value="Day" required />
	        <x-admin.input type="text" wire:model.defer="day" placeholder="Day"  />
	        <x-admin.input-error for="day" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Time" required />
	        <x-admin.input type="text" wire:model.defer="time" placeholder="Time"  />
	        <x-admin.input-error for="time" />
	    </x-admin.form-group>
	  

	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('opening-hours.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>