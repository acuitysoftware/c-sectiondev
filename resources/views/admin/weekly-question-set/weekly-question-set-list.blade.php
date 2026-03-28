<x-admin-layout title="Master Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Weekly Question Set">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="Weekly Question Set" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar" >
					<a href="{{ route('weekly-question-sets.create', ['board_class_id' => $board_class->id]) }}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Set
					</a>
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.weekly-question-set.weekly-question-set-list :board_class="$board_class"/>
</x-admin-layout>