<?php
namespace App\Http\Livewire\Frontend\User;

use Auth;
use Hash;
use App\Models\Banner;
use App\Models\Payment;
use App\Models\QuestionSet;
use App\Models\User;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\Board;
use App\Models\Exam;
use App\Models\RewardPoint;
use App\Models\BoardClass;
use App\Models\Withdraw as WithdrawModel;
use App\Http\Livewire\Traits\AlertMessage;
use Illuminate\Http\Request;

use Livewire\Component;

class Profile extends Component
{
	use AlertMessage;
	public $name, $email, $password, $user, $subjects=[], $chapter, $active_menu, $questionSet , $completed_chapter_ids=[], $completed_question_set_ids=[], $total_points=0, $withdraw_points;
    public function mount()
    {
        $this->user = Auth::user();

        $this->withdraw_points = WithdrawModel::where('user_id', $this->user->id)->where('status', '!=', '2')->sum('reward_points');
        $this->subjects = Subject::where('board_class_id', $this->user->board_class_id)->get();
        if(request()->subject_name)
        {
            $subject = Subject::where('board_class_id', $this->user->board_class_id)->where('slug', request()->subject_name)->first();
        }
        else{

            $subject = Subject::where('board_class_id', $this->user->board_class_id)->first();
        }
        //dd($subject);
        $this->total_points = RewardPoint::where([
                    'user_id'=>$this->user->id,
                ])->sum('reward_points');

        $this->total_points= ($this->total_points-$this->withdraw_points);
        $this->active_menu = @$subject->id;
        
        
        if($subject)
        {
            $exams = Exam::where('subject_id', $subject->id)->where('user_id', $this->user->id)->where('is_passed', 1)->get();
            if(count($exams))
            {
                foreach ($exams as $key => $exam) {
                    $this->completed_chapter_ids[$key] = $exam->chapter_id;
                    $this->completed_question_set_ids[$key] = $exam->question_set_id;
                }
            }
            $this->chapter = Chapter::with('chapterFiles','questionSet')->whereNotIn('id', $this->completed_chapter_ids)->where('subject_id', $subject->id)->first();
        if($this->chapter)
        {
            $this->questionSet = QuestionSet::where('active', 1)->whereNotIn('id', $this->completed_question_set_ids)->where('chapter_id', $this->chapter->id)->first();
        }
        }

        
    }

    public function changeSubject($subject_id)
    {
        
        $exams = Exam::where('subject_id', $subject_id)->where('user_id', $this->user->id)->where('is_passed', 1)->get();
        if(count($exams))
        {
            foreach ($exams as $key => $exam) {
                $this->completed_chapter_ids[$key] = $exam->chapter_id;
                $this->completed_question_set_ids[$key] = $exam->question_set_id;
            }
        }
    	$this->active_menu = $subject_id;
    	$this->chapter = Chapter::with('chapterFiles','questionSet')->whereNotIn('id', $this->completed_chapter_ids)->where('subject_id', $subject_id)->first();
        if($this->chapter)
        {
            $this->questionSet = QuestionSet::where('active', 1)->whereNotIn('id', $this->completed_question_set_ids)->where('chapter_id', $this->chapter->id)->first();
        }

    }

    public function render()
    {
        return view('livewire.frontend.user.profile', ['subjects' =>$this->subjects, 'chapter' =>$this->chapter]);
    }
}
