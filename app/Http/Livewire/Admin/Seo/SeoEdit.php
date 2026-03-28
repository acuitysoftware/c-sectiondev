<?php

namespace App\Http\Livewire\Admin\Seo;

use Str;
use Image;
use Livewire\Component;
use App\Models\Seo;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class SeoEdit extends Component
{
	use AlertMessage,WithFileUploads;
    public $title,$active=1,$description, $keywords ,$seo;
    public $isEdit=false;
    public $statusList=[];

    public function mount($seo = null)
    {
        if ($seo) {
            $this->seo = $seo;
            $this->fill($this->seo);
            $this->isEdit=true;
        }
        else
            $this->seo=new Seo;
        
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
                'title'=>['required'],
                'description'=>['required'],
                'keywords'=>['required'],
                'active'=>['required'],
            ];
    }
    

    public function saveOrUpdate()
    {
        $this->seo->fill($this->validate($this->validationRuleForSave()))->save();
        
        $msgAction = 'Seo was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('seos.index');
    }
    public function render()
    {
        return view('livewire.admin.seo.seo-edit');
    }
}
