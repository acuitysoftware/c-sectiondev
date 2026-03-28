<x-admin-layout title="Social Link Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Social Link  List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('social-links.index') }}" value="Social Link  List" />
				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
					<a href="{{route('social-links.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Social Link 
					</a>
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.settings.social-links-list />
</x-admin-layout>