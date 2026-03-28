<?php

namespace App\Http\Livewire\Admin\Subject;

use Livewire\Component;
use App\Models\Subject;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class SubjectList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


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
        $subjectQuery = Subject::with('board','boardClass');
       
        if ($this->searchName)
            $subjectQuery->where('name', 'like', '%' . $this->searchName . '%');
        
        if ($this->searchStatus >= 0)
            $subjectQuery->where('active', $this->searchStatus);
        return view('livewire.admin.subject.subject-list', [
            'subjects' => $subjectQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        $deleteSubject = Subject::find($id['id']);
        if(count($deleteSubject->chapter))
        {
            $msgAction = 'Please delete related chapter first';
            $this->showToastr("error",$msgAction, false);  
        }
        else{

            $deleteSubject->delete();
            $msgAction = 'Subject has been deleted successfully';
            $this->showToastr("success",$msgAction, false);
        }
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this subject!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(Subject $subject)
    {
        $subject->fill(['active' => ($subject->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Subject status has been changed successfully');
    }
}
