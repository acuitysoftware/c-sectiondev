<?php

namespace App\Http\Livewire\Admin\Cms;

use Str;
use Livewire\Component;
use App\Models\Cms;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class ServicesCms extends Component
{
	use AlertMessage,WithFileUploads;
    public $title,$active,$sub_title,$cms, $description;
    public $isEdit=false;
    public $statusList=[];
    public function mount($cms = null)
    {
        if ($cms) {
            $this->cms = $cms;
            $this->fill($this->cms);
            $this->isEdit=true;
        }
        else
            $this->cms=new Cms;
        
        
    }
    
    public function validationRuleForUpdate(): array
    {
        return[
                'title' => ['required', Rule::unique('cms')->ignore($this->cms->id)],
                'sub_title'=>['required'],
                'description'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->validate($this->validationRuleForUpdate());
       
        $this->cms->update([
                'sub_title' => $this->sub_title,
                'description' => $this->description,
            ]);
        
        $msgAction = 'Cms was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('cms.index');
    }
    public function render()
    {
        return view('livewire.admin.cms.services-cms');
    }
}
