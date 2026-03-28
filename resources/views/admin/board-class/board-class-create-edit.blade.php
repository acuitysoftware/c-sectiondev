<x-admin-layout title="Master Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $board_class ? 'Edit' : 'Add' }} Class">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('board-class.index') }}" value="Class List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $board_class ? 'Edit' : 'Add' }} Class" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.board-class.board-class-create-edit :board_class="$board_class"/>
</x-admin-layout>