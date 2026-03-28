<x-admin.table>
    {{-- <x-slot name="search">
        <x-admin.input type="search" class="form-control form-control-sm" wire:model.debounce.500ms="search"
            aria-controls="kt_table_1" id="generalSearch" />
    </x-slot> --}}
    <x-slot name="perPage">
        <label>Show
            <x-admin.dropdown wire:model="perPage" class="custom-select custom-select-sm form-control form-control-sm">
                @foreach ($perPageList as $page)
                    <x-admin.dropdown-item :value="$page['value']" :text="$page['text']" />
                @endforeach
            </x-admin.dropdown> entries
        </label>
    </x-slot>

    <x-slot name="thead">
        <tr role="row">
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 22%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Name <!-- <i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('first_name')"></i> -->
            </th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 23%;"
                aria-label="Company Amount: activate to sort column ascending">Amount <!-- <i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('amount')"></i> --></th>
            <!-- <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                aria-label="Company Date: activate to sort column ascending">Request Date <i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy()"></i></th> -->
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-label="Status: activate to sort column ascending">Status</th>
            <th class="align-center" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions">Actions</th>
        </tr>

        <tr class="filter">
            <th>
                <x-admin.input type="search" wire:model.defer="searchName" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchAmount" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
           <!--  <th>
                <x-admin.input type="search" wire:model.defer="searchDate" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th> -->
            <th>
                <select class="form-control form-control-sm form-filter kt-input" wire:model.defer="searchStatus"
                    title="Select" data-col-index="2">
                    <option value="-1">Select One</option>
                    <option value="0">Pending</option>
                    <option value="1">Approved</option>
                    <option value="2">Cancelled</option>
                </select>
            </th>
            <th>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-brand kt-btn btn-sm kt-btn--icon" wire:click="search">
                            <span>
                                <i class="la la-search"></i>
                                <span>Search</span>
                            </span>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-secondary kt-btn btn-sm kt-btn--icon" wire:click="resetSearch">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                        </button>
                    </div>
                </div>
            </th>
        </tr>
    </x-slot>

    <x-slot name="tbody">
        @forelse($withdrawals as $withdrawal)
            <tr role="row" class="odd">
                <td>
                    {{$withdrawal->user->name}}
                </td>
                <td>{{$withdrawal->reward_points}}</td>
                <!-- <td>{{$withdrawal->created_at->format('d-M-Y')}}</td> -->
                <td>
                	@if($withdrawal->status == '0')
                		Pending
                	@elseif($withdrawal->status == '1')
                		Approved
                	@elseif($withdrawal->status == '2')
                		Cancelled
                	@endif
                </td>
                <td>
                	@if($withdrawal->status == '0')
                    <select class="form-control form-control-sm form-filter kt-input"
                    title="Select" data-col-index="2" wire:model.defer="status"  wire:change="statusChanged({{$withdrawal->id}})">
	                    <option value="0">Pending</option>
	                    <option value="1">Approved</option>
	                    <option value="2">Cancelled</option>
	                </select>
	                @elseif($withdrawal->status == '1')
                		Approved
                	@elseif($withdrawal->status == '2')
                		Cancelled
                	@endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="align-center">No records available</td>
            </tr>
        @endforelse
    </x-slot>
    <x-slot name="pagination">
    	{{ $withdrawals->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $withdrawals->firstitem() }} to {{ $withdrawals->lastitem() }} of {{ $withdrawals->total() }} entries
    </x-slot>
</x-admin.table>
