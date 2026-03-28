<x-admin-layout title="Master Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Class">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="Class" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar" >
					<a href="{{route('board-class.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Class
					</a>
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.board-class.board-class-list />
</x-admin-layout>