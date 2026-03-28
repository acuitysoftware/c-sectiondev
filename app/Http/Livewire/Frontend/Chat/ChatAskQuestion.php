<?php

namespace App\Http\Livewire\Frontend\Chat;

use Auth;
use Http;
use App\Models\Subject;
use App\Models\Chat;
use App\Models\SuperChat;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\AlertMessage;

class ChatAskQuestion extends Component
{
    use WithPagination, AlertMessage;
    protected $paginationTheme = 'bootstrap';
    public function updatingPerPage()
    {
        $this->resetPage();
    }
    protected $listeners = ['resetChildPagination'];

    public function resetChildPagination()
    {
        $this->resetPage();
    }
    public $question, $apiKey, $subjects = [], $user, $subject_id, $difficulty = 1, $chat, $searchSubject, $chat_id, $perPage = 10, $searchName, $isSend = false;
    public function mount()
    {

        $this->user = Auth::user();
        $this->subjects = Subject::where('board_class_id', $this->user->board_class_id)->get();

        $this->apiKey = env('OPENAI_API_KEY', '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');
    }
    public function saveBookmarks($id)
    {
        $chat = Chat::find($id);
        $chat->update(['is_bookmarks' => ($chat->is_bookmarks == 1) ? 0 : 1]);
        //dd($chat);
    }
    public function sendToAdmin($id)
    {
        if ($this->isSend == false) {

            $chat = Chat::with('first_chat')->find($id);
            $newChat = $chat->replicate();
            $newChat->active = 0;
            $newChat->type = 2;
            $newChat->reply_date = null;
            $newChat->reply_time = null;
            $newChat->date = now();
            $newChat->time = now();
            $newChat->save();
            $first_chat = $chat->first_chat()->first();
            $newFirstChat = $first_chat->replicate();
            $newFirstChat->chat_id = $newChat->id;
            $newFirstChat->type = 2;
            $newFirstChat->reply_date = null;
            $newFirstChat->reply_time = null;
            $newFirstChat->answer = null;
            $newFirstChat->date = now();
            $newFirstChat->time = now();
            $newFirstChat->active = 0;
            $newFirstChat->save();

            $this->isSend = true;
            $msgAction = 'Message send successfully';
            $this->showToastr("success", $msgAction, false);
        } else {
            $msgAction = 'Already send';
            $this->showToastr("error", $msgAction, false);
        }
    }
    public function sendMessage()
    {

        if ($this->question) {


            $subjectData = Subject::find($this->subject_id);
            if ($this->chat_id == null) {

                $this->chat = Chat::create([
                    'user_id' => $this->user->id,
                    'subject_id' => $subjectData->id ?? null,
                    'subject_name' => $subjectData->name ?? null,
                    'difficulty' => $this->difficulty,
                    'question' => $this->question,
                    'date' => now(),
                    'time' => now(),
                ]);

                $this->chat_id = $this->chat->id;
            }
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-5.4',
                'messages' => [
                    ['role' => 'user', 'content' => $this->question]
                ],
            ]);


            $answer = null;
            $msg = null;
            $data = json_decode($response->body(), true);
            if (isset($data['choices'][0]['message'])) {
                $msg = $data['choices'][0]['message'];
                $answer = $msg['content'];
            }



            $this->chat->update([
                'reply_date' => now(),
                'reply_time' => now(),
            ]);

            SuperChat::create([
                'chat_id' => $this->chat_id,
                'user_id' => $this->user->id,
                'subject_id' => $subjectData->id ?? null,
                'subject_name' => $subjectData->name ?? null,
                'difficulty' => $this->difficulty,
                'question' => $this->question,
                'answer' => $answer,
                'date' => now(),
                'time' => now(),
                'reply_date' => now(),
                'reply_time' => now(),
            ]);
            $this->question = null;
            return true;
        }
    }
    public function render()
    {
        $query = Chat::with('subject')->whereNotNull('question')->where('user_id', $this->user->id)->orderBy('id', 'desc');
        if ($this->searchSubject) {
            $query->where('subject_id', $this->searchSubject);
        }
        if ($this->searchName) {
            $query->where('question', 'like', "%{$this->searchName}%");
        }
        $recent_chats = $query->paginate($this->perPage);

        $last_chat = Chat::with('messages')->where('id', $this->chat_id)->first();
        return view('livewire.frontend.chat.chat-ask-question', ['last_chat' => $last_chat, 'recent_chats' => $recent_chats]);
    }
}
