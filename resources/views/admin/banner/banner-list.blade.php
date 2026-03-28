<x-admin-layout title="Banner Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Banner List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('banners.index') }}" value="Banner List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.banner.banner-list/>
</x-admin-layout>