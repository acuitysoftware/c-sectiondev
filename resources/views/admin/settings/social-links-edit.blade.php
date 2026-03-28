<x-admin-layout title="Social Link Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $social_link ? 'Edit' : 'Add' }} Social Links">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $social_link ? 'Edit' : 'Add' }} Social Links" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.settings.social-links-edit :social_link="$social_link"/>
</x-admin-layout>