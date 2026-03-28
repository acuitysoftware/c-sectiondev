<?php

namespace App\Http\Livewire\Frontend\Chat;

use Auth;
use DB;
use App\Models\Subject;
use App\Models\Chat;
use App\Models\Exam;
use App\Models\SuperChat;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ChatGroupTest extends Component
{
    use WithPagination;
    public $question, $apiKey, $subjects = [], $user, $subject_id, $difficulty = 1, $chat, $recent_chats, $searchSubject, $chat_id, $activeTab = 1, $searchName, $sortDirection = 'desc', $test_title = "Weekly Group Test";
    public function changeExamType($value)
    {
        if ($value == "1") {
            $this->test_title = "Weekly Group Test";
        } else {
            $this->test_title = "Monthly Group Test";
        }
        $this->activeTab = $value;
    }
    protected $paginationTheme = 'bootstrap';
    public function updatingPerPage()
    {
        $this->resetPage();
    }
    public function mount()
    {


        $this->user = Auth::user();
        $this->subjects = Subject::where('board_class_id', $this->user->board_class_id)->get();

        $this->recent_chats = Chat::with('subject')->whereNotNull('question')->where('user_id', $this->user->id)->orderBy('id', 'desc')->get();
    }
    public function render()
    {
        $week_range = [today()->startOfWeek(7), today()->endOfWeek()];
        $month_range = [today()->startOfMonth(), today()->endOfMonth()];
        $query = Exam::select('exams.user_id',  DB::raw("sum(exams.reward_points) as 'total_point'"), 'users.name as student_name', 'users.profile_photo_path as profile_photo_path')->where(['exams.board_class_id' => $this->user->board_class_id, 'exams.exam_type' => "Group"])->join('users', 'exams.user_id', '=', 'users.id');
        if ($this->activeTab == "2") {
            $query->whereBetween(DB::raw("DATE(exams.start_date)"), $month_range)->where('exams.test_type', 'Monthly');
        } else {
            $query->whereBetween(DB::raw("DATE(exams.start_date)"), $week_range)->where('exams.test_type', 'Weekly');
        }

        $students = $query->groupBy('exams.user_id', 'users.name', 'profile_photo_path')->orderBy('total_point', $this->sortDirection)->get();
        return view('livewire.frontend.chat.chat-group-test', ['students' => $students]);
    }
}
