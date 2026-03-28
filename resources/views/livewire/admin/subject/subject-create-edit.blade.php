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
	        <x-admin.dropdown  wire:model.defer="board_class_id" placeHolderText="Please select Class" autocomplete="off" >
	            <x-admin.dropdown-item  :value="''" :text="'Select Class'"/>        
                  @foreach ($board_class_list as $class)
                    <x-admin.dropdown-item  :value="$class->id" :text="$class->name"/>                          
	                @endforeach
	        </x-admin.dropdown>
	        <x-admin.input-error for="board_class_id" />
	    </x-admin.form-group>

	    <x-admin.form-group >
	        <x-admin.lable value="Subject Name" required />
	        <x-admin.input type="text" wire:model.defer="name" placeholder="Subject Name"  />
	        <x-admin.input-error for="name" />
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
        <x-admin.link :href="route('boards.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>