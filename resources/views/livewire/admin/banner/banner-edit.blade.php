<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
	    <x-admin.form-group class="col-lg-12">
	        <x-admin.lable value="Page Title" required />
	        <x-admin.input type="text" wire:model.defer="page_name" placeholder="page_name"  readonly/>
	        <x-admin.input-error for="page_name" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Image" required />
	        <x-admin.filepond wire:model="image"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
	        <x-admin.input-error for="image" />
	        @if($isEdit)
			    @if($banner->banner)
		          <img src="{{asset('storage/app/public/'.$banner->banner) }}" style="width: 200px; height:60px;" alt=""  />
		        @else
		          <img src="{{asset('public/assets/images/banner.jpg') }}" alt="" style="width: 200px; height:60px;"/>
			    @endif
		    @endif
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Status" required/>
	        <x-admin.dropdown  wire:model.defer="active" placeHolderText="Please select one" autocomplete="off" >
	                @foreach ($statusList as $status)
	                    <x-admin.dropdown-item  :value="$status['value']" :text="$status['text']"/>                          
	                @endforeach
	        </x-admin.dropdown>
	        <x-admin.input-error for="active" />
	    </x-admin.form-group>

	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('banners.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>