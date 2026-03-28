<?php

namespace App\Http\Livewire\Admin\Board;

use Livewire\Component;
use App\Models\Board;
use App\Models\BoardClass;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class BoardList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];


    protected $paginationTheme = 'bootstrap';

    public $searchName, $searchRating, $searchStatus = -1, $perPage = 10;
    protected $listeners = ['deleteConfirm', 'changeStatus'];

    public function mount()
    {
        $this->perPageList = [
            ['value' => 10, 'text' => "10"],
            ['value' => 20, 'text' => "20"],
            ['value' => 50, 'text' => "50"],
            ['value' => 100, 'text' => "100"]
        ];
    }
    
    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function search()
    {
        $this->resetPage();
    }
    public function resetSearch()
    {
        $this->searchName = "";
        $this->searchRating = "";
        $this->searchStatus = -1;
    }

    public function render()
    {
        $boardQuery = Board::query();
        if ($this->searchName)
            $boardQuery->where('name', 'like', '%' . $this->searchName . '%');
        
        if ($this->searchStatus >= 0)
            $boardQuery->where('active', $this->searchStatus);
        return view('livewire.admin.board.board-list', [
            'boards' => $boardQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {

        $deleteBoard = Board::find($id['id']);

       if(count($deleteBoard->boardClases))
        {
            $msgAction = 'Please delete related Board Class first';
            $this->showToastr("error",$msgAction, false);  
        }
        else{

            $deleteBoard->delete();
            $msgAction = 'board has been deleted successfully';
            $this->showToastr("success",$msgAction, false);
        }
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this board!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(Board $board)
    {
        $board->fill(['active' => ($board->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Board status has been changed successfully');
    }
}
