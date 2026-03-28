<?php

namespace App\Http\Livewire\Admin\Cms;

use Str;
use Livewire\Component;
use App\Models\Cms;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class FaqCms extends Component
{
	use AlertMessage,WithFileUploads;
    public $title,$active,$sub_title,$cms, $content_1, $image_file_1;
    public $isEdit=false;
    public $statusList=[];
    public function mount($cms = null)
    {
        if ($cms) {
            $this->cms = $cms;
            $this->fill($this->cms);
            $this->image_file_1 = $this->cms->image_1;
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
                'image_file_1'=>['required'],
                'content_1'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->validate($this->validationRuleForUpdate());

        if(gettype($this->image_file_1) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image_file_1->getClientOriginalExtension();       
            $this->image_file_1->storeAs('public/cms_images',$image);
            $fileName = 'cms_images/'.$image;
            if(isset($this->cms->image_1))
        	{
        		@unlink(storage_path('app/public/' .$this->cms->image_1));
        	}
        }
        else{

            $fileName = $this->cms->image_1;
        }

        $this->cms->update([
        		'sub_title' => $this->sub_title,
        		'content_1' => $this->content_1,
        		'image_1' => $fileName,
        	]);
        
        $msgAction = 'Cms was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('cms.index');
    }
    public function render()
    {
        return view('livewire.admin.cms.faq-cms');
    }
}
