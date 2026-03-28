<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

class SalesExport implements FromArray
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
