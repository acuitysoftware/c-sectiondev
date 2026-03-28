<?php

namespace App\Http\Livewire\Admin\Banner;

use Str;
use Image;
use Livewire\Component;
use App\Models\Banner;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class BannerEdit extends Component
{
	use AlertMessage,WithFileUploads;
    public $name,$active=1,$image,$banner, $page_name;
    public $isEdit=false;
    public $statusList=[];

    public function mount($banner = null)
    {
        $this->banner = $banner;
        $this->isEdit=true;
        $this->image=$this->banner->banner;
        $this->page_name=$this->banner->page_name;
        $this->active=$this->banner->active;
        
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
                'image'=>['required'],
                'active'=>['required'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return[
                'active'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->banner->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        if(isset($this->image) && gettype($this->image) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image->getClientOriginalExtension(); 
                 
            $this->image->storeAs('public/banner_images',$image);
            $fileName = 'banner_images/'.$image;
            if(isset($this->banner->banner))
        	{
        		@unlink(storage_path('app/public/' .$this->banner->banner));
        	}
        }
        else{

            $fileName = $this->banner->banner;
        } 
        $this->banner->update(['banner' => $fileName]);
        
        $msgAction = 'Banner was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('banners.index');
    }
    public function render()
    {
        return view('livewire.admin.banner.banner-edit');
    }
}
