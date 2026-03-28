<x-admin-layout title="Opening Hour Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $opening_hour ? 'Edit' : 'Add' }} Opening Hour">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('opening-hours.index') }}" value="Opening Hour List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $opening_hour ? 'Edit' : 'Add' }} Opening Hour" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.opening-hour.opening-hour-create-edit :opening_hour="$opening_hour"/>
</x-admin-layout>