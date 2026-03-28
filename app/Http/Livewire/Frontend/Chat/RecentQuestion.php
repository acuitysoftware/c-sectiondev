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
use App\Models\SuperChat;
use App\Models\Board;
use App\Models\BoardClass;
use Livewire\Component;
use App\Http\Livewire\Traits\AlertMessage;
class RecentQuestion extends Component
{
    use AlertMessage;
	public $user,$subjects=[], $current_tab=1;
    
    public function mount()
    {
    	
        $this->user = Auth::user();
        $this->subjects = Subject::where('board_class_id', $this->user->board_class_id)->get();
        
    }
    public function render()
    {
        $chats = SuperChat::with('subject')->where('user_id', $this->user->id)->orderBy('id', 'desc')->get();
        return view('livewire.frontend.chat.recent-question',['chats' => $chats]);
    }
}
