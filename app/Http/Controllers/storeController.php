<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use toko model
use App\Models\toko;

//use gudang model;
use App\Models\gudang;

//use platform model
use App\Models\platform;

//use transaksi model;
use  App\Models\transaksi;

//use transaksi_detail model;
use App\Models\detail_transaksi;

//use serial nodel
use App\Models\serial;

//use inventory
use App\Models\inventory;

//use validator 
use Illuminate\Support\Facades\Validator;

//use Sessions
use Illuminate\Support\Facades\Session;

//use data Tables
use DataTables;

//use DB
use DB;

//use File
use File;

use Illuminate\Support\Facades\Auth;

class storeController extends Controller
{
    //data toko

    //view data toko
    public function data_toko()
    {
        $platform = platform::all();
        return view('/store/data_toko/data_toko', ['platform' => $platform]);
    }

    //dataTables data toko
    public function data_tokoGet()
    {
        $data1 = toko::all();
        return Datatables::of(toko::orderBy('created_at','desc'))
        ->addColumn('platform', function ($data1) {
            //view platform name
            $platform = platform::find($data1->platform_id);
            $nama_platform = $platform->nama;
            return $nama_platform;
        })
        ->addColumn('action', function ($data1)
        {
            //return action button
             return '<a href="#" id="edit_data_toko" onclick=edit_toko("'.$data1->toko_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_toko" onclick=hapus_toko("'.$data1->toko_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
        })
        ->addColumn('logo', function ($data1)
        {
            //return logo
            return '<img src="/img/data_toko/'.$data1->logo.'" width="100px" class="img-fluid" alt="Responsive image">';
        })
        ->editcolumn('jumlah_transaksi', function ($data1)
        {
            //return jumlah transaksi
            $transaksi = transaksi::where('toko_id', $data1->toko_id)->count();
            return $transaksi;
        })
        ->rawColumns(['action','jumlah transaksi','platform','logo'])
        ->make(true);
    }

