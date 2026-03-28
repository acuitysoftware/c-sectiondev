<?php

namespace App\Http\Livewire\Frontend\User;

use Auth;
use Session;
use Hash;
use App\Models\User;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\Board;
use App\Models\Withdraw as WithdrawModel;
use App\Models\RewardPoint;
use Livewire\Component;
use App\Http\Livewire\Traits\AlertMessage;

class Withdraw extends Component
{
	use AlertMessage;
	public $bank_name, $branch_name, $ifsc_code, $account_no, $total_points=0, $user, $point, $withdraw_points, $subjects=[];
    public function mount()
    {
        $this->user = Auth::user();
        $this->withdraw_points = WithdrawModel::where([
                    'user_id'=>$this->user->id,
                ])->sum('reward_points');
        $this->total_points = RewardPoint::where([
                    'user_id'=>$this->user->id,
                ])->sum('reward_points');

        $this->total_points= ($this->total_points-$this->withdraw_points);
        $this->subjects = Subject::where('board_class_id', $this->user->board_class_id)->get();

    }
    public function save()
    {
        $this->validate([
        	'bank_name' => 'required',
        	'branch_name' => 'required',
        	'account_no' => 'required|unique:users,account_no,'.$this->user->id,
        	'ifsc_code' => 'required',
        	'point' => 'required|min:1|max:'.$this->total_points,
        ]);

        $this->user->update([
        	'bank_name' =>$this->bank_name,
        	'branch_name' =>$this->branch_name,
        	'account_no' =>$this->account_no,
        	'ifsc_code' =>$this->ifsc_code,
        ]);

        WithdrawModel::create([
        	'user_id' => $this->user->id,
            'reward_points' => $this->point,
        ]);

        Session::flash('success','Withdrawal Request Submit Successfully');
        return redirect()->route('user.profile');
    }
    public function render()
    {
        return view('livewire.frontend.user.withdraw');
    }
}
