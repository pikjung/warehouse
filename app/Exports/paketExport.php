<?php

namespace App\Exports;

use App\paket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class paketExport implements FromQuery
{
    use Exportable;

    public function __construct(int $date)
    {
        $this->date = $date;
    }

    public function query()
    {
        return paket::query()->Where('created_at', 'like', '%' . $this->date . '%')->get();
    }
}
