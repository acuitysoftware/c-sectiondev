<?php

namespace App\Http\Livewire\Admin\QuestionSet;

use Str;
use Livewire\Component;
use App\Models\BoardClass;
use App\Models\Board;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\QuestionSet;
use App\Models\Question;
use App\Rules\AnswerCheck;
use App\Rules\RequiredCheck;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class QuestionSetCreateEdit extends Component
{
	use AlertMessage, WithFileUploads;
    
    public $name, $chapter_id, $pass_marks_percentage, $time_per_question, $question_set, $active=0, $chapter, $total_time;
    public $isEdit=false, $subject_id, $board_class_id,$reward_point;
    public $statusList=[];
    public $questions = [];
    protected $listeners = ['deleteConfirm', 'changeStatus'];

    public function addItem($data = null)
    {
        if ($data == null) {
            $data = [
                'id' => null,
                'question_set_id' => null,
                'question' => null,
                'option_a' => null,
                'option_b' => null,
                'option_c' => null,
                'option_d' => null,
                'correct_answer' => null,
                'deleted' => false,
            ];
        }
        $this->questions->add($data);
    }

    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this question!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function deleteConfirm($key)
    {
            $item = $this->questions[$key['id']];
            if($this->questions->where('deleted', false)->count() == 1){
            	$this->showToastr("error",'Atleast one question date required', false);
        	}
            else
            {
                    //$this->questions->forget($this->questions[$key['id']]);
                //dd($key);
                    //unset($this->questions[$key['id']]['id']);
                /*if(is_null($this->questions[$key['id']]['id']))
                {
                    $this->questions->forget($key);
                }*/
                //dd($this->questions);
                $item['deleted'] = true;
	            $this->questions[$key['id']] = $item;
	            $this->showToastr("success",'Question has been deleted successfully', false);
            }
        
    }

    public function mount($chapter ,$question_set = null)
    {
    	$this->chapter = $chapter;
    	$this->chapter_id = $this->chapter->id;
        $this->subject_id = $this->chapter->subject_id;
        $this->board_class_id = $this->chapter->board_class_id;
        if ($question_set) {
            $this->question_set = $question_set;
            $this->fill($this->question_set);
            $this->isEdit=true;

            
        }
        else
            $this->question_set=new QuestionSet;



        $this->questions = new Collection();
        $questions_data = $this->question_set->questions;
        if (count($questions_data)) {
            $this->fill($this->questions);
            foreach ($questions_data as $item) {
            $this->addItem([
                'id' => $item->id,
                'question_set_id' => $item->question_set_id,
                'question' => $item->question,
                'option_a' => $item->option_a,
                'option_b' => $item->option_b,
                'option_c' => $item->option_c,
                'option_d' => $item->option_d,
                'correct_answer' => $item->correct_answer,
                'deleted' => false,
            ]);
            }
        } else {
            $this->addItem();
        }
        
        $this->statusList=[
            ['value'=>"", 'text'=> "Select Status"],
            ['value'=>1, 'text'=> "Published"],
            ['value'=>0, 'text'=> "Unpublished"]
        ];

        
    }

    public function validationRuleForSave(): array
    {
        return
            [
                'questions.*.question' => [new RequiredCheck($this->questions)],
                'questions.*.option_a' => [new RequiredCheck($this->questions)],
                'questions.*.option_b' => [new RequiredCheck($this->questions)],
                'questions.*.option_c' => [new RequiredCheck($this->questions)],
                'questions.*.option_d' => [new RequiredCheck($this->questions)],
                'questions.*.correct_answer' => [new RequiredCheck($this->questions),new AnswerCheck($this->questions)],
                'total_time' => ['required', 'integer', 'min:1'],
                'pass_marks_percentage' => ['required', 'numeric', 'min:1', 'max:100'],
                'active'=>['required'],
                'chapter_id'=>['required'],
                'subject_id'=>['required'],
                'board_class_id'=>['required'],
            ];
    }

    protected $messages = [
        'questions.*.question.required' => 'This field in required',
        'questions.*.question.distinct' => 'Question already insert',
        'questions.*.option_a.required' => 'This field in required',
        'questions.*.option_b.required' => 'This field in required',
        'questions.*.option_c.required' => 'This field in required',
        'questions.*.option_d.required' => 'This field in required',
        'questions.*.correct_answer.required' => 'This field in required',

    ];

    

    public function saveOrUpdate()
    {

        $this->question_set->fill($this->validate($this->validationRuleForSave()))->save();

        $count = QuestionSet::where('chapter_id', $this->chapter->id)->count();

        if(!$this->isEdit)
        {
        	$setNo = $count;
        	$this->question_set->update([
        	'name' => 'Set '.$setNo,
        ]);
        }
        /*$this->question_set->update([
        	'total_time' => $this->time_per_question*count($this->questions),
        ]);*/


        if (count($this->questions) > 0) {
            foreach ($this->questions as $key => $item) {
                if(empty($item['id']) &&  $item['deleted'] == false) {
                	Question::create([
	                    'question_set_id' => $this->question_set->id,
	                    'chapter_id' => $this->chapter->id,
	                    'board_class_id' => $this->chapter->board_class_id,
	                    'subject_id' => $this->chapter->subject_id,
	                    'question' => $item['question'],
	                    'option_a' => $item['option_a'],
	                    'option_b' => $item['option_b'],
	                    'option_c' => $item['option_c'],
	                    'option_d' => $item['option_d'],
	                    'correct_answer' => $item['correct_answer'],
	                    'time' => $this->time_per_question,
	                ]);
                } else {
                    if (!empty($item['deleted']) && $item['deleted'] == true) {
                        if($item['id'])
                        {
                            $oldData = Question::find($item['id']);
                            if($oldData)
                            {
                                $oldData->delete();
                            }
                        }
                    } else {
                    Question::where('id', $item['id'])->update([
                        'question' => $item['question'],
                        'option_a' => $item['option_a'],
                        'option_b' => $item['option_b'],
                        'option_c' => $item['option_c'],
                        'option_d' => $item['option_d'],
                        'correct_answer' => $item['correct_answer'],
                        'time' => $this->time_per_question,
                    ]);
                    }
                }
            }
        }
        
        
        $msgAction = 'Question set was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('question-sets.index', ['chapter_id' => $this->chapter_id]);
    }

    public function render()
    {
        return view('livewire.admin.question-set.question-set-create-edit');
    }
}
