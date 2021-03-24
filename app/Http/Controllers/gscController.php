<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\distributor;

use App\Models\pogsc;

use App\Models\pogsc_det;

use App\Models\inventory;

use App\Models\gudang;

use Illuminate\Support\Facades\Auth;

use App\Models\log;

use Illuminate\Support\Facades\Validator;

use DataTables;

use DB;


class gscController extends Controller
{
    //

    public function rupiah($angka)
    {
        $hasil_rupiah = number_format($angka);
	    return $hasil_rupiah;
    }

    public function distributorView()
    {
        $data = distributor::all();
        $gudang = gudang::all();
        return view('/gsc/distributor',['data' => $data]);
    }

    public function distributorTambah(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        $id_uniq = uniqid();
        $data = distributor::create([
            'disti_id' => $id_uniq,
            'nama_disti' => $request->nama,
            'alamat_disti' => $request->alamat,
            'no_telp_disti' => $request->no_telp,
        ]);

        return response()->json(array('res' => 'success'));
    }

    public function distributorGet()
    {
        $data = distributor::select(['disti_id', 'nama_disti', 'alamat_disti', 'no_telp_disti']);
        return Datatables::of(distributor::all())
        ->addColumn('action', function ($data)
        {
            return '<a href="#" id="edit_distributor" onclick=edit_disti("'.$data->disti_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_distributor" onclick=hapus_disti("'.$data->disti_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
        })
        ->editColumn('disti_id','{{$disti_id}}')
        ->make(true);
    }

    public function distributorEditGet(Request $request)
    {
        $id = $request->id;

        $data = distributor::find($id);

        return response()->json(array('res' => 'berhasil' , 'data' => $data));
    }

    public function distributorEditStore(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        $id = $request->id;
        $data = distributor::where('disti_id',$id)->first();
        $data->nama_disti = $request->nama;
        $data->alamat_disti = $request->alamat;
        $data->no_telp_disti = $request->no_telp;
        $data->save();

        return response()->json(array('res' => 'berhasil'));
    }

    public function distributorhapus(Request $request)
    {
        $id = $request->id;
        $data = distributor::find($id);
        $data->delete();

        return response()->json(array('res' => 'berhasil'));
    }

    public function pogscView()
    {
        $gudang = gudang::all();
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses' ,'bagian' => 'POGSC']);
        return view('/gsc/pogsc', compact('gudang'));
    }

    public function pogscGet()
    {
        $data = pogsc::select(['data_barang_id','nama_disti','name','no_telp','fax','alamat','no_po_gsc','tanggal','status','noted','paymet_terms']);
        return Datatables::of(pogsc::orderBy('created_at','desc'))
        ->addColumn('action', function ($data)
        {
            if ($data->status == 'po') return '<a href="#" id="edit_po" onclick=edit_po("'.$data->data_barang_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_po" onclick=hapus_po("'.$data->data_barang_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a><a href="#" id="konfirmasi_po" onclick=konfirmasi_po("'.$data->data_barang_id.'") class="btn btn-sm btn-success"><i class="glyphicon glyphicon-arrow-right"></i></a><a href="#" id="print_po" onclick=print_po("'.$data->data_barang_id.'") class="btn btn-sm btn-success"><i class="glyphicon glyphicon-print"></i> Print PO</a>';
            if ($data->status == 'diterima') return '<span class="badge badge-info">Diterima</span> <a href="#" id="print_po" onclick=print_po("'.$data->data_barang_id.'") class="btn btn-sm btn-success"><i class="glyphicon glyphicon-print"></i> Print PO</a>';
            
        })
        ->editColumn('detail', function ($data)
        {
            return '<a href="#" id="detail_po" onclick=detail_po("'.$data->data_barang_id.'") class="btn btn-sm btn-secondary"><i class="glyphicon glyphicon-eye-open"></i></a>';
        })
        ->rawColumns(['detail','action'])
        ->editColumn('data_barang_id','{{$data_barang_id}}')
        ->make(true);

    }

    public function pogscHapus(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Hapus' ,'bagian' => 'POGSC']);
        $id = $request->id;

        $data = pogsc::find($id);
        $data->delete();

        return response()->json(array('res' => 'berhasil'));
    }

    public function pogscDetail(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses Detail' ,'bagian' => 'POGSC']);
        $id = $request->id;
        $po = pogsc::find($id);
        $data = pogsc_det::where('data_barang_id',$id)->get();
        return response()->json(array('res' => 'berhasil', 'data' => $data, 'status' => $po));
    }

    public function pogscTambah(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tambah' ,'bagian' => 'POGSC']);
        $id_uniq = uniqid();
        $data = pogsc::create([
            'data_barang_id' => $id_uniq,
            'gudang_id' => $request->gudang_id,
            'nama_disti' => $request->nama_disti,
            'name' => $request->to_name,
            'no_telp' => $request->no_telp,
            'fax' => $request->fax,
            'alamat' => $request->alamat,
            'no_po_gsc' => $request->no_po,
            'ship_to' => $request->ship_to,
            'no_telp_ship' => $request->no_telp_ship,
            'ship_name' => $request->ship_name,
            'noted' => $request->noted,
            'payment_terms' => $request->payment_terms,
            'status' => 'po',
            'tanggal' => date('Y-m-d'),
        ]);

        return response()->json(array('res' => 'success'));
    }

    public function pogscSelect()
    {
        $data = distributor::all();
        return response()->json($data);
    }

    public function pogscEditGet(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tampil Edit' ,'bagian' => 'POGSC']);
        $id = $request->id;

        $data = pogsc::find($id);

        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    public function pogscEditStore(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Edit' ,'bagian' => 'POGSC']);
        $id = $request->id;

        $data = pogsc::find($id);
        $data->gudang_id = $request->gudang_id;
        $data->ship_to = $request->ship_to;
        $data->ship_name = $request->ship_name;
        $data->no_telp_ship = $request->no_telp_ship;
        $data->nama_disti = $request->nama_disti;
        $data->name = $request->to_name;
        $data->no_telp = $request->no_telp;
        $data->fax = $request->fax;
        $data->alamat = $request->alamat;
        $data->no_po_gsc = $request->no_po;
        $data->noted = $request->noted;
        $data->payment_terms = $request->payment_terms;
        $data->save();

        return response()->json(array('res' => 'berhasil'));
    }

    public function pogscPrint($id)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Print' ,'bagian' => 'POGSC']);
        $pogsc = pogsc::find($id);
        $det_gsc = pogsc_det::where('data_barang_id',$id)->get();

        return view('/gsc/printPO',['pogsc' => $pogsc,'det' => $det_gsc]);
    }

    public function pogscDetailEdit($id)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses Detail' ,'bagian' => 'POGSC']);
        return view('/gsc/detailEdit', compact('id'));
    }

    public function pogscDetailEditView($id)
    {

        $data = pogsc_det::select(['detData_barang_id','data_barang_id','nama_barang','spek','quantity','harga_barang_satuan','harga_beli_satuan']);
        return Datatables::of(pogsc_det::where('data_barang_id',$id))
        ->addColumn('action', function ($data)
        {
            return '<a href="#" id="edit_detail" onclick=edit_detail("'.$data->detData_barang_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_detail" onclick=hapus_detail("'.$data->detData_barang_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
            
        })
        ->addColumn('total_barang', function ($data)
        {
            return $this->rupiah($data->quantity * $data->harga_barang_satuan);
        })
        ->addColumn('total_beli', function ($data)
        {
            return $this->rupiah($data->quantity * $data->harga_beli_satuan);
        })
        ->editColumn('detData_barang_id','{{$detData_barang_id}}')
        ->make(true);
    }

    public function pogscDetailEditTambah(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tambah Detail' ,'bagian' => 'POGSC']);
        $data_barang_id = $request->id;
        $id = uniqid();

        $data = pogsc_det::create([
            'detData_barang_id' => $id,
            'data_barang_id' => $data_barang_id,
            'nama_barang' => $request->nama_barang,
            'spek' => $request->spek,
            'pn' => $request->pn,
            'sku' => $request->sku,
            'quantity' => $request->quantity,
            'harga_beli_satuan' => $request->harga_beli
        ]);

        return response()->json(array('res' => 'berhasil'));
    }

    public function pogscDetailEditEditStore(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Edit Detail' ,'bagian' => 'POGSC']);
        $id = $request->id;

        $data = pogsc_det::find($id);

        $data->nama_barang = $request->nama_barang;
        $data->spek = $request->spek;
        $data->pn = $request->pn;
        $data->sku = $request->sku;
        $data->quantity = $request->quantity;
        $data->harga_beli_satuan = $request->harga_beli;
        $data->save();

        return response()->json(array('res' => 'berhasil'));
    }

   public function pogscDetailEditEditGet(Request $request)
   {
    DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tampil Edit Detail' ,'bagian' => 'POGSC']);
       $id = $request->id;

       $data = pogsc_det::find($id);

       return response()->json(array('res' => 'berhasil', 'data' => $data));
   }

   public function pogscDetailEditHapus(Request $request)
   {
       $id = $request->id;
       $data = pogsc_det::find($id);
       $data->delete();

       return response()->json(array('res' => 'berhasil'));
   }

   public function pogscTerima(Request $request)
   {
    DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Terima' ,'bagian' => 'POGSC']);
       $id = $request->id;
       $po = pogsc::find($id);
       $po->status = 'diterima';
       $nama_disti = $po->nama_disti;
       $gudang_id = $po->gudang_id;
        if ($gudang_id == null) {
            $gudang_id = '5ece4797eaf5e';
        } else {
            $gudang_id = $gudang_id;
        }
       $po->tgl_terima = date('Y-m-d');
       $data = pogsc_det::where('data_barang_id',$id)->get();

       foreach ($data as $key ) {
            $id_uniq = uniqid();
           inventory::create([
               'inventory_id' => $id_uniq,
                'gudang_id' => $gudang_id,
               'nama_disti' => $nama_disti,
               'tanggal' => date('Y-m-d'),
               'nama_barang' => $key['nama_barang'],
               'spek' => $key['spek'],
               'pn' => $key['pn'],
               'sku' => $key['sku'],
               'quantity' => $key['quantity'],
                'quantity_awal' => $key['quantity']
           ]);
       }
       $po->save();
       return response()->json(array('res' => 'berhasil'));

   }

   public function autofill(Request $request)
    {
        $nama_disti = $request->nama_disti;

        $data =distributor::where('nama_disti', 'LIKE', '%'.$nama_disti.'%')->get();
        return response()->json(array('data' => $data));
    }

    public function autofillCom(Request $request)
    {
        $disti_id = $request->disti_id;
        $data =distributor::find($disti_id);
        //$jsData = json_encode($data);
        return response()->json(array('data' => $data));
    }

    public function gudangAutofillCom(Request $request)
    {
        $gudang_id = $request->gudang_id;
        $data =gudang::find($gudang_id);
        //$jsData = json_encode($data);
        return response()->json($data);
    }

}
