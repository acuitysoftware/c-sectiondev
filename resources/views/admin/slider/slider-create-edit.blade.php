<x-admin-layout title="Slider Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $slider ? 'Edit' : 'Add' }} Slider">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('sliders.index') }}" value="Slider List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $slider ? 'Edit' : 'Add' }} Slider" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.slider.slider-create-edit :slider="$slider"/>
</x-admin-layout>