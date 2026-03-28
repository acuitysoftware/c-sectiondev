<?php

namespace App\Http\Livewire\Admin\Chapter;

use Str;
use Livewire\Component;
use App\Models\BoardClass;
use App\Models\Board;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\ChapterFile;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class ChapterCreateEdit extends Component
{

    use AlertMessage, WithFileUploads;
    
    public $name, $board_id, $board_class_id, $subject_id, $description, $chapter, $active=1, $chapter_files = [];
    public $isEdit=false;
    public $statusList=[];
    public $board_list = [];
    public $board_class_list = [];
    public $subject_list = [];
protected $listeners = ['deleteConfirm', 'changeStatus'];
    public function mount($chapter = null)
    {
        if ($chapter) {
            $this->chapter = $chapter;
            $this->fill($this->chapter);
            $this->isEdit=true;

            $this->subject_list = Subject::where('board_class_id',$chapter->board_class_id)->where('active',1)->orderBy('name')->get();
            $this->board_class_list = BoardClass::where('board_id',$chapter->board_id)->where('active',1)->orderBy('name')->get();
        }
        else
            $this->chapter=new Chapter;
        
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
                'name' => ['required',Rule::unique('chapters')->where(function($query) {
                  $query->where('board_id', '=', $this->board_id)->where('board_class_id', '=', $this->board_class_id)->where('subject_id', '=', $this->subject_id);
              })],
                'board_id' => ['required'],
                'board_class_id' => ['required'],
                'subject_id' => ['required'],
                'description' => ['required'],
                'chapter_files' => ['nullable'],
                'active'=>['required'],
            ];
    }

    public function validationRuleForUpdate(): array
    {
        return
            [
                'name' => ['required',Rule::unique('chapters')->where(function($query) {
                  $query->where('board_id', '=', $this->board_id)->where('board_class_id', '=', $this->board_class_id)->where('subject_id', '=', $this->subject_id);
              })->ignore($this->chapter->id)],
                'board_id' => ['required'],
                'board_class_id' => ['required'],
                'subject_id' => ['required'],
                'description' => ['required'],
                'chapter_files' => ['nullable'],
                'active'=>['required'],
            ];
    }


    

    public function saveOrUpdate()
    {
        $this->chapter->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();


        $this->chapter->update(['slug' => Str::slug($this->name)]);

        if(count($this->chapter_files))
        {
            foreach ($this->chapter_files as $key => $value) {
                $fileName = null;
                if(gettype($value) != 'string'){
                    $image = time() . '-' . rand(1000, 9999) . '.' . $value->getClientOriginalExtension();       
                    $value->storeAs('public/chapter_files',$image);
                    $fileName = 'chapter_files/'.$image;
                    
                    ChapterFile::create([
                        'chapter_id' => $this->chapter->id,
                        'file_type' => 'pdf',
                         'file_name' => $fileName,
                         'file_original_name' => $value->getClientOriginalName(),
                        ]);
                }
                
            }
        }
        
        $msgAction = 'Chapter was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('chapter.index');
    }
    public function deleteConfirm($id)
    {
        ChapterFile::destroy($id);
        
            $msgAction = "Data has been deleted successfully";
            $this->showToastr("success",$msgAction, false);
        
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this file!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }


    public function updatedBoardId($id)
    {
        $this->board_class_list = BoardClass::where('board_id',$id)->where('active',1)->orderBy('name')->get();
    }

    public function updatedBoardClassId($id)
    {
        $this->subject_list = Subject::where('board_class_id',$id)->where('active',1)->orderBy('name')->get();
    }


    public function render()
    {
        return view('livewire.admin.chapter.chapter-create-edit');
    }
}
