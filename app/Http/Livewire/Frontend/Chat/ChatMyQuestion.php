<?php

namespace App\Http\Livewire\Frontend\Chat;


use Auth;
use DB;
use App\Models\Banner;
use App\Models\Payment;
use App\Models\User;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\SuperChat;
use App\Models\QuestionSet;
use App\Models\Board;
use App\Models\BoardClass;
use Livewire\Component;
use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Chat;
use Livewire\WithPagination;
class ChatMyQuestion extends Component
{
    use AlertMessage,WithPagination;
	public $user,$subjects=[], $last_chat,$searchSubject,$searchName, $fromDate, $toDate,$perPage=10;
    protected $listeners = [
        'changeTab',
        'resetChildPagination',
        "deleteConfirm"
    ];
     protected $paginationTheme = 'bootstrap';
    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetChildPagination()
    {
        $this->resetPage();
    }
    public function mount()
    {
    	
        $this->user = Auth::user();
        
        $this->subjects = Subject::where('board_class_id', $this->user->board_class_id)->get();
         $this->last_chat = Chat::with('subject','last_chat')->whereNotNull('question')->where('user_id', $this->user->id)->orderBy('id', 'desc')->first();
        
    }
    public function render()
    {
        $query = Chat::with('subject')->whereNotNull('question')->where('user_id', $this->user->id)->orderBy('id', 'desc');
        if($this->searchSubject){
            $query->where('subject_id', $this->searchSubject);
        }

        if ($this->fromDate) {
                $date['form_date'] = $this->fromDate;
                $query->where(DB::raw("DATE(date)"), '>=', date('Y-m-d', strtotime($date['form_date'])));
            }
            if ($this->toDate) {
                $date['to_date'] = $this->toDate;
                $query->where(DB::raw("DATE(date)"), '<=', date('Y-m-d', strtotime($date['to_date'])));
            }
         if ($this->searchName) {
            $query->where('question', 'like', "%{$this->searchName}%");
        }
        $chats = $query->paginate($this->perPage);
        return view('livewire.frontend.chat.chat-my-question',['chats' => $chats]);
    }
}
