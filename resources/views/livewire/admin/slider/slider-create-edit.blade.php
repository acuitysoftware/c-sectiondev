<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">

        <x-admin.form-group>
            <x-admin.lable value="Title" />
            <x-admin.input type="text" wire:model.defer="title" placeholder="Title"/>
            <x-admin.input-error for="title" />
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

        <x-admin.form-group>
            <x-admin.lable value="Sub Title" />
            <x-admin.textarea rows="5" type="text" wire:model.defer="sub_title" placeholder="Sub Title"  />
            <x-admin.input-error for="sub_title" />
        </x-admin.form-group>

       
    	
	    <x-admin.form-group>
	        <x-admin.lable value="Slider" required />
	        <x-admin.filepond wire:model="image"
	            allowImagePreview
	            imagePreviewMaxHeight="50"
	            allowFileTypeValidation
	            acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
	            allowFileSizeValidation
	            maxFileSize="100MB"/>
            @if($slider->image)
                @if($slider->file_type ==1)
                <img src="{{asset('storage/app/public/'.$slider->image) }}" style="width: 320px; height:240px;" alt=""  />
                @else
            	<video width="320" height="240" controls>
				  <source src="{{asset('storage/app/public/'.$slider->image) }}" >
				  Your browser does not support the video tag.
				</video>
                @endif
            @endif
	        <x-admin.input-error for="image" />

	    </x-admin.form-group>

        


	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('sliders.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>