<?php

namespace App\Http\Livewire\Admin\Exam;
use App\Models\Exam;
use App\Models\Board;
use App\Models\BoardClass;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\AlertMessage;
use App\Http\Livewire\Traits\WithSorting;
class ExamList extends Component
{
	use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [], $boardList=[], $classList=[];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];



    public  $searchName, $searchAmount, $searchStatus = -1, $searchDate, $perPage = 5, $status, $searchBoardId, $searchClassId;

    protected $listeners = ['deleteConfirm', 'changeStatus'];

    public function mount()
    {
        $this->boardList = Board::get();
        $this->perPageList = [
            ['value' => 50, 'text' => "50"],
            ['value' => 100, 'text' => "100"],
            ['value' => 200, 'text' => "200"],
            ['value' => 500, 'text' => "500"],
            ['value' => 1000, 'text' => "1000"]
        ];
    }
    public function updatedSearchBoardId($value)
    {
        if($value)
        {
        	$this->classList = BoardClass::where('board_id', $value)->get();
        }
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
        $this->searchBoardId = "";
        $this->searchClassId = "";
        $this->searchStatus = -1;
    }
    public function render()
    {
    	$examQuery = Exam::with('user','board','class');
        if ($this->searchName)
        {
            $examQuery->whereRelation('user','name' ,"'like '%" . $this->searchName . "%' "
            );
        }
        if ($this->searchBoardId)
        {
            $examQuery->where('board_id', $this->searchBoardId);
        }
        if ($this->searchClassId)
        {
            $examQuery->where('board_class_id', $this->searchClassId);
        }
        
        if ($this->searchStatus >= 0)
            $examQuery->orWhere('is_passed', $this->searchStatus);

        return view('livewire.admin.exam.exam-list', ['exams' => $examQuery->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage)]);
        
    }

    public function deleteConfirm($id)
    {
        $data = Exam::find($id['id']);
        
        $data->delete();
        $msgAction = 'Exam result has been deleted successfully';
        $this->showToastr("success",$msgAction, false);
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this image!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }
}
