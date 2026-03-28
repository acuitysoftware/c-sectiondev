<x-admin-layout title="Exam Result Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Exam Result List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('exams.index') }}" value="Exam Result List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.exam.exam-list/>
</x-admin-layout>