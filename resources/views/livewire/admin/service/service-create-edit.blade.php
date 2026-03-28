<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
    	<x-admin.form-group class="col-lg-12">
	        <x-admin.lable value="Service Title" required />
	        <x-admin.input type="text" wire:model.defer="title" placeholder="Service Title"  />
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
	        <x-admin.lable value="Image" required />
	        <x-admin.filepond wire:model="image"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
	        <x-admin.input-error for="image" />
			    @if($service->image)
		          <img src="{{asset('storage/app/public/'.$service->image) }}" style="width: 100px; height:100px;" alt=""  />
			    @endif
	    </x-admin.form-group>

	    <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Description" />
            <textarea  id="page_content"  placeholder="Description" rows="6" >{{$service->description}}</textarea>
            <input type="hidden" wire.model="description">
        </x-admin.form-group>

        <script src="{{asset('public/admin_assets/vendors/general/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

	    

	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled" id="submitBtn">Save</x-admin.button>
        <x-admin.link :href="route('services.index')" color="secondary">Cancel</x-admin.link>
        <script type="text/javascript">
   
            var editor1 = CKEDITOR.replace('page_content', {
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            editor1.config.allowedContent = true;
            

            $('#submitBtn').click(function(){
                @this.set('description', editor1.getData());
            })
        </script>
    </x-slot>
</x-form-section>