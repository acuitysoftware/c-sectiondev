<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
            <x-admin.form-group>
                <x-admin.lable value="Name" required />
                <x-admin.input type="text" wire:model.defer="name" placeholder="Name"  />
                <x-admin.input-error for="name" />
            </x-admin.form-group>


            <x-admin.form-group>
                <x-admin.lable value="Email" required />
                <x-admin.input type="text" wire:model.defer="email" placeholder="Email" autocomplete="off"/>
                <x-admin.input-error for="email" />
            </x-admin.form-group>

            <x-admin.form-group>
                <x-admin.lable value="Phone"  required />
                <x-admin.input type="text" wire:model.defer="phone" placeholder="Phone"   />
                <x-admin.input-error for="phone" />
            </x-admin.form-group>

            <!-- <x-admin.form-group>
                <x-admin.lable value="User ID" required />
                <x-admin.input type="text" wire:model.defer="user_id" placeholder="User ID" autocomplete="off" />
                <x-admin.input-error for="user_id" />
            </x-admin.form-group> -->

            @if(!$isEdit)
            <x-admin.form-group>
                <x-admin.lable value="Password"  required />
                <x-admin.input type="password" wire:model.defer="password" placeholder="Password" autocomplete="off" />
                <x-admin.input-error for="password" />
            </x-admin.form-group>

            <x-admin.form-group>
                <x-admin.lable value="Confirm Password"  required />
                <x-admin.input type="password" wire:model.defer="password_confirmation" placeholder="Re enter Password" autocomplete="off" />
                <x-admin.input-error for="password_confirmation" />
            </x-admin.form-group>
            @endif


            <x-admin.form-group>
                <x-admin.lable value="Board" required/>
                <x-admin.dropdown  wire:model.defer="board_id" placeHolderText="Please select one" autocomplete="off" >
                        @foreach ($boards as $item)
                            <x-admin.dropdown-item  :value="$item['id']" :text="$item['name']"/>                          
                        @endforeach
                </x-admin.dropdown>
                <x-admin.input-error for="board_id" />
            </x-admin.form-group>

            <x-admin.form-group>
                <x-admin.lable value="Class" required/>
                <x-admin.dropdown  wire:model.defer="board_class_id" placeHolderText="Please select one" autocomplete="off" >
                        @foreach ($classes as $item)
                            <x-admin.dropdown-item  :value="$item['id']" :text="$item['name']"/>                          
                        @endforeach
                </x-admin.dropdown>
                <x-admin.input-error for="board_class_id" />
            </x-admin.form-group>

            <x-admin.form-group>
                <x-admin.lable value="Current Group" required/>
                <x-admin.dropdown  wire:model.defer="class_group_id" placeHolderText="Please select one" autocomplete="off" >
                        @foreach ($groups as $item)
                            <x-admin.dropdown-item  :value="$item['id']" :text="$item['name']"/>                          
                        @endforeach
                </x-admin.dropdown>
                <x-admin.input-error for="class_group_id" />
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
        <x-admin.link :href="route('users.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>