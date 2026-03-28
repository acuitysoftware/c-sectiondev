<?php

namespace App\Http\Livewire\Admin\Subscriber;

use Livewire\Component;
use App\Models\Subscriber;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class SubscriberList extends Component
{
	use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $searchName, $searchStatus = -1, $searchPhone, $searchEmail, $perPage = 10;
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
        $this->searchPhone = "";
        $this->searchEmail = "";
        $this->searchStatus = -1;
    }

    public function render()
    {
        $subscriberQuery = Subscriber::query();
        if ($this->searchName)
            $subscriberQuery->where('name', 'like', '%' . $this->searchName . '%');
        if ($this->searchEmail)
            $subscriberQuery->where('email', 'like', '%' . $this->searchEmail . '%');
        if ($this->searchPhone)
            $subscriberQuery->where('phone', 'like', '%' . $this->searchPhone . '%');
        if ($this->searchStatus >= 0)
            $subscriberQuery->where('active', $this->searchStatus);
        return view('livewire.admin.subscriber.subscriber-list', [
            'subscribers' => $subscriberQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        Subscriber::destroy($id);
        $msgAction = 'Subscriber has been deleted successfully';
        $this->showToastr("success",$msgAction, false);
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this subscriber!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(Subscriber $subscriber)
    {
        $subscriber->fill(['active' => ($subscriber->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Subscriber status has been changed successfully');
    }
    
}
