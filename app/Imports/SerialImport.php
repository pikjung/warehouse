<?php

namespace App\Imports;

use App\Models\serial;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class SerialImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;

    public function __construct($inventory_id)
    {
        $this->inventory_id = $inventory_id;
    }

    public function model(array $row)
    {
        return new serial([
            'sn_id' => uniqid(),
            'no_serial' => $row[0],
            'inventory_id' => $this->inventory_id,
            'status' => 'Gudang GSC',
        ]);
    }

    public function limit(): int
    {
        return 10;
    }

}
