<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
    	<x-admin.form-group class="col-lg-12">
            <x-admin.lable value="Page Title" />
            <x-admin.input type="text" wire:model.defer="title" placeholder="Title"  readonly/>
            <x-admin.input-error for="title" />
        </x-admin.form-group>

        <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Description" />
            <textarea  id="page_content"  placeholder="Description" rows="6" >{{$cms->description}}</textarea>
            <input type="hidden" wire.model="description">
        </x-admin.form-group>

        @if($cms->slug == 'gift-vouchers')
            <x-admin.form-group class="col-lg-12" wire:ignore>
                <x-admin.lable value="Content" />
                <textarea  id="content_1"  placeholder="Content" rows="6" >{{$cms->content_1}}</textarea>
                <input type="hidden" wire.model="content_1">
            </x-admin.form-group>
        @endif
	    

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
            var editor2 = null;
            @if($cms->slug == 'gift-vouchers')
            editor2 = CKEDITOR.replace('content_1', {
                versionCheck: false,
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            editor2.config.allowedContent = true;
            @endif

            $('#submitBtn').click(function(){
                @this.set('description', editor1.getData());
                @this.set('content_1', editor2.getData());
            })
        </script>
    </x-slot>
</x-form-section>