    //store data toko
    public function data_tokoTambah(Request $request)
    {
        //valadator
        $validasi = Validator::make($request->all(),[
            'platform_id' => 'required',
            'nama_toko' => 'required',
            'alamat' => 'required',
            'logo' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        //check validasi
        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('logo');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
        // isi dengan nama folder tempat kemana file diupload
        $request->logo->move(public_path('img/data_toko'), $nama_file);
 
        //id dengan uniqid
        $id = uniqid();

        //store data
		toko::create([
            'toko_id' => $id,
            'platform_id' => $request->platform_id,
            'nama_toko' => $request->nama_toko,
            'alamat' => $request->alamat,
			'logo' => $nama_file,
		]);
 
        //response
		return response()->json(array('res' => 'berhasil'));

    }

    //return data edit
    public function data_tokoEditGet(Request $request)
    {
        //menyimpan id variable
        $id = $request->id;
        //menyimpan hasil query ke variable
        $data = toko::find($id);
        //response dengan data
        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    //edit store
    public function data_tokoEditStore(Request $request)
    {
        //valadator
        $validasi = Validator::make($request->all(),[
            'platform_id' => 'required',
            'nama_toko' => 'required',
            'alamat' => 'required',
            'logo' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        //simpan id ke variabel
        $id = $request->id;

        //query data toko
        $data = toko::find($id);

        //ambil nama logo lama
        $nama_img = $data->logo;

        //hapus logo lama
        File::delete(public_path('img/data_toko/'.$nama_img));

        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('logo');
 
		$nama_file = time()."_".$file->getClientOriginalName();

        //update
        $data->nama_toko = $request->nama_toko;
        $data->alamat = $request->alamat;
        $data->logo = $nama_file;
        $data->platform_id = $request->platform_id;
        $data->save();
 
        // isi dengan nama folder tempat kemana file diupload
        $request->logo->move(public_path('img/data_toko/'), $nama_file);
		
 
		return response()->json(array('res' => 'berhasil'));
    }

    //delete data
    public function data_tokoHapus(Request $request)
    {
        $id = $request->id;
        $data = toko::find($id);
        $data->delete();
        return response()->json(array('res' => 'berhasil'));
    }

    //PLATFORM
    
    //view platform
    public function platform()
    {
        return view('/store/platform/platform');
    }

    //platform datatables
    public function platformGet()
    {
        $data1 = platform::all();
        return Datatables::of(platform::orderBy('created_at','desc'))
        ->addColumn('action', function ($data1)
        {
            //return action button
             return '<a href="#" id="edit_data_platform" onclick=edit_data_platform("'.$data1->platform_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_data_platform" onclick=hapus_data_platform("'.$data1->platform_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
        })
        ->addColumn('logo', function ($data1)
        {
            //return logo
            return '<img src="/img/platform/'.$data1->logo.'" width="100px" class="img-fluid" alt="Responsive image">';
        })
        ->rawColumns(['action','platform','logo'])
        ->make(true);        
    }

    //platform tambah
    public function platformTambah(Request $request)
    {
         //valadator
         $validasi = Validator::make($request->all(),[
            'nama' => 'required',
            'logo' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('logo');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
        // isi dengan nama folder tempat kemana file diupload
        $request->logo->move(public_path('img/platform'), $nama_file);
 
        $id = uniqid();
		platform::create([
            'platform_id' => $id,
            'nama' => $request->nama,
			'logo' => $nama_file,
		]);
 
		return response()->json(array('res' => 'berhasil'));
    }

    public function platformEditGet(Request $request)
    {
        $id = $request->id;
        $platform = platform::find($id);
        return response()->json(array('res' => 'berhasil',  'data' => $platform));
    }


    //platform edit store
    public function platformEditStore(Request $request)
    {
        //valadator
        $validasi = Validator::make($request->all(),[
            'nama' => 'required',
            'logo' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        $id = $request->id;
        $platform = platform::find($id);
        $nama_img = $platform->logo;
        File::delete(public_path('img/platform/'.$nama_img));

        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('logo');
 
		$nama_file = time()."_".$file->getClientOriginalName();
        $platform->nama = $request->nama;
        $platform->logo = $nama_file;
        $platform->save();
 
        // isi dengan nama folder tempat kemana file diupload
        $request->logo->move(public_path('img/platform'), $nama_file);
 
		return response()->json(array('res' => 'berhasil'));
    }

    //hapus platform
    public function platformHapus(Request $request)
    {
        $id = $request->id;
        $platform = platform::find($id);
        $nama_img = $platform->logo;
        File::delete(public_path('img/platform/'.$nama_img));
        $platform->delete();
        return response()->json(array('res' => 'berhasil'));
    }

    //TRANSAKSI

    //view transaksi blade
    public function transaksi()
    {
        //get toko data
        $toko = DB::table('toko')
                ->join('platform', 'toko.platform_id', '=', 'platform.platform_id')
                ->get();
        return view('/store/transaksi/transaksi', ['toko' => $toko]);
    }

    //get transaksi
    public function transaksiGet()
    {
        $data1 = transaksi::all();
        return Datatables::of(transaksi::orderBy('created_at','desc'))
        ->addColumn('toko', function ($data1){
            $toko = toko::find($data1->toko_id);
            return $toko->nama_toko;
        })
        ->addColumn('action', function ($data1)
        {
            //return action button
             return '<a href="#" id="edit_transaksi" onclick=edit_transaksi("'.$data1->transaksi_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_transaksi" onclick=hapus_transaksi("'.$data1->transaksi_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
        })
        ->addColumn('detail', function ($data1)
        {
            //return detail button
            return '<a href="#" id="detail_transaksi" onclick=detail_transaksi("'.$data1->transaksi_id.'") class="btn btn-sm btn-info"><i class="glyphicon glyphicon-eye-open"></i></a>';
        })
        ->rawColumns(['action','detail'])
        ->make(true);     
    }

    //transaksi store
    public function transaksiTambah(Request $request)
    {
        //valadator
        $validasi = Validator::make($request->all(),[
            'no_transaksi' => 'required',
            'no_inv_platform' => 'required',
            'customer' => 'required',
            'alamat' => 'required',
            'kurir' => 'required',
            'plat_kendaraan_kurir' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        $id = uniqid();

        transaksi::create([
            'transaksi_id' => $id,
            'toko_id' => $request->toko_id,
            'no_transaksi' => $request->no_transaksi,
            'no_inv_platform' => $request->no_inv_platform,
            'customer' => $request->customer,
            'alamat' => $request->alamat,
            'kurir' => $request->kurir,
            'plat_kendaraan_kurir' => $request->plat_kendaraan_kurir,
        ]);

        return response()->json(array('res' => 'berhasil'));
    }

    //edit get transaksi
    public function transaksiEditGet(Request $request)
    {
        $id = $request->id;
        $data = transaksi::find($id);

        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    //edit store transaksi
    public function transaksiEditStore(Request $request)
    {
         //valadator
         $validasi = Validator::make($request->all(),[
            'no_transaksi' => 'required',
            'no_inv_platform' => 'required',
            'customer' => 'required',
            'alamat' => 'required',
            'kurir' => 'required',
            'plat_kendaraan_kurir' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        //menyimpan id kedalam variable
        $id = $request->id;

        $transaksi = transaksi::find($id);
        $transaksi->toko_id = $request->toko_id;
        $transaksi->no_transaksi = $request->no_transaksi;
        $transaksi->no_inv_platform = $request->no_inv_platform;
        $transaksi->customer = $request->customer;
        $transaksi->alamat = $request->alamat;
        $transaksi->kurir = $request->kurir;
        $transaksi->plat_kendaraan_kurir = $request->plat_kendaraan_kurir;
        $transaksi->save();

        return response()->json(array('res' => 'berhasil'));
    }

    //hapus transaksi
    public function transaksiHapus(Request $request)
    {
        $id = $request->id;
        $data = transaksi::find($id);
        $detail_transaksi = detail_transaksi::where('transaksi_id',$id)->get();

        foreach ($detail_transaksi as $key) {
            $detail_item = detail_transaksi::find($key->detail_transaksi_id);
            $detail_id = $detail_item->detail_transaksi_id;
            $serial = serial::where('userReq_det_id', $key->detail_transaksi_id)->get();
            foreach ($serial as $key ) {
                $item = serial::find($key->sn_id);
                $item->userReq_det_id = null;
                $item->save();
            }
            $detail_item->delete();
        }

        $data->delete();

        return response()->json(array('res' => 'berhasil'));
    }
    

    //ambil no transaksi otomatis
    public function transaksiNoOtomatis(Request $request)
    {
        $id = $request->id;
        $no = transaksi::where('toko_id',$id)->get()->count();
        $data = toko::find($id);
        return response()->json(array('res' => 'berhasil', 'data' => $data, 'no' => $no));
    }


    //ambil no transaksi keyup
    public function transaksiNoTransaksiFilter(Request $request)
    {
        $noTransaksi = $request->noTransaksi;
        $data = transaksi::where('no_transaksi',$noTransaksi)->get()->count();
        if ($data > 0) {
            return response()->json(array('res' => 'gagal'));
        } else {
            return response()->json(array('res' => 'berhasil'));
        }
    }

    //transaksi detail
    public function transaksiDetail($id)
    {
        $data = detail_transaksi::where('transaksi_id', $id)->get();
        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    //DETAIL TRANSAKSI

    //view transaksi detail
    public function detailTransaksi($id)
    {
        $barang = DB::table('inventorie')
        ->join('gudang', 'inventorie.gudang_id', '=', 'gudang.gudang_id')
        ->join('serial', 'inventorie.inventory_id', '=', 'serial.inventory_id')
        ->where('inventorie.quantity', '>', 0)
        ->where('inventorie.status','active')
        ->where('serial.userReq_det_id', null)
        ->select('inventorie.inventory_id','inventorie.nama_barang','inventorie.quantity', 'gudang.nama_gudang', DB::raw("IFNULL(count(serial.sn_id),0) as count"))
        ->groupBy('inventorie.inventory_id','inventorie.nama_barang','inventorie.quantity','gudang.nama_gudang')
        ->get();
        return view('/store/transaksi/detail_transaksi/detail_transaksi',['barang'=>$barang] ,compact('id'));
    }

    //detail transaksi dataTables
    public function detailTransaksiGet($id)
    {
        $data1 = detail_transaksi::all();
        return Datatables::of(detail_transaksi::orderBy('created_at','desc'))
        ->addColumn('gudang', function ($data1){
            $gudang = gudang::find($data1->gudang_id);
            return $gudang->nama_gudang;
        })
        ->addColumn('action', function ($data1)
        {
            //return action button
             return '<a href="#" id="hapus_transaksi" onclick=hapus_transaksi("'.$data1->transaksi_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
        })
        ->rawColumns(['action','detail'])
        ->make(true);     
    }

    //detail_transaksi tambah
    public function detailTransaksiTambah(Request $request)
    {
         //valadator
         $validasi = Validator::make($request->all(),[
            'transaksi_id' => 'required',
            'inventory_id' => 'required',
            'serial' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            Session::flash('error');
            return redirect()->back();
        }

        $id = uniqid();
        $transaksi_id = $request->transaksi_id;

        $sn = "";

        foreach ($request->serial  as $key => $value) {
            $data = serial::find($request->serial[$key]);
            $data->userReq_det_id = $id;
            $data->status = 'store';
            $sn = $sn . $data->no_serial .",";
            $data->save();
        }

        $inventory = inventory::find($request->inventory_id);
        $nama_barang = $inventory->nama_barang;
        $gudang_id = $inventory->gudang_id;

        detail_transaksi::create([
            'detail_transaksi_id' => $id,
            'transaksi_id' => $transaksi_id,
            'nama_barang' => $nama_barang,
            'type' => '',
            'qty' => $request->qty,
            'sn' => $sn,
            'gudang_id' => $gudang_id,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success');
        return redirect()->back();
    }

    //detail_transaksi hapus
    public function detailTransaksiHapus(Request $request)
    {
        $id = $request->id;
        $detail_transaksi = detail_transaksi::find($id);
        $detail_transaksi->delete();

        $serial = serial::where('userReq_det_id',$id)->get();
        foreach ($serial as $key ) {
            $serial_edit = serial::find($key->sn_id);
            $serial_edit->userReq_det_id = null;
            $serial_edit->status = null;
            $serial_edit->save();
        }

        return response()->json(array('res' => 'berhasil'));
    }

    //detail transaksi inventory
    public function detailTransaksiInventory($id)
    {
        $data = inventory::find($id);
        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    //detail transaksi serial
    public function detailTransaksiSerial($id)
    {
        $serial = serial::where('inventory.id', $id)->where('status', 'Gudang GSC')->get();
        return $serial;
    }

    //cari barang
    public function detailTransaksiCari_barang($id)
    {
        $serial = serial::where('inventory_id', $id)->where('status', 'Gudang GSC')->get();
        return response()->json(array('res' => 'berhasil', 'data' => $serial));
    }

    
}
