<?php

namespace App\Http\Livewire\Frontend\User;

use Auth;
use Hash;
use App\Models\Banner;
use App\Models\Payment;
use App\Models\User;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\Question;
use App\Models\QuestionSet;
use App\Models\Board;
use App\Models\BoardClass;
use Livewire\Component;
use App\Http\Livewire\Traits\AlertMessage;

class Exam extends Component
{

	use AlertMessage;
	public $name, $email, $password, $user, $subjects=[],$subject, $chapter, $active_menu, $questionSet, $question=[];
    public function mount($subject, $chapter)
    {
    	$this->subject = $subject;
    	$this->chapter = $chapter;
        
        $this->user = Auth::user();
        $this->subjects = Subject::where('board_class_id', $this->user->board_class_id)->get();
        $this->questionSet = QuestionSet::where('chapter_id', $this->chapter->id)->first();
        
        $this->question = Question::where('question_set_id', $this->questionSet->id)->first();
    }
    public function postQuiz()
    {
        
    }
    public function render()
    {
        return view('livewire.frontend.user.exam');
    }
}
