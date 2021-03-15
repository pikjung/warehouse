<?php

namespace App\Exports;

use App\Models\pogsc;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class pogscExport implements FromQuery
{
    use Exportable;

    public function __construct(string $date)
    {
        $this->date = $date;
    }

    public function query()
    {
        return pogsc::query()->Where('tanggal', 'like', '%' . $this->date . '%')->get();
    }
}
