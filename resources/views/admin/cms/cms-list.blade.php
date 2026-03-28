<x-admin-layout title="CMS Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="CMS List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('cms.index') }}" value="CMS List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
						
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.cms.cms-list/>
</x-admin-layout>