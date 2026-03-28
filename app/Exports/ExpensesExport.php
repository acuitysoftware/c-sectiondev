<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
class ExpensesExport implements FromArray
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
    public function array(): array
    {
        return $this->data;
    }
}
