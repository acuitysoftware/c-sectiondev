<x-admin-layout title="Seo Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Seo List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('seos.index') }}" value="Seo List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.seo.seo-list/>
</x-admin-layout>