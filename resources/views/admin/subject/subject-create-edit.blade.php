<x-admin-layout title="Master Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $subject ? 'Edit' : 'Add' }} Class">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('subject.index') }}" value="Class List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $subject ? 'Edit' : 'Add' }} Class" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.subject.subject-create-edit :subject="$subject"/>
</x-admin-layout>