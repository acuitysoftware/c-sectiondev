<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
	    <x-admin.form-group class="col-lg-12">
	        <x-admin.lable value="Page Title" required />
	        <x-admin.input type="text" wire:model.defer="title" placeholder="Title"  readonly/>
	        <x-admin.input-error for="title" />
	    </x-admin.form-group>

        <x-admin.form-group class="col-lg-12">
            <x-admin.lable value="Discount Text" required />
            <x-admin.textarea type="text" wire:model.defer="content_2" placeholder="Discount Text" />
            <x-admin.input-error for="content_2" />
        </x-admin.form-group>

       
        <x-admin.form-group>
            <x-admin.lable value="Image " required />
            <x-admin.filepond wire:model="image_1"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
            @if($cms->image_1)
                <img src="{{asset('storage/app/public/'.$cms->image_1) }}" style="width: 150px; height:100px;display: inline-block ;" />
            @endif
            <x-admin.input-error for="image_1" />

        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Video" required />
            <x-admin.filepond wire:model="video_link"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['video/*']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
            @if($cms->video_link)
            <video width="150px" height="100px" controls>
                  <source src="{{asset('storage/app/public/'.$cms->video_link) }}" >
                  Your browser does not support the video tag.
                </video>
            @endif
            <x-admin.input-error for="video_link" />

        </x-admin.form-group>

        <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Get Mobile App Content" />
            <textarea  id="page_content"  placeholder="Get Mobile App Content" rows="6" >{{$cms->content_1}}</textarea>
            <input type="hidden" wire.model="content_1">
        </x-admin.form-group>

        
    	<script src="{{asset('public/admin_assets/vendors/general/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
        
	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled" id="submitBtn">Save</x-admin.button>
        <x-admin.link :href="route('cms.index')" color="secondary">Cancel</x-admin.link>
        <script type="text/javascript">
   
        var editor1 = CKEDITOR.replace('page_content', {
            versionCheck: false,
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        editor1.config.allowedContent = true;

        $('#submitBtn').click(function(){
            @this.set('content_1', editor1.getData());
        })
    </script>
    </x-slot>
</x-form-section>