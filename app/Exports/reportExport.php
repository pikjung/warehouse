<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use DB;

class reportExport implements FromCollection
{
    public function __construct($periode)
    {
      $this->dateArr = $periode;
    }

    public function collection()
    {
        //
        return DB::table('serial')
                    ->join('inventorie', 'serial.inventory_id', '=', 'inventorie.inventory_id')
                    ->join('gudang', 'inventorie.gudang_id', '=', 'gudang.gudang_id')
                    ->join('user_req_det', 'serial.userReq_det_id', '=', 'user_req_det.userReq_det_id')
                    ->join('user_req', 'user_req_det.userReq_id', '=', 'user_req.userReq_id')
                    ->join('paket', 'user_req.paket_id', '=', 'paket.paket_id')
                    ->join('expedisi','paket.expedisi_id', '=', 'expedisi.expedisi_id')
                    ->select('serial.no_serial','serial.status','user_req.dn_no','user_req.customer','user_req.po_customer','gudang.nama_gudang', 'inventorie.nama_disti','inventorie.nama_barang','expedisi.nama_expedisi','paket.dn_no','paket.no_resi')
                    ->orderBy('user_req.created_at','desc')
                    ->where('serial.status', '!=', 'store')
                    ->where('serial.updated_at','like','%' . $this->dateArr . '%')
                    ->get();
    }
}
