<?php

namespace App\Imports;

use App\serial;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class GetSerialExport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    use Importable;
    public function model(array $row)
    {
        return new serial([
            
        ]);
    }
}
