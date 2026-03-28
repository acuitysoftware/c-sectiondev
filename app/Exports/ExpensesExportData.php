<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class ExpensesExportData implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $data;
    
    public function __construct($data) {
        $this->data = $data;
        
    }

    /**
    * Excel Data
    */
    public function view(): View
    {
        return view('excel.expense_report_data', [
            'reports' => $this->data
        ]);
    }
}
