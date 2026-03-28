<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
        <x-admin.form-group >
            <x-admin.lable value="To Mail" required />
            <x-admin.input type="text" wire:model.defer="to_mail" placeholder="test@gmail.com" />
            <x-admin.input-error for="to_mail" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Subject" required />
            <x-admin.input type="text" wire:model.defer="subject" placeholder="Subject"  />
            <x-admin.input-error for="subject" />
        </x-admin.form-group>

        <x-admin.form-group class="col-lg-12">
            <x-admin.lable value="Content" required />
            <x-admin.textarea type="text" rows="5" wire:model.defer="content" placeholder="Write mail content here"  />
            <x-admin.input-error for="content" />
        </x-admin.form-group>

        </div>
        <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Send</x-admin.button>
    </x-slot>
</x-form-section>