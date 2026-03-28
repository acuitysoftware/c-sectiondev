<?php

namespace App\Http\Livewire\Admin\Cms;

use Str;
use Livewire\Component;
use App\Models\Cms;
use App\Models\CmsDetails;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use App\Http\Livewire\Traits\AlertMessage;

class AboutUsCms extends Component
{
	use AlertMessage,WithFileUploads;
    public $title,$active,$cms, $description, $sub_title, $content_1, $content_2, $image_1, $content_5, $content_6, $content_7, $content_8, $cms_data, $content_9,$image_2, $image_3, $image_4, $youtube_link;
    public $isEdit=false;
    public $statusList=[], $cmsDetails =[];

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
                'description'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->validate($this->validationRuleForUpdate());

        
        
        
        $this->cms->update([
        	'description' => $this->description,
            
        ]);

        
        
        $msgAction = 'Cms was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('cms.index');
    }
    public function render()
    {
        return view('livewire.admin.cms.about-us-cms');
    }
}
