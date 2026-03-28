<x-admin-layout title="Withdrawal Request Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Withdrawal Request">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('withdrawal.request') }}" value="Withdrawal Request" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.withdrawal.withdrawal-list/>
</x-admin-layout>