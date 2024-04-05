<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class StatsExport implements FromCollection
{
    public $data = null;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->data;
    }
}
