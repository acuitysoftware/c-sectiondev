<x-admin-layout title="Master Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $question_set ? 'Edit' : 'Add' }} Weekly Question Set">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('weekly-question-sets.index', ['board_class_id' => $board_class->id]) }}" value="Weekly Question Set List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $question_set ? 'Edit' : 'Add' }} Weekly Question Set" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.weekly-question-set.weekly-question-set-create-edit :board_class="$board_class" :question_set="$question_set"/>
</x-admin-layout>