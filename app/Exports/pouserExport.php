<?php

namespace App\Exports;

use App\pouser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class pouserExport implements FromQuery
{
    use Exportable;

    public function __construct(int $date)
    {
        $this->date = $date;
    }

    public function query()
    {
        return pouser::query()->Where('created_at', 'like', '%' . $this->date . '%')->get();
    }
}
