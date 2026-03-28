<?php

namespace App\Http\Livewire\Admin\Chapter;

use Livewire\Component;
use App\Models\Chapter;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class ChapterList extends Component
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
        $chapterQuery = Chapter::with('board','boardClass','subject');
        if ($this->searchName)
            $chapterQuery->where('name', 'like', '%' . $this->searchName . '%');
        
        if ($this->searchStatus >= 0)
            $chapterQuery->where('active', $this->searchStatus);
        return view('livewire.admin.chapter.chapter-list', [
            'chapters' => $chapterQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        $deleteChpater = Chapter::find($id['id']);
        if(count($deleteChpater->questionSets))
        {
            $msgAction = 'Please delete related question set';
            $this->showToastr("error",$msgAction, false);  
        }
        else{

            $deleteChpater->delete();
            $msgAction = 'Chapter has been deleted successfully';
            $this->showToastr("success",$msgAction, false);
        }
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this chapter!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(Chapter $chapter)
    {
        $chapter->fill(['active' => ($chapter->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Chapter status has been changed successfully');
    }
}
