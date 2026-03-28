<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class SalesExportAllData implements FromView
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
        return view('excel.sales_report_all_data', [
            'reports' => $this->data
        ]);
    }
}
