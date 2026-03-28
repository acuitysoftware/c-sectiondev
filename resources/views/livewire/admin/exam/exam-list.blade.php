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
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Name 
            </th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                aria-label="Company Amount: activate to sort column ascending">Board</th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                aria-label="Company Amount: activate to sort column ascending">Class</th>
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                aria-label="Status: activate to sort column ascending">Status</th>
            <th class="align-center" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions">Actions</th>
        </tr>

        <tr class="filter">
            <th>
                <x-admin.input type="search" wire:model.defer="searchName" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <select class="form-control form-control-sm form-filter kt-input" wire:model="searchBoardId"
                    title="Select" data-col-index="2">
                    <option value="">Select Board</option>
                    @foreach ($boardList as $board)
                    <option value="{{$board->id}}">{{$board->name}}</option>
	                @endforeach
                </select>
            </th>
            <th>
                <select class="form-control form-control-sm form-filter kt-input" wire:model="searchClassId"
                    title="Select" data-col-index="2">
                    <option value="">Select Class</option>
                    @foreach ($classList as $class)
                    <option value="{{$class->id}}">{{$class->name}}</option>
	                @endforeach
                </select>
            </th>
           <!--  <th>
                <x-admin.input type="search" wire:model.defer="searchDate" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th> -->
            <th>
                <select class="form-control form-control-sm form-filter kt-input" wire:model.defer="searchStatus"
                    title="Select" data-col-index="2">
                    <option value="-1">Select Status</option>
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
        @forelse($exams as $exam)
            <tr role="row" class="odd">
                <td>
                    {{$exam->user->name}}
                </td>
                <td>{{$exam->board?$exam->board->name:""}}</td>
                <td>{{$exam->class?$exam->class->name:""}}</td>
                <!-- <td>{{$exam->created_at->format('d-M-Y')}}</td> -->
                <td>
                	@if($exam->is_passed == '0')
                		Failed
                	@elseif($exam->is_passed == '1')
                		Passed
                	
                	@endif
                </td>
                <x-admin.td-action>
                    <a class="dropdown-item" href="{{ route('exams.show', ['id' => $exam->id]) }}"><i
                            class="la la-eye"></i> View</a>
                    <button href="#" class="dropdown-item" wire:click="deleteAttempt({{ $exam->id }})"><i
                            class="fa fa-trash"></i> Delete</button>
                </x-admin.td-action>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="align-center">No records available</td>
            </tr>
        @endforelse
    </x-slot>
    <x-slot name="pagination">
    	{{ $exams->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $exams->firstitem() }} to {{ $exams->lastitem() }} of {{ $exams->total() }} entries
    </x-slot>
</x-admin.table>
