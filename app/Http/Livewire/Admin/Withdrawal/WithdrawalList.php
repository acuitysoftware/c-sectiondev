<?php

namespace App\Http\Livewire\Admin\Withdrawal;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Withdraw;
use App\Models\Commission;
use Livewire\Component;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use App\Rules\DateFormatRule;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\Payout;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;

class WithdrawalList extends Component
{

	use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];



    public  $searchName, $searchAmount, $searchStatus = -1, $searchDate, $perPage = 5, $status;

    protected $listeners = ['deleteConfirm', 'changeStatus'];

    public function mount()
    {
        $this->perPageList = [
            ['value' => 5, 'text' => "5"],
            ['value' => 10, 'text' => "10"],
            ['value' => 20, 'text' => "20"],
            ['value' => 50, 'text' => "50"],
            ['value' => 100, 'text' => "100"]
        ];
    }
    public function getRandomColor()
    {
        $arrIndex = array_rand($this->badgeColors);
        return $this->badgeColors[$arrIndex];
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function search()
    {
        $this->resetPage();
    }
    public function resetSearch()
    {
        $this->searchName = "";
        $this->searchAmount = "";
        $this->searchDate = "";
        $this->searchStatus = -1;
    }
    public function render()
    {
    	$withdrawQuery = Withdraw::query();
        if ($this->searchName)
        {
            $withdrawQuery->whereRelation('user','name', "'like '%" . $this->searchName . "%' "
            );
        }
        if ($this->searchAmount)
            $withdrawQuery->orWhere('reward_points',$this->searchAmount);

        if ($this->searchDate)
            $withdrawQuery->orWhereDate('created_at', $this->searchDate);
        if ($this->searchStatus >= 0)
            $withdrawQuery->orWhere('status', $this->searchStatus);
        return view('livewire.admin.withdrawal.withdrawal-list', ['withdrawals' => $withdrawQuery->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage)]);
    }

    public function statusChanged($id)
    {
        $data = ['id' => $id, 'status' =>$this->status];
        if($value = '1')
        {
            $this->showConfirmation("warning", 'Are you sure?', "Do you want to approve the withdrawal request?", 'Yes, Change!', 'changeStatus', $data);
        }
        else
        {
            $this->showConfirmation("warning", 'Are you sure?', "Do you want to cancel the withdrawal request?", 'Yes, Change!', 'changeStatus', $data);  
        }
    }

    public function changeStatus($id)
    {
        $data_id = $id['id'];
        $data_status = $id['status'];
        $data_withdraw = Withdraw::find($data_id);

        $data_withdraw->update([
                'status' => $data_status,
            ]);
            $msgAction = 'Status changed successfully';
            $this->showToastr("success",$msgAction , false);
       

        
    }
}
