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
        <tr class="filter">
            <th colspan="2">
                <x-admin.input type="search" wire:model.defer="searchName" placeholder="Search..." autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>

            <th colspan="2">
                <select class="form-control form-control-sm form-filter kt-input" wire:model.defer="searchStatus"
                    title="Select" data-col-index="2">
                    <option value="-1">Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </th>
            
            <th colspan="2">
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
        <tr role="row">
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Chapter
            </th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Board Name
            </th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Class Name
            </th>

            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Subject Name
            </th>

            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Status
            </th>
           
            <th class="align-center" rowspan="1" colspan="1" style="width: 15%;" aria-label="Actions">Actions</th>
        </tr>

        
    </x-slot>

    <x-slot name="tbody">
       
        @forelse($chapters as $chap)
            <tr role="row" class="odd">
                <td>{{$chap->name}}</td>
                <td>{{$chap->board->name}}</td>
                <td>{{$chap->boardClass->name}}</td>
                <td>{{$chap->subject->name}}</td>
                <td class="align-center"><span
                        class="kt-badge  kt-badge--{{ $chap->active == 1 ? 'success' : 'warning' }} kt-badge--inline kt-badge--pill cursor-pointer"
                        wire:click="changeStatusConfirm({{ $chap->id }})">{{ $chap->active == 1 ? 'Active' : 'Inactive' }}</span>
                </td>
                
                <x-admin.td-action>
                    <a class="dropdown-item" href="{{ route('chapter.edit', ['chapter' => $chap->id]) }}"><i
                            class="la la-edit"></i> Edit</a>
                     <a class="dropdown-item" href="{{ route('question-sets.create', ['chapter_id' => $chap->id]) }}"><i
                            class="fas fa-plus"></i> Add Question Set</a>
                    <a class="dropdown-item" href="{{ route('question-sets.index', ['chapter_id' => $chap->id]) }}"><i
                            class="fas fa-eye"></i> View Question Sets</a>
                    <button href="#" class="dropdown-item" wire:click="deleteAttempt({{ $chap->id }})"><i
                            class="fa fa-trash"></i> Delete</button>
                </x-admin.td-action>


            </tr>
        @empty
            <tr>
                <td colspan="6" class="align-center">No records available</td>
            </tr>
        @endforelse

    </x-slot>
    <x-slot name="pagination">
        {{ $chapters->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $chapters->firstitem() }} to {{ $chapters->lastitem() }} of {{ $chapters->total() }} entries
    </x-slot>
</x-admin.table>
