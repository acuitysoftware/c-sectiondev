<x-admin-layout title="Master Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $question_set ? 'Edit' : 'Add' }} Question Set">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('question-sets.index', ['chapter_id' => $chapter->id]) }}" value="Question Set List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $question_set ? 'Edit' : 'Add' }} Question Set" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.question-set.question-set-create-edit :chapter="$chapter" :question_set="$question_set"/>
</x-admin-layout>