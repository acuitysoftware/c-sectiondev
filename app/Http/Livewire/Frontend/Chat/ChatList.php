<?php

namespace App\Http\Livewire\Frontend\Chat;

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

class ChatList extends Component
{
    use AlertMessage;
	public $user,$subjects=[], $current_tab=1;
    protected $listeners = [
        'changeTab',
        "deleteConfirm"
    ];
    public function mount()
    {
    	
        $this->user = Auth::user();
        
        $this->subjects = Subject::where('board_class_id', $this->user->board_class_id)->get();
        
    }
    public function changeTab($id)
    {
        if($id == "6"){
            return redirect()->route('user.account');
        }else{
            $this->emitUp('resetChildPagination');
            $this->current_tab = $id;
        }
    }
    public function render()
    {
        return view('livewire.frontend.chat.chat-list');
    }
}
