<?php

namespace App\Http\Livewire\Frontend\Chat;

use Auth;
use DB;
use App\Models\Banner;
use App\Models\Payment;
use App\Models\User;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\Question;
use App\Models\SuperChat;
use App\Models\Board;
use App\Models\BoardClass;
use Livewire\Component;
use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Chat;
use Livewire\WithPagination;
class ChatLeaderboard extends Component
{
    use AlertMessage,WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $user, $subjects = [], $current_tab = 1, $searchSubject, $last_chat, $last_chat_id, $question, $sortDirection = "desc", $activeTab = 1 ,$perPage = 10,$searchName;
    public function changeExamType($value)
    {
        $this->activeTab = $value;
    }
    public function updatingPerPage()
    {
        $this->resetPage();
    }
    public function mount()
    {

        $this->user = Auth::user();
        $this->subjects = Subject::where('board_class_id', $this->user->board_class_id)->get();

        $this->last_chat = Chat::with('subject', 'user')->whereNotNull('question')->where('user_id', $this->user->id)->orderBy('id', 'desc')->first();

        if ($this->last_chat) {
            $this->last_chat_id = $this->last_chat->id;
        }
    }

    public function render()
    {
        $week_range = [today()->startOfWeek(7), today()->endOfWeek()];
        $month_range = [today()->startOfMonth(), today()->endOfMonth()];

        $query = Chat::with('subject')->whereNotNull('question')->whereRelation('user',  'board_class_id', $this->user->board_class_id);
        if ($this->activeTab == "2") {
            $query->whereBetween(DB::raw("DATE(date)"), $month_range);
        } else {
            $query->whereBetween(DB::raw("DATE(date)"), $week_range);
        }
        if ($this->searchName) {
            $query->where('question', 'like', "%{$this->searchName}%");
        }
        if ($this->searchSubject) {
            $query->where('subject_id', $this->searchSubject);
        }
        $chats = $query->orderBy('id', $this->sortDirection)->paginate($this->perPage);

        $firstPart = $chats->getCollection()->slice(0, 5);
        $secondPart = $chats->getCollection()->slice(5);
        return view('livewire.frontend.chat.chat-leaderboard', ['chats' => $chats, 'firstPart' => $firstPart, 'secondPart' => $secondPart, 'last_chat' => $this->last_chat]);
    }
}
