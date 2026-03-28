<?php

namespace App\Http\Livewire\Admin\Cms;

use Str;
use Livewire\Component;
use App\Models\Cms;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class ContactUsCms extends Component
{
	use AlertMessage,WithFileUploads;
    public $title,$active,$image,$cms, $sub_title,$content_1,$content_2, $content_3, $description;
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
                
                'description'=>['nullable'],
                'content_1'=>['nullable']
            ];
    }

    public function saveOrUpdate()
    {
        $this->cms->fill($this->validate($this->validationRuleForUpdate()))->save();
        
        $msgAction = 'Cms was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('cms.index');
    }
    public function render()
    {
        return view('livewire.admin.cms.contact-us-cms');
    }
}
