<x-admin-layout title="Super Chat Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Super Chat">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="Super Chat" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar" >
					{{-- <a href="{{route('chapter.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Chapter
					</a> --}}
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.chat.chatlist />
</x-admin-layout>