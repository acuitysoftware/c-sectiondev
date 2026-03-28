<?php

namespace App\Http\Livewire\Frontend\Chat;

use Auth;
use Http;
use App\Models\Subject;
use App\Models\Chat;
use App\Models\SuperChat;
use Livewire\Component;
class ChatProfile extends Component
{
    public $question, $apiKey, $subjects = [], $user, $subject_id, $difficulty = 1, $chat, $recent_chats, $searchSubject, $chat_id, $activeTab=1;
    public function changeExamType($value){
        $this->activeTab = $value;
    }
    public function mount()
    {

        $this->user = Auth::user();
        $this->subjects = Subject::where('board_class_id', $this->user->board_class_id)->get();
        if (count($this->subjects)) {
            $subject_id = $this->subjects[0]->id;
        }
        $subjectData = Subject::find($this->subject_id);
        $this->apiKey = env('OPENAI_API_KEY', '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');

        /* $this->chat = Chat::create([
            'user_id' => $this->user->id,
            'subject_id' => $subjectData->id ?? null,
            'subject_name' => $subjectData->name ?? null,
            'difficulty' => $this->difficulty,
            'date' => now(),
            'time' => now(),
        ]); */

        $this->recent_chats = Chat::with('subject')->whereNotNull('question')->where('user_id', $this->user->id)->orderBy('id', 'desc')->get();
    }
    public function render()
    {
        $query = Chat::with('subject')->whereNotNull('question')->where('user_id', $this->user->id)->orderBy('id', 'desc');
        if($this->searchSubject){
            $query->where('subject_id', $this->searchSubject);
        }
        $chats = $query->get();
        return view('livewire.frontend.chat.chat-profile', ['chats' => $chats]);
    }
}
