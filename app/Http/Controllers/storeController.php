<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use toko model
use App\Models\toko;

//use platform model
use App\Models\platform;

//use transaksi model;
use  App\Models\transaksi;

//use transaksi_detail model;
use App\Models\detail_transaksi;

//use validator 
use Illuminate\Support\Facades\Validator;

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
        $platform = platform::all();
        $toko = toko::all();

        return view('/store/transaksi/transaksi', ['platform' => $platform, 'toko' => $toko]);
    }

    //get transaksi
    public function transaksiGet()
    {
        $data1 = toko::all();
        return Datatables::of(toko::orderBy('created_at','desc'))
        ->addColumn('action', function ($data1)
        {
            //return action button
             return '<a href="#" id="edit_transaksi" onclick=edit_transaksi("'.$data1->toko_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_transaksi" onclick=hapus_transaksi("'.$data1->toko_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
        })
        ->addColumn('detail', function ($data1)
        {
            //return detail button
            return '<a href="#" id="detail_transaksi" onclick=detail_transaksi("'.$data1->toko_id.'") class="btn btn-sm btn-info"><i class="glyphicon glyphicon-eye-open"></i></a>';
        })
        ->rawColumns(['action','detail'])
        ->make(true);     
    }
}
