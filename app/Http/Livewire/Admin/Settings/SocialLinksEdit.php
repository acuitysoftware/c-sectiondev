<?php

namespace App\Http\Livewire\Admin\Settings;

use Str;
use Livewire\Component;
use App\Models\SocialLink;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class SocialLinksEdit extends Component
{

	use AlertMessage,WithFileUploads;
	public $name, $link, $active=1, $instagram_link, $social_link, $statusList=[], $isEdit=false, $icon, $image;

	public function mount($social_link = null)
    {
        if ($social_link) {
            $this->social_link = $social_link;
            $this->fill($this->social_link);
            $this->isEdit=true;
        }
        else
            $this->social_link=new SocialLink;

        $this->statusList=[
            ['value'=>"", 'text'=> "Select Status"],
            ['value'=>1, 'text'=> "Active"],
            ['value'=>0, 'text'=> "Inactive"]
        ];
        
    }

    public function validationRuleForSave(): array
    {
        return[
                'name'=>['required',Rule::unique('social_links')],
                'link'=>['required'],
                'icon'=>['required'],
                'active'=>['required'],
            ];
    }

    public function validationRuleForUpdate(): array
    {
        return[
                'name'=>['required', Rule::unique('social_links')->ignore($this->social_link->id)],
                'link'=>['required'],
                'icon'=>['required'],
                'active'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->social_link->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        if(gettype($this->image) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image->getClientOriginalExtension(); 
               
            $this->image->storeAs('public/images',$image);
            $fileName = 'images/'.$image;
            if(isset($this->social_link->image))
            {
                @unlink(storage_path('app/public/' .$this->social_link->image));
            }
        }
        else{

            $fileName = $this->social_link->image;
        } 
        $this->social_link->update(['image' => $fileName]);
        
        $msgAction = 'Social Links was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('social-links.index');
    }

    public function render()
    {
        return view('livewire.admin.settings.social-links-edit');
    }
}
