<?php

namespace App\Http\Livewire\Admin\OpeningHour;

use Str;
use Livewire\Component;
use App\Models\OpeningHour;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class OpeningHourCreateEdit extends Component
{
	use AlertMessage,WithFileUploads;
    public $day,$active=1,$time,$opening_hour, $client_desc, $description, $rating;
    public $isEdit=false;
    public $statusList=[], $ratingList=[];

    public function mount($opening_hour = null)
    {
        if ($opening_hour) {
            $this->opening_hour = $opening_hour;
            $this->fill($this->opening_hour);
            $this->isEdit=true;
        }
        else
            $this->opening_hour=new OpeningHour;

        
        
        $this->statusList=[
            ['value'=>"", 'text'=> "Select Status"],
            ['value'=>1, 'text'=> "Active"],
            ['value'=>0, 'text'=> "Inactive"]
        ];
    }
    public function validationRuleForSave(): array
    {
        return
            [
                'day'=>['required'],
                'time'=>['required'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return[
                'day'=>['required'],
                'time'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->opening_hour->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        $msgAction = 'Opening Hour was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('opening-hours.index');
    }
    public function render()
    {
        return view('livewire.admin.opening-hour.opening-hour-create-edit');
    }
}
