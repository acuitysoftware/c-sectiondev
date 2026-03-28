<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
        <x-admin.form-group >
            <x-admin.lable value="Page Title" required />
            <x-admin.input type="text" wire:model.defer="title" placeholder="Title"  readonly/>
            <x-admin.input-error for="title" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Sub Title" required />
            <x-admin.input type="text" wire:model.defer="sub_title" placeholder="Sub Title"  />
            <x-admin.input-error for="sub_title" />
        </x-admin.form-group>

        <x-admin.form-group wire:ignore class="col-lg-12">
            <x-admin.lable value="Description" required />
            <textarea
            x-data x-init="editor = CKEDITOR.replace('description');
            editor.on('change', function(event){
                @this.set('description', event.editor.getData());
            })" wire:model.defer="description" id="description" class="form-control {{ $errors->has('description') ? 'is-invalid' :'' }}"></textarea>
            <x-admin.input-error for="description" />
        </x-admin.form-group>

        </div>
        <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('cms.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>