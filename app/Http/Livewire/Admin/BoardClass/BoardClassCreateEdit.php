<?php

namespace App\Http\Livewire\Admin\BoardClass;

use Livewire\Component;
use App\Models\BoardClass;
use App\Models\Board;
use App\Models\ClassGroup;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class BoardClassCreateEdit extends Component
{

    use AlertMessage;
    public $name, $board_id, $price, $board_class, $active=1;
    public $isEdit=false;
    public $statusList=[];
    public $board_list = [];
   

    public function mount($board_class = null)
    {
        if ($board_class) {
            $this->board_class = $board_class;
            $this->fill($this->board_class);
            $this->isEdit=true;
        }
        else
            $this->board_class=new BoardClass;
        
        $this->statusList=[
            ['value'=>"", 'text'=> "Select Status"],
            ['value'=>1, 'text'=> "Active"],
            ['value'=>0, 'text'=> "Inactive"]
        ];

        $this->board_list = Board::where('active',1)->orderBy('name')->get();
        
    }

    public function validationRuleForSave(): array
    {
        return
            [
                'name' => ['required',Rule::unique('board_classes')->where(function($query) {
                  $query->where('board_id', '=', $this->board_id);
              })],
                'board_id' => ['required'],
                'price' => ['required', 'numeric', 'min:1', 
                function ($attribute, $value, $fail) {
                    $value = floatval($value);
        
                    if ($value < 0 || $value >= 1e12) {
                        $fail($attribute . ' is invalid');
                    }
                } ],
                'active'=>['required'],
            ];
    }

    public function validationRuleForUpdate(): array
    {
        return
            [
                'name' => ['required',Rule::unique('board_classes')->where(function($query) {
                  $query->where('board_id', '=', $this->board_id);
              })->ignore($this->board_class->id)],
                'board_id' => ['required'],
                'price' => ['required', 'numeric', 'min:1', 
                function ($attribute, $value, $fail) {
                    $value = floatval($value);
        
                    if ($value < 0 || $value >= 1e12) {
                        $fail($attribute . ' is invalid');
                    }
                } ],
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
        $this->board_class->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        if(!$this->isEdit)
        {
            ClassGroup::create([
                'board_class_id' => $this->board_class->id,
                'name' => 'ALFA',
                'slug' => 'alfa',
            ]);
            ClassGroup::create([
                'board_class_id' => $this->board_class->id,
                'name' => 'BEATA',
                'slug' => 'beata',
            ]);
            ClassGroup::create([
                'board_class_id' => $this->board_class->id,
                'name' => 'THETA',
                'slug' => 'theta',
            ]);
            ClassGroup::create([
                'board_class_id' => $this->board_class->id,
                'name' => 'GAMA',
                'slug' => 'gama',
            ]);
        }

        $slug = $this->slugify($this->name);

        $this->board_class->update(['slug' => $slug]);
        
        $msgAction = 'Class was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('board-class.index');
    }

    

    public function render()
    {
       
        return view('livewire.admin.board-class.board-class-create-edit');
    }
}
