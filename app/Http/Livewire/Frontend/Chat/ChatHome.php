<?php

namespace App\Http\Livewire\Frontend\Chat;

use Auth;
use Hash;
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
class ChatHome extends Component
{
    use AlertMessage,WithPagination;
	public $user,$subjects=[],$searchSubject, $last_chat,$last_chat_id,$question, $perPage=10,$searchName;
     protected $paginationTheme = 'bootstrap';
     protected $listeners = ['resetChildPagination'];
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

       
        
    }
    

    public function changeTabs($id)
    {
        $this->emitUp('changeTab', $id);
        //$this->emitUp('resetChildPagination');
    }
    public function render()
    {
        
        $query = Chat::with('subject')->whereNotNull('question')->where('user_id', $this->user->id)->orderBy('id', 'desc');
        if($this->searchSubject){
            $query->where('subject_id', $this->searchSubject);
        }
        $chats = $query->paginate($this->perPage);


        return view('livewire.frontend.chat.chat-home', ['chats' => $chats]);
    }
}
