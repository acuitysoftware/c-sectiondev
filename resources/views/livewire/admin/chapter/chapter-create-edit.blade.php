<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">

      
        
      <x-admin.form-group>
	        <x-admin.lable value="Board Name" required/>
	        <x-admin.dropdown   wire:model="board_id" placeHolderText="Please select Board" autocomplete="off" >
	            <x-admin.dropdown-item  :value="''" :text="'Select Board'"/>        
                  @foreach ($board_list as $board)
                    <x-admin.dropdown-item  :value="$board->id" :text="$board->name"/>                          
	                @endforeach
	        </x-admin.dropdown>
	        <x-admin.input-error for="board_id" />
	    </x-admin.form-group>

        <x-admin.form-group>
	        <x-admin.lable value="Class Name" required/>
	        <x-admin.dropdown  wire:model="board_class_id" placeHolderText="Please select Class" autocomplete="off" >
	            <x-admin.dropdown-item  :value="''" :text="'Select Class'"/>        
                  @foreach ($board_class_list as $class)
                    <x-admin.dropdown-item  :value="$class->id" :text="$class->name"/>                          
	                @endforeach
	        </x-admin.dropdown>
	        <x-admin.input-error for="board_class_id" />
	    </x-admin.form-group>

        <x-admin.form-group>
	        <x-admin.lable value="Subject Name" required/>
	        <x-admin.dropdown  wire:model.defer="subject_id" placeHolderText="Please select Subject" autocomplete="off" >
	            <x-admin.dropdown-item  :value="''" :text="'Select Subject'"/>        
                  @foreach ($subject_list as $sub)
                    <x-admin.dropdown-item  :value="$sub->id" :text="$sub->name"/>                          
	                @endforeach
	        </x-admin.dropdown>
	        <x-admin.input-error for="subject_id" />
	    </x-admin.form-group>
	    
	    <x-admin.form-group >
	        <x-admin.lable value="Chapter Name" required />
	        <x-admin.input type="text" wire:model.defer="name" placeholder="Chapter Name"  />
	        <x-admin.input-error for="name" />
	    </x-admin.form-group>

        <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Description" required/>
            <textarea  id="page_content"  placeholder="Description" rows="12" >{{$chapter->description}}</textarea>
            <input type="hidden" wire.model="description">
           
        </x-admin.form-group>
        <x-admin.input-error for="description" />

        <script src="{{asset('public/admin_assets/vendors/general/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>


        <x-admin.form-group>
	        <x-admin.lable value="Files (Multiple)"  />
	        <x-admin.filepond wire:model="chapter_files"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['application/pdf']"
                    allowFileSizeValidation
                    maxFileSize="10mb" multiple/>
	        <x-admin.input-error for="chapter_files" />
	        
	    </x-admin.form-group>

		    @if(count($chapter->chapterFiles))
	        	<x-admin.form-group>
			    @foreach($chapter->chapterFiles as $image)
			    	@if($image->file_type == 'pdf')
			    	<div class="remove_image" wire:click="deleteAttempt({{ $image->id }})">
	                <iframe src="{{asset('storage/app/public/'.$image->file_name) }}" style="width: 100%; height:200px;"></iframe>
		            <div class="delete_icon">X</div>
		            </div>
		            @endif
		        @endforeach
		    	</x-admin.form-group>
	        @endif

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
        <x-admin.button type="submit" id="submitBtn" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('chapter.index')" color="secondary">Cancel</x-admin.link>
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