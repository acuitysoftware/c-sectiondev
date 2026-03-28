<?php

namespace App\Http\Livewire\Admin\Slider;

use Str;
use Image;
use Livewire\Component;
use App\Models\Slider;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class SliderCreateEdit extends Component
{
	use AlertMessage,WithFileUploads;
    public $title,$active=1,$image, $image_2,$slider, $sub_title, $description;
    public $isEdit=false;
    public $statusList=[];

    public function mount($slider = null)
    {
        if ($slider) {
            $this->slider = $slider;
            $this->fill($this->slider);
            $this->isEdit=true;
        }
        else
            $this->slider=new Slider;
        
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
                'title'=>['nullable'],
                'sub_title'=>['nullable'],
                'image'=>['required'],
                'description'=>['nullable'],
                'active'=>['required'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return[
                
                'title'=>['nullable'],
                'sub_title'=>['nullable'],
                'image'=>['required'],
                'description'=>['nullable'],
                'active'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->slider->fill($this->validate($this->validationRuleForUpdate()))->save();

        
        if(isset($this->image) && gettype($this->image) != 'string')
        {
        	$mime_type = $this->image->getClientOriginalExtension();
            if($mime_type == 'jpg' || $mime_type == 'jpeg' || $mime_type == 'png'){
                $file_type = 1;
            }else{
                $file_type = 0;
            }
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image->getClientOriginalExtension(); 
               
            $this->image->storeAs('public/slider_images',$image);
            $videoFileName = 'slider_images/'.$image;
            if(isset($this->slider->image))
        	{
        		@unlink(storage_path('app/public/' .$this->slider->image));
        	}
        }
        else{

            $videoFileName = $this->slider->image;
            $file_type = $this->slider->file_type;
        } 
        $this->slider->update([
            'image' => $videoFileName,
        	'file_type' => $file_type,
        ]);
        
        $msgAction = 'Slider was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('sliders.index');
    }
    public function render()
    {
        return view('livewire.admin.slider.slider-create-edit');
    }
}
