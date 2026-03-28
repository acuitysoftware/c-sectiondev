<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;

class UserList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $searchName, $searchEmail, $searchUserID, $searchStatus = -1, $perPage = 10;
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
        $this->searchEmail = "";
        $this->searchUserID = "";
        $this->searchStatus = -1;
    }

    public function render()
    {
        $userQuery = User::with('board', 'class');
        if ($this->searchName)
        {
            $name = $this->searchName;
            $userQuery->where(function($q) use($name){
                 $q->where('name', 'like', '%' . $name . '%')->orWhere('email', 'like', '%' . $name . '%')->orWhereRelation('board','name', 'like', '%' . $name . '%')->orWhere('class', 'name', 'like', '%' . $name . '%');
            });
        }
        
            
        if ($this->searchStatus >= 0)
            $userQuery->where('active', $this->searchStatus);
        return view('livewire.admin.user-list', [
            'users' => $userQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->role('STUDENT')
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        User::destroy($id);
        $msgAction = 'User has been deleted successfully';
        $this->showToastr("success",$msgAction, false);
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this user!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatus(User $user)
    {
        $user->fill(['active' => ($user->active == 1) ? 0 : 1])->save();
        if ($user->active != 1) {
            $user->tokens->each(function ($token, $key) {
                $token->delete();
            });
        }
        $this->showModal('success', 'Success', 'User status has been changed successfully');
    }
}
