<?php

namespace App\Http\Livewire\Admin\Chat;

use Livewire\Component;
use App\Models\Chat;
use App\Models\SuperChat;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\ChapterFile;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class ChatCreateEdit extends Component
{
    use AlertMessage,WithFileUploads;
    public $answer,$active=1,$time,$chat, $question, $description, $rating,$first_chat;
    public $isEdit=false;
    public $statusList=[], $ratingList=[];

    public function mount($chat = null)
    {
        if ($chat) {
            $this->chat = $chat;
            $this->isEdit=true;
        }

        $this->first_chat = $this->chat->first_chat()->first();
        $this->question = $this->chat->question;
        $this->answer = $this->first_chat->answer;

        
        
        $this->statusList=[
            ['value'=>"", 'text'=> "Select Status"],
            ['value'=>1, 'text'=> "Active"],
            ['value'=>0, 'text'=> "Inactive"]
        ];
    }
    public function validationRuleForSave(): array
    {
        return
            [
                'answer'=>['required'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return[
                'answer'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
       $this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave());

       $this->first_chat->update([
        'answer' => $this->answer,
        'reply_date' => now(),
        'reply_time' => now(),
        'active' => 1,
       ]);
       $this->chat->update([
        'reply_date' => now(),
        'reply_time' => now(),
        'active' => 1,
       ]);
        $msgAction = 'Chat was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('chats.index');
    }
    public function render()
    {
        return view('livewire.admin.chat.chat-create-edit');
    }
}
