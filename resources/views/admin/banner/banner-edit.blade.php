<x-admin-layout title="Banner Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $banner ? 'Edit' : 'Add' }} Banner">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('banners.index') }}" value="Banner List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $banner ? 'Edit' : 'Add' }} Banner" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.banner.banner-edit :banner="$banner"/>
</x-admin-layout>