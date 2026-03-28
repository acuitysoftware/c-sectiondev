<x-admin-layout title="Master Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Subject">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="Subject" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar" >
					<a href="{{route('subject.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Subject
					</a>
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.subject.subject-list />
</x-admin-layout>