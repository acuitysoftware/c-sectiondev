<?php

namespace App\Http\Livewire\Admin\OpeningHour;

use Livewire\Component;
use App\Models\OpeningHour;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class OpeningList extends Component
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
        $opening_hourQuery = OpeningHour::query();
        if ($this->searchName)
            $opening_hourQuery->where('day', 'like', '%' . $this->searchName . '%');
        
        if ($this->searchStatus >= 0)
            $opening_hourQuery->where('active', $this->searchStatus);
        return view('livewire.admin.opening-hour.opening-list', [
            'opening_hours' => $opening_hourQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        OpeningHour::destroy($id);
        $this->showModal('success', 'Success', 'opening hour has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this opening_hour!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    /*public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(OpeningHour $opening_hour)
    {
        $opening_hour->fill(['active' => ($opening_hour->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'OpeningHour status has been changed successfully');
    }*/
    
}
