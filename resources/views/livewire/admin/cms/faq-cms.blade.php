<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
    	<x-admin.form-group class="col-lg-12">
	        <x-admin.lable value="Page Title" required />
	        <x-admin.input type="text" wire:model.defer="title" placeholder="Title"  readonly/>
	        <x-admin.input-error for="title" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Sub Title" required />
	        <x-admin.input type="text" wire:model.defer="sub_title" placeholder="Sub Title"  />
	        <x-admin.input-error for="sub_title" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Image 1" required />
	        <x-admin.filepond wire:model="image_file_1"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
	        <x-admin.input-error for="image_file_1" />
            <img src="{{asset('storage/app/public/'.$cms->image_1) }}" style="width: 150px; height:100px;display: inline-block ;" />
	        
	    </x-admin.form-group>

	    <x-admin.form-group wire:ignore class="col-lg-12">
            <x-admin.lable value="Description" required />
            <textarea
            x-data x-init="editor = CKEDITOR.replace('content_1');
            editor.on('change', function(event){
                @this.set('content_1', event.editor.getData());
            })" wire:model.defer="content_1" id="content_1" class="form-control {{ $errors->has('content_1') ? 'is-invalid' :'' }}"></textarea>
            <x-admin.input-error for="content_1" />
        </x-admin.form-group>

	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('cms.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>