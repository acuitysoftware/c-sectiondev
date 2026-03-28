<?php

namespace App\Http\Livewire\Admin\Subject;

use Livewire\Component;
use App\Models\BoardClass;
use App\Models\Board;
use App\Models\Subject;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class SubjectCreateEdit extends Component
{

    use AlertMessage;
    public $name, $board_id, $board_class_id, $subject, $active=1;
    public $isEdit=false;
    public $statusList=[];
    public $board_list = [];
    public $board_class_list = [];

    public function mount($subject = null)
    {
        if ($subject) {
            $this->subject = $subject;
            $this->fill($this->subject);
            $this->isEdit=true;

            $this->board_class_list = BoardClass::where('board_id',$subject->board_id)->where('active',1)->orderBy('name')->get();
        }
        else
            $this->subject=new Subject;
        
        $this->statusList=[
            ['value'=>"", 'text'=> "Select Status"],
            ['value'=>1, 'text'=> "Active"],
            ['value'=>0, 'text'=> "Inactive"]
        ];

        $this->board_list = Board::where('active',1)->orderBy('name')->get();
        
    }

    public function validationRuleForSave(): array
    {
        return
            [
                'name' => ['required',Rule::unique('subjects')->where(function($query) {
                  $query->where('board_id', '=', $this->board_id)->where('board_class_id', '=', $this->board_class_id);
              })],
                'board_id' => ['required'],
                'board_class_id' => ['required'],
                'active'=>['required'],
            ];
    }

    public function validationRuleForUpdate(): array
    {
        return
            [
                'name' => ['required',Rule::unique('subjects')->where(function($query) {
                  $query->where('board_id', '=', $this->board_id)->where('board_class_id', '=', $this->board_class_id);
              })->ignore($this->subject->id)],
                'board_id' => ['required'],
                'board_class_id' => ['required'],
                'active'=>['required'],
            ];
    }

    public static function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public function saveOrUpdate()
    {
        $this->subject->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        $slug = $this->slugify($this->name);

        $this->subject->update(['slug' => $slug]);
        
        $msgAction = 'Subject was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('subject.index');
    }

    public function updatedBoardId($id)
    {
        $this->board_class_list = BoardClass::where('board_id',$id)->where('active',1)->orderBy('name')->get();
    }


    public function render()
    {
        return view('livewire.admin.subject.subject-create-edit');
    }
}
