<x-admin-layout title="Master Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Question Set">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="Question Set" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar" >
					<a href="{{ route('question-sets.create', ['chapter_id' => $chapter->id]) }}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Set
					</a>
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.question-set.question-set-list :chapter="$chapter"/>
</x-admin-layout>