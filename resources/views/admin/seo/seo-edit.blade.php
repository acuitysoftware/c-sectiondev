<x-admin-layout title="Seo Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $seo ? 'Edit' : 'Add' }} Seo">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('seos.index') }}" value="Seo List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $seo ? 'Edit' : 'Add' }} Seo" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.seo.seo-edit :seo="$seo"/>
</x-admin-layout>