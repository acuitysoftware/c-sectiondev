<?php

namespace App\Http\Livewire\Admin\Board;

use Livewire\Component;
use App\Models\Board;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class BoardCreateEdit extends Component
{

    use AlertMessage;
    public $name, $board, $active=1;
    public $isEdit=false;
    public $statusList=[];

    public function mount($board = null)
    {
        if ($board) {
            $this->board = $board;
            $this->fill($this->board);
            $this->isEdit=true;
        }
        else
            $this->board=new Board;

        
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
                'name' => ['required',Rule::unique('boards')],
                'active'=>['required'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [
                'name' => ['required',Rule::unique('boards')->ignore($this->board->id)],
                'active'=>['required'],
            ];
    }

    public static function slugify($text, string $divider = '-')
    {
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
    }

    public function saveOrUpdate()
    {
        $this->board->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        $slug = $this->slugify($this->name);

        $this->board->update(['slug' => $slug]);
        
        $msgAction = 'Board was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('boards.index');
    }

    public function render()
    {
        return view('livewire.admin.board.board-create-edit');
    }
}
