<x-admin-layout title="Site Settings">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $setting ? 'Edit' : 'Add' }} Settings">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $setting ? 'Edit' : 'Add' }} Settings" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.settings.settings-edit :setting="$setting"/>
</x-admin-layout>