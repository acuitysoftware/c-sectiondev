<?php

namespace App\Http\Livewire\Admin\WeeklyQuestionSet;

use Livewire\Component;
use App\Models\Subject;
use App\Models\QuestionSet;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class WeeklyQuestionSetList extends Component
{
	use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $searchName, $searchRating, $searchStatus = -1, $perPage = 10, $board_class;
    protected $listeners = ['deleteConfirm', 'changeStatus'];

    public function mount($board_class)
    {
        $this->perPageList = [
            ['value' => 10, 'text' => "10"],
            ['value' => 20, 'text' => "20"],
            ['value' => 50, 'text' => "50"],
            ['value' => 100, 'text' => "100"]
        ];
        $this->board_class = $board_class;
    }
    public function getRandomColor()
    {
        $arrIndex = array_rand($this->badgeColors);
        return $this->badgeColors[$arrIndex];
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
        $questionSetQuery = QuestionSet::where('board_class_id',$this->board_class->id)->whereNull('chapter_id');
        if ($this->searchName)
            $questionSetQuery->where('question', 'like', '%' . $this->searchName . '%');
        
        if ($this->searchStatus >= 0)
            $questionSetQuery->where('active', $this->searchStatus);
        return view('livewire.admin.weekly-question-set.weekly-question-set-list', [
            'sets' => $questionSetQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        $deleteChpater = QuestionSet::find($id['id']);
        if(count($deleteChpater->exams))
        {
            $msgAction = 'Delete not allowed';
            $this->showToastr("error",$msgAction, false);  
        }
        else{

            $deleteChpater->delete();
            $msgAction = 'Question set has been deleted successfully';
            $this->showToastr("success",$msgAction, false);
        }
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this question set!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(QuestionSet $question_set)
    {
        $question_set->fill(['active' => ($question_set->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Question set status has been changed successfully');
    }
}
