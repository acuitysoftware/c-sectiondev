<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">

      
        
      

         <x-admin.form-group  class="col-lg-12" >
	        <x-admin.lable value="Question" required />
	        <x-admin.input type="text" wire:model.defer="question" placeholder="Question"  />
	        <x-admin.input-error for="question" />
	    </x-admin.form-group>



        <x-admin.form-group class="col-lg-12" >
            <x-admin.lable value="Answer" required/>
            <x-admin.textarea type="text" rows="5" wire:model.defer="answer" placeholder="Answer"  />
           
        </x-admin.form-group>
        <x-admin.input-error for="answer" />

        <script src="{{asset('public/admin_assets/vendors/general/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>


       </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" id="submitBtn" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('chats.index')" color="secondary">Cancel</x-admin.link>
        {{-- <script type="text/javascript">
   
            var editor1 = CKEDITOR.replace('page_content', {
                versionCheck: false,
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            editor1.config.allowedContent = true;            

            $('#submitBtn').click(function(){
                @this.set('answer', editor1.getData());
            })
        </script> --}}
    </x-slot>
</x-form-section>