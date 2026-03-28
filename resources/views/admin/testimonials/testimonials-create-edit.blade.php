<x-admin-layout title="Testimonials Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $testimonial ? 'Edit' : 'Add' }} Testimonials">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('testimonials.index') }}" value="Testimonials List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $testimonial ? 'Edit' : 'Add' }} Testimonials" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.testimonials.testimonials-create-edit :testimonial="$testimonial"/>
</x-admin-layout>