<?php

namespace App\Http\Livewire\Admin\Testimonials;

use Str;
use Livewire\Component;
use App\Models\Testimonial;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class TestimonialsCreateEdit extends Component
{
	use AlertMessage,WithFileUploads;
    public $client_name,$active=1,$image,$testimonial, $designation, $description, $rating;
    public $isEdit=false;
    public $statusList=[], $ratingList=[];

    public function mount($testimonial = null)
    {
        if ($testimonial) {
            $this->testimonial = $testimonial;
            $this->fill($this->testimonial);
            $this->isEdit=true;
        }
        else
            $this->testimonial=new Testimonial;

        $this->ratingList=[
            ['value'=>"", 'text'=> "Select Rating"],
            ['value'=>1, 'text'=> "1"],
            ['value'=>2, 'text'=> "2"],
            ['value'=>3, 'text'=> "3"],
            ['value'=>4, 'text'=> "4"],
            ['value'=>5, 'text'=> "5"],
        ];
        
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
                'client_name' => ['required'],
                'image'=>['required'],
                'description'=>['required'],
                'rating'=>['nullable'],
                'active'=>['required'],
                'designation'=>['nullable'],
            ];
    }
    
    public function saveOrUpdate()
    {
        $this->testimonial->fill($this->validate($this->validationRuleForSave()))->save();

        if(gettype($this->image) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image->getClientOriginalExtension();       
            $this->image->storeAs('public/testimonial_images',$image);
            $fileName = 'testimonial_images/'.$image;
            if(isset($this->testimonial->image))
        	{
        		@unlink(storage_path('app/public/' .$this->testimonial->image));
        	}
        }
        else{

            $fileName = $this->testimonial->image;
        } 
        $this->testimonial->update(['image' => $fileName]);
        
        $msgAction = 'Testimonial was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('testimonials.index');
    }
    public function render()
    {
        return view('livewire.admin.testimonials.testimonials-create-edit');
    }
}
