<?php

namespace App\Exports;

use App\serial;
use Maatwebsite\Excel\Concerns\FromCollection;

class GetSerialExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return serial::all();
    }
}
