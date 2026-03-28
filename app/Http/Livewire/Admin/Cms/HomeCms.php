<?php

namespace App\Http\Livewire\Admin\Cms;

use Str;
use App\Models\Cms;
use Livewire\Component;
use App\Models\CmsGallery;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use App\Http\Livewire\Traits\AlertMessage;

class HomeCms extends Component
{
	use AlertMessage,WithFileUploads;
    public $title,$active,$image,$cms, $image_1,$image_2, $image_3,$image_4, $video_link;
    public $isEdit=false;
    public $content_1, $content_2, $content_3, $content_4,$content_5, $content_6, $content_7, $content_8;
    protected $listeners = ['deleteConfirm', 'changeStatus'];

    public function mount($cms = null)
    {
        if ($cms) {
            $this->cms = $cms;
            $this->fill($this->cms);
            $this->isEdit=true;
        }
        else
            $this->cms=new Cms;

        $this->cmsGalleries = new Collection();
        
    }



    public function saveOrUpdate()
    {
        $this->validate([
            'content_1'=>['required'],
            'content_2'=>['required'],
            'image_1'=>['required'],
            'video_link'=>['required'],
           
            
        ]);

        if(gettype($this->image_1) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image_1->getClientOriginalExtension();       
            $this->image_1->storeAs('public/cms_images',$image);
            $fileName = 'cms_images/'.$image;
            if(isset($this->cms->image_1))
            {
                @unlink(storage_path('app/public/' .$this->cms->image_1));
            }
        }
        else{

            $fileName = $this->cms->image_1;
        }

        if(gettype($this->video_link) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->video_link->getClientOriginalExtension();       
            $this->video_link->storeAs('public/cms_images',$image);
            $videoName = 'cms_images/'.$image;
            if(isset($this->cms->video_link))
            {
                @unlink(storage_path('app/public/' .$this->cms->video_link));
            }
        }
        else{

            $videoName = $this->cms->video_link;
        }

       
        $this->cms->update([
            'content_1'=> $this->content_1,
            'content_2'=> $this->content_2,
            'image_1'=> $fileName,
            'video_link'=> $videoName,
        ]);

        
        $msgAction = 'Cms was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('cms.index');
    }
    public function render()
    {
        return view('livewire.admin.cms.home-cms');
    }
}
