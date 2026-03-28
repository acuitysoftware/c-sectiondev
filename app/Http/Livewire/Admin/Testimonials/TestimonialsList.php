<?php

namespace App\Http\Livewire\Admin\Testimonials;

use Livewire\Component;
use App\Models\Testimonial;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class TestimonialsList extends Component
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
        $testimonialQuery = Testimonial::query();
        if ($this->searchName)
            $testimonialQuery->where('client_name', 'like', '%' . $this->searchName . '%');
        if ($this->searchRating)
            $testimonialQuery->where('rating', 'like', '%' . $this->searchRating . '%');
        if ($this->searchStatus >= 0)
            $testimonialQuery->where('active', $this->searchStatus);
        return view('livewire.admin.testimonials.testimonials-list', [
            'testimonials' => $testimonialQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        Testimonial::destroy($id);
        $this->showModal('success', 'Success', 'Testimonial has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this testimonial!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(Testimonial $testimonial)
    {
        $testimonial->fill(['active' => ($testimonial->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Testimonial status has been changed successfully');
    }
}
