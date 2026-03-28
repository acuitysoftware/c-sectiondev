<x-admin-layout title="Testimonials Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Testimonials List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('testimonials.index') }}" value="Testimonials List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('testimonials.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Testimonials
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.testimonials.testimonials-list/>
</x-admin-layout>