<x-admin-layout title="Gallery Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Gallery List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('galleries.index') }}" value="Gallery List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('galleries.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Gallery
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.gallery.gallery-list/>
</x-admin-layout>