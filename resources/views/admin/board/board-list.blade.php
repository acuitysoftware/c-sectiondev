<x-admin-layout title="Master Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Board">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="Board" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar" >
					<a href="{{route('boards.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Board
					</a>
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.board.board-list />
</x-admin-layout>