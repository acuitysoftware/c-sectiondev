<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
        
      
	    
	    <x-admin.form-group >
	        <x-admin.lable value="Total Time(In Minute)" required />
	        <x-admin.input type="text" wire:model.defer="total_time" placeholder="Total Time(In Minute)"  />
	        <x-admin.input-error for="total_time" />
	    </x-admin.form-group>

	    <x-admin.form-group >
	        <x-admin.lable value="Pass Marks (in Percentage)" required />
	        <x-admin.input type="text" wire:model.defer="pass_marks_percentage" placeholder="Pass Marks (in Percentage)"  />
	        <x-admin.input-error for="pass_marks_percentage" />
	    </x-admin.form-group>


       

        <x-admin.form-group class="col-lg-12">
	        <x-admin.lable value="Status" required/>
	        <x-admin.dropdown  wire:model.defer="active" placeHolderText="Please select one" autocomplete="off" >
	                @foreach ($statusList as $status)
	                    <x-admin.dropdown-item  :value="$status['value']" :text="$status['text']"/>                          
	                @endforeach
	        </x-admin.dropdown>
	        <x-admin.input-error for="active" />
	    </x-admin.form-group>

	    

	    @foreach($questions as $key => $data)
	    @if($data['deleted'] == false)
            <x-admin.form-group>
                <x-admin.lable value="Question" required/>
                <x-admin.input type="text" wire:model.defer="questions.{{$key}}.question" placeholder="Question" autocomplete="off"/>
                <x-admin.input-error for="questions.{{$key}}.question" />
                
            </x-admin.form-group>

            <x-admin.form-group >
                <x-admin.lable value="Correct Answer" required/>
                <x-admin.input type="text" wire:model.defer="questions.{{$key}}.correct_answer" placeholder="Correct Answer"/>
                <x-admin.input-error for="questions.{{$key}}.correct_answer" />
            </x-admin.form-group>
            <x-admin.form-group >
                <x-admin.lable value="Option A" required/>
                <x-admin.input type="text" wire:model.defer="questions.{{$key}}.option_a" placeholder="Option A"/>
                <x-admin.input-error for="questions.{{$key}}.option_a" />
            </x-admin.form-group>
            <x-admin.form-group >
                <x-admin.lable value="Option B" required/>
                <x-admin.input type="text" wire:model.defer="questions.{{$key}}.option_b" placeholder="Option B"/>
                <x-admin.input-error for="questions.{{$key}}.option_b" />
            </x-admin.form-group>
            <x-admin.form-group >
                <x-admin.lable value="Option C" required/>
                <x-admin.input type="text" wire:model.defer="questions.{{$key}}.option_c" placeholder="Option C"/>
                <x-admin.input-error for="questions.{{$key}}.option_c" />
            </x-admin.form-group>
            <x-admin.form-group >
                <x-admin.lable value="Option D" required/>
                <x-admin.input type="text" wire:model.defer="questions.{{$key}}.option_d" placeholder="Option D"/>
                <x-admin.input-error for="questions.{{$key}}.option_d" />
            </x-admin.form-group>

        	@if($key != 0)
            <x-admin.form-group class="col-lg-12">
                <button type="button" href="javascript:" class="btn btn-danger" wire:click.prevent="deleteAttempt({{ $key }})">Remove</button>
            </x-admin.form-group>
            @endif
        @endif
        @endforeach
	        <x-admin.form-group>
	            <button class="btn btn-success" type="button" wire:click.prevent="addItem()" >Add More</button>
	        </x-admin.form-group>

       </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" id="submitBtn" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('chapter.index')" color="secondary">Cancel</x-admin.link>
        
    </x-slot>
</x-form-section>