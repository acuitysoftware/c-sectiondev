<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
    	<x-admin.form-group>
	        <x-admin.lable value="Title" required />
	        <x-admin.input type="text" wire:model.defer="title" placeholder="Title"  />
	        <x-admin.input-error for="title" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Description" required />
	        <x-admin.textarea type="text" wire:model.defer="description" placeholder="Description"  />
	        <x-admin.input-error for="description" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Keywords" required />
	        <x-admin.textarea type="text" wire:model.defer="keywords" placeholder="Keywords" row="6" />
	        <x-admin.input-error for="keywords" />
	    </x-admin.form-group>

	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('seos.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>