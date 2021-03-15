<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\paket;

use App\Models\expedisi;

use Illuminate\Support\Facades\Validator;

use App\Models\pouser;

use App\Models\log;

use App\Models\pouser_det;

use DataTables;

use DB;

use Illuminate\Support\Facades\Auth;

class deliveryController extends Controller
{
    //
    public function paketView()
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses' ,'bagian' => 'Paket']);
        $expedisi = expedisi::all();
        return view('/delivery/paket', ['expedisi' => $expedisi]);
    }

    public function paketGet()
    {
        $data1 = paket::all();
        return Datatables::of(paket::all())
        ->addColumn('action', function ($data1)
        {
            if ($data1->status == 'draft') return '<a href="#" id="edit_paket" onclick=edit_paket("'.$data1->paket_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_paket" onclick=hapus_paket("'.$data1->paket_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a><a href="#" class="btn btn-sm btn-success" onclick=kirim_paket("'.$data1->paket_id.'")><i class="glyphicon glyphicon-send"></i></a>';
            if ($data1->status == 'Terkirim') return '<span class="badge badge-info">Terkirim</span>';
        })
        ->editcolumn('detail', function ($data1)
        {
            return '<a href="#" class="btn btn-info" onclick=detail_paket("'.$data1->paket_id.'")><i class="glyphicon glyphicon-eye-open"></i></a>';
        })
        ->editColumn('print', function ($data1){
            return '<a href="/delivery/paket/print/'.$data1->paket_id.'" class="btn btn-info"><span class="glyphicon glyphicon-print"></span> DN<a>';
        })
        ->rawColumns(['action','nama_expedisi','detail','print'])
        ->editColumn('paket_id','{{$paket_id}}')
        ->make(true);
    }

    public function paketTambah(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tambah' ,'bagian' => 'Paket']);
        $validasi = Validator::make($request->all(),[
            'dn_no' => 'required',
            'nama_paket' => 'required',
            'expedisi_id' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        $id = uniqid();
        $data = paket::create([
            'paket_id' => $id,
            'dn_no' => $request->dn_no,
            'nama_paket' => $request->nama_paket,
            'expedisi_id' => $request->expedisi_id,
            'status' => 'draft'
        ]);

        return response()->json(array('res' => 'berhasil'));
    }

    public function paketEditGet(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tampil Edit' ,'bagian' => 'Paket']);
        $id = $request->id;
        $data = paket::find($id);
        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    public function paketEditStore(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'dn_no' => 'required',
            'nama_paket' => 'required',
            'expedisi_id' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        $id = $request->id;
    
        $data = paket::find($id);
        $data->dn_no = $request->dn_no;
        $data->nama_paket = $request->nama_paket;
        $data->expedisi_id = $request->expedisi_id;
        $data->save();

        return response()->json(array('res' =>'berhasil'));
    }

    public function paketHapus(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Hapus' ,'bagian' => 'Paket']);
        $id = $request->id;
        $po = pouser::where('paket_id',$id)->get()->count();
        if ($po > 0) {
            foreach ($po as $key ) {
                $p = pouser::where('paket_id',$key->id)->first();
                $p->paket_id = null;
                $p->save();
            }
            $data = paket::find($id)->delete();
        } else {
            $data = paket::find($id)->delete();
        }
        
        return response()->json(array('res' => 'berhasil'));
    }

    public function paketHapusGet(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tampil Hapus' ,'bagian' => 'Paket']);
        $id = $request->id;
        $data = pouser::where('paket_id',$id)->get();
        if ($data->count() > 0) {
            return response()->json(array('res' => 'berhasil'));
        } else {
            return response()->json(array('res' => 'gagal'));
        }
    }

    public function paketDetail(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses' ,'bagian' => 'Paket Detail']);

        $id = $request->id;
        $data = pouser::where('paket_id', $id)->get();
        $paket = paket::find($id);
        $expedisi_id = $paket->expedisi_id;
        $expedisi = expedisi::find($expedisi_id);
        $nama_expedisi = $expedisi->nama_expedisi;
        return response()->json(array('res' => 'berhasil', 'data' => $data, 'nama_expedisi' => $nama_expedisi, 'id' => $id, 'paket' => $paket));
    }

    public function paketDetailSelect()
    {
        $data = pouser::where('status', 'po')
                        ->where('paket_id' , null)
                        ->get();
        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    public function paketDetailAdd(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tambah' ,'bagian' => 'Paket Detail']);
        $data = $request->data;
        $id = $request->id;
        foreach ($data as $key) {
            $po = pouser::find($key);
            $po->paket_id = $id;
            $po->save();
        }
        return response()->json(array('res' => 'berhasil'));
    }

    public function paketDetailDelete(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Hapus' ,'bagian' => 'Paket Detail']);
        $id = $request->id;
        $po = pouser::find($id);
        $po->paket_id = null;
        $po->save();

        return response()->json(array('res' => 'berhasil'));
    }

    public function paketKonfirmasi(Request $request)
    {
        $id = $request->id;
        $data = pouser::where('paket_id', $id)->get();
        $html = '';
        $tr = '';
        foreach ($data as $key ) {
            $tr = '';
            $html = $html. "<div class='col-12'>
                    PO No : ".$key->po_customer."
                </div>";
            $det = pouser_det::where('userReq_id',$key->userReq_id)->get();
            foreach ($det as $key ) {
                $tr = $tr. "<tr>
                    <td>".$key->nama_barang."</td>
                    <td>".$key->quantity."</td>
                </tr>";
            }
            $html = $html . "<div class='col-12'>
            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>QTY</th>
                    </tr>
                </thead>
                <tbody>
                ".$tr."
                </tbody>
            </table>
        </div>";
        }

        return response()->json(array('res' => 'berhasil', 'data' => $html, 'id' => $id));
    }

    public function paketKirim(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Kirim' ,'bagian' => 'Paket']);
        $id = $request->id;
        $no_resi = $request->no_resi;
        $po = pouser::where('paket_id',$id)->get();
        foreach ($po as $key ) {
            $data = pouser::find($key->userReq_id);
            $data->no_resi = $no_resi;
            $data->tgl_resi = date('Y-m-d');
            $data->status = 'Terkirim';
            $data->save();
        }

        $paket = paket::find($id);
        $paket->status = 'Terkirim';
        $paket->no_resi = $no_resi;
        $paket->tgl_kirim = date('Y-m-d');
        $paket->save();

        return response()->json(array('res' => 'berhasil'));
    }


    //Logistic
    public function logistic()
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses' ,'bagian' => 'Expedisi']);
        return view('/delivery/expedisi');
    }

    public function logisticGetView()
    {
        $data1 = expedisi::all();
        return Datatables::of(expedisi::all())
        ->addColumn('action', function ($data1)
        {
             return '<a href="#" id="edit_expedisi" onclick=edit_expedisi("'.$data1->expedisi_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_expedisi" onclick=hapus_expedisi("'.$data1->expedisi_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
        })
        ->editcolumn('detail', function ($data1)
        {
            return '<a href="#" class="btn btn-info" onclick=detail_expedisi("'.$data1->expedisi_id.'")><i class="glyphicon glyphicon-eye-open"></i></a>';
        })
        ->rawColumns(['action','detail'])
        ->make(true);
    }

    public function logisticTambah(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tambah' ,'bagian' => 'Expedisi']);
        $nama_expedisi = $request->nama_expedisi;
        $no_telp = $request->no_telp;
        $alamat = $request->alamat;

        $validasi = Validator::make($request->all(),[
            'nama_expedisi' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }        

        $id = uniqid();
        $data = expedisi::create([
            'expedisi_id' => $id,
            'nama_expedisi' => $nama_expedisi,
            'no_telp' => $no_telp,
            'alamat_expedisi' => $alamat
        ]);

        return response()->json(array('res' => 'berhasil'));
    }

    public function logisticEditGet(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tampil Edit' ,'bagian' => 'Expedisi']);
        $id = $request->id;
        $data = expedisi::find($id);

        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    public function logisticEditStore(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Edit' ,'bagian' => 'Expedisi']);
        $validasi = Validator::make($request->all(),[
            'nama_expedisi' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }    
        $nama_expedisi = $request->nama_expedisi;
        $no_telp = $request->no_telp;
        $alamat = $request->alamat;
        $id= $request->id;

        $data = expedisi::find($id);
        $data->nama_expedisi = $nama_expedisi;
        $data->no_telp = $no_telp;
        $data->alamat_expedisi = $alamat;
        $data->save();

        return response()->json(array('res' => 'berhasil'));
    }

    public function logisticHapus(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Hapus' ,'bagian' => 'Expedisi']);
        $id = $request->id;
        $data = expedisi::find($id);
        $data->delete();

        return response()->json(array('res' => 'berhasil'));
    }

    public function paketDetail_po(Request $request)
    {

        $id = $request->id;
        $pouser = pouser::where('paket_id', $id)->get();
        $html = '';

    }

    public function paketPrint($id)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses' ,'bagian' => 'Paket Print']);
        $pouser = pouser::where('paket_id', $id)->get();
        $paket = paket::find($id);
        $expedisi = expedisi::find($paket->expedisi_id);
        return view('/delivery/paket_dn',['pouser' => $pouser, 'paket' => $paket, 'expedisi' => $expedisi]);
    }
}
