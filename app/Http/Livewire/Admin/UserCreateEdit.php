<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\User;
use App\Models\Board;
use App\Models\BoardClass;
use App\Models\ClassGroup;
use Livewire\Component;
use Illuminate\Validation\Rule;

class UserCreateEdit extends Component
{
    use AlertMessage;
    public $name,$board_id, $email, $password,$phone,$active=1,$password_confirmation,$user, $board_class_id, $class_group_id;
    public $isEdit=false;
    public $statusList=[],$boards=[],$classes=[],$groups=[];

    public function mount($user = null)
    {
        if ($user) {
            $this->user = $user;
            $this->fill($this->user);
            $this->isEdit=true;
            $this->classes = BoardClass::where('board_id', $this->user->board_id)->where('active', 1)->get();
            $this->groups = ClassGroup::where('board_class_id', $this->user->board_class_id)->get();
        }
        else
            $this->user=new User;
        
        $this->statusList=[
            ['value'=>"", 'text'=> "Select Status"],
            ['value'=>1, 'text'=> "Active"],
            ['value'=>0, 'text'=> "Inactive"]
        ];

        $this->boards = Board::where('active', 1)->get();
    }

    public function updatedBoardId($id)
    {
        $this->classes = BoardClass::where('board_id', $id)->where('active', 1)->get();
    }

    public function updatedBoardClassId($id)
    {
        $this->groups = ClassGroup::where('board_class_id', $id)->get();
    }
    
    public function validationRuleForSave(): array
    {
        return
            [
                'name' => ['required', 'max:255'],
                'active'=>['required'],
                'board_id'=>['required'],
                'board_class_id'=>['required'],
                'class_group_id'=>['required'],
                'email' => ['required', 'email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,4}$/ix', 'max:255', 'max:255', Rule::unique('users')],
                'phone' => ['required', 'numeric', Rule::unique('users')],
                'password' => ['required', 'max:255', 'min:6', 'confirmed'],
                'password_confirmation' => ['required', 'max:255', 'min:6'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [   'name' => ['required', 'max:255'],
                'active'=>['required'],
                'board_id'=>['required'],
                'board_class_id'=>['required'],
                'class_group_id'=>['required'],
                'email' => ['required', 'email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,4}$/ix', 'max:255', 'max:255', Rule::unique('users')->ignore($this->user->id)],
                'phone' => ['required', 'numeric', Rule::unique('users')->ignore($this->user->id)],
            ];
    }

    public function saveOrUpdate()
    {
        $this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave());

        $first_name = '';
        $last_name = null;
        $full_name = explode(" ",$this->name);
        $first_name = $full_name[0];
        if(count($full_name)>1)
        {
            $last_name = $full_name[1];
        }

        if(!$this->isEdit)
        {
            $data = $this->user->create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'name' => $this->name,
                'phone' => $this->phone,
                'active' => $this->active,
                'password' => $this->password,
                'email' => $this->email,
                'board_id' => $this->board_id,
                'board_class_id' => $this->board_class_id,
                'class_group_id' => $this->class_group_id,
            ]);
            $data->assignRole('STUDENT');
        }
        else{
            $this->user->update([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'name' => $this->name,
                'active' => $this->active,
                'phone' => $this->phone,
                'email' => $this->email,
                'board_id' => $this->board_id,
                'board_class_id' => $this->board_class_id,
                'class_group_id' => $this->class_group_id,
            ]);
            /*if($this->password)
            {
               $this->user->update([
                    'password' => $this->password,
                ]); 
            }*/
        }
        $msgAction = 'User was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('users.index');
    }
    public function render()
    {
        return view('livewire.admin.user-create-edit');
    }
}