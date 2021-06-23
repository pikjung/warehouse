<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use DB;

class tokoExport implements FromCollection
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
                  ->join('detail_transaksi', 'serial.userReq_det_id', '=', 'detail_transaksi.detail_transaksi_id')
                  ->join('transaksi', 'detail_transaksi.transaksi_id', '=', 'transaksi.transaksi_id')
                  ->join('toko', 'transaksi.toko_id','=','toko.toko_id')
                  ->join('platform', 'toko.platform_id', '=', 'platform.platform_id')
                  ->select('serial.no_serial','serial.status','transaksi.no_transaksi','transaksi.no_inv_platform','transaksi.customer','transaksi.alamat','transaksi.kurir','transaksi.plat_kendaraan_kurir','toko.nama_toko','platform.nama','gudang.nama_gudang', 'inventorie.nama_disti','inventorie.nama_barang','detail_transaksi.deskripsi')
                  ->orderBy('transaksi.created_at','desc')
                  ->where('serial.status', '=', 'store')
                  ->where('serial.updated_at','like','%' . $this->dateArr . '%')
                  ->get();
  }
}
