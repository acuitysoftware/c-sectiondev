<?php

namespace App\Http\Livewire\Admin\Gallery;

use Str;
use Image;
use Livewire\Component;
use App\Models\Gallery;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class GalleryCreateEdit extends Component
{
    use AlertMessage,WithFileUploads;
    public $name,$active=1,$image,$gallery;
    public $isEdit=false;
    public $statusList=[];

    public function mount($gallery = null)
    {
        if ($gallery) {
            $this->gallery = $gallery;
            $this->fill($this->gallery);
            $this->isEdit=true;
        }
        else
            $this->gallery=new Gallery;
        
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
        $this->gallery->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        if(gettype($this->image) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image->getClientOriginalExtension(); 
               
            $this->image->storeAs('public/gallery_images',$image);
            $fileName = 'gallery_images/'.$image;
            if(isset($this->gallery->image))
        	{
        		@unlink(storage_path('app/public/' .$this->gallery->image));
        	}
        }
        else{

            $fileName = $this->gallery->image;
        } 
        $this->gallery->update(['image' => $fileName]);
        
        $msgAction = 'Gallery was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('galleries.index');
    }
    public function render()
    {
        return view('livewire.admin.gallery.gallery-create-edit');
    }
}
