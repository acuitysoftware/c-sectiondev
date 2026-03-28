<x-admin-layout title="Cms Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $cms ? 'Edit' : 'Add' }} Cms">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('cms.index') }}" value="Cms List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $cms ? 'Edit' : 'Add' }} Cms" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	
		<livewire:admin.cms.about-us-cms :cms="$cms"/>
	
</x-admin-layout>