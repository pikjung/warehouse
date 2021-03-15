<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\pouser;

use App\Models\paket;

use App\Models\pogsc;

use App\Models\pouser_de;

use App\Models\pogsc_det;

use App\Exports\pouserExport;

use App\Exports\pogscExport;

use App\Exports\paketExport;

use App\Models\expedisi;

use Maatwebsite\Excel\Facades\Excel;

use DataTables;

use DB;

class reportController extends Controller
{
    public function report()
    {
        return view('/report/report');
    }

    public function reportDownload(Request $request)
    {
        $report = $request->report;
        $periode = $request->month;
        $dateArr = explode("-", $periode);
        $year = $dateArr[0];
        $month = $dateArr[1];
        if ($report == 'pogsc') {
            $data = pogsc::select(['data_barang_id','nama_disti','name','no_telp','fax','alamat','no_po_gsc','tanggal','tgl_terima','status','noted','payment_terms'])->whereYear('created_at',$year)->whereMonth('created_at',$month)->get();
            return response()->json(array('res' => 'berhasil', 'data' => $data));
        } elseif ($report == 'pouser') {
            $data = pouser::select(['userReq_id','po_customer','dn_no','tanggal','status','customer','penerima','no_telp','payment_terms','alamat','no_invoice','no_resi','paket_id','tgl_inv','tgl_resi','tgl_payment','noted'])->whereYear('created_at',$year)->whereMonth('created_at',$month)->get();
            return response()->json(array('res' => 'berhasil', 'data' => $data));
        } elseif ($report == 'delivery') {
            $row = array();
            $tr = '';
            $td = '';
            $nomer = 1;
            $data = paket::whereYear('created_at',$year)->whereMonth('created_at',$month)->get();
            foreach ($data as $key ) {
                $po = pouser::where('paket_id',$key->paket_id)->get();
                $d = '';
                foreach ($po as $dt) {
                    $d = $d . $dt->po_customer .",";
                }
                $expedisi = expedisi::find($key->expedisi_id);
                $td = $td . '<td>'.$key->nama_paket.'</td><td>'.$expedisi->nama_expedisi.'</td><td>'.$key->tgl_kirim.'</td><td>'.$d.'</td><td>'.$key->no_resi.'</td>';
                //array_push($row,'nama_paket' => $key->nama_paket, 'nama_expedisi' => $expedisi->nama_expedisi, 'tgl_kirim' => $key->tgl_kirim, 'pouser' => $d, 'no_resi' => $key->no_resi);
                $row[$nomer]['nama_paket'] = $key->nama_paket;
                $row[$nomer]['nama_expedisi'] = $expedisi->nama_expedisi;
                $row[$nomer]['tgl_kirim'] = $key->tgl_kirim;
                $row[$nomer]['pouser'] = $d;
                $row[$nomer++]['no_resi'] = $key->no_resi;
                $tr = $tr . $td;
            }
            $rowJSON = json_encode($row);
            return response()->json(array('res' => 'berhasil','data' => $tr));
        }
    }
}
