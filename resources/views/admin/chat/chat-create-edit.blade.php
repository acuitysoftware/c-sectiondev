<x-admin-layout title="Super Chat Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $chat ? 'Edit' : 'Add' }} Super Chat">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('chats.index') }}" value="Super Chat List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $chat ? 'Edit' : 'Add' }} Super Chat" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.chat.chat-create-edit :chat="$chat"/>
</x-admin-layout>