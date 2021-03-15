<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use DataTables;

use App\Models\data_toko;

use App\Models\barang_toko;

use App\Models\penjualan;

use App\Models\penjualan_det;

use Illuminate\Support\Facades\Auth;

use App\Models\log;

use Illuminate\Support\Facades\Validator;

class storeController extends Controller
{
    //

    public function data_toko()
    {
        return view('/store/data_toko');
    }

    public function data_tokoGet()
    {
        $data = data_toko::select(['toko_id','nama_toko','platform_toko','alamat_toko','no_telp_toko','logo_toko']);
        return Datatables::of(data_toko::select(['toko_id','nama_toko','platform_toko','alamat_toko','no_telp_toko','logo_toko'])->orderBy('created_at','desc'))
        ->addColumn('action', function ($data)
        {
            return '<a href="#" id="edit_dataToko" onclick=edit_dataToko("'.$data->toko_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_dataToko" onclick=hapus_dataToko("'.$data->toko_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
        })
        ->editColumn('detail', function ($data)
        {
            return '<a href="#" class="btn btn-info" onclick=detail_pouser("'.$data->toko_id.'") ><span class="glyphicon glyphicon-eye-open"></span></a>';
        })
        ->rawColumns(['action','detail'])
        ->make(true);
    }

    public function data_tokoEditGet(Request $request)
    {
        $id = $request->id;
        $data = data_toko::find($id);
        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    public function data_tokoEditStore(Request $request)
    {
        //DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tambah' ,'bagian' => 'Inventory']);
        $validasi = Validator::make($request->all(),[
            'nama_toko' => 'required',
            'platform_toko' => 'required',
            'no_telp_toko' => 'required',
            'alamat_toko' => 'required',
            'logo_toko' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        $file  = $request->file('logo_toko');
        $path = '/img/logo_toko';
        $nama_file = time()."_".$file->getClientOriginalExtension();
		$file->move($path,$nama_file);

        $id = $request->id;
        $data = data_toko::find($id);
        $data->nama_toko = $request->nama_toko;
        $data->platform_toko = $request->platform_toko;
        $data->no_telp_toko = $request->no_telp_toko;
        $data->alamat_toko = $request->alamat_toko;
        $data->logo_toko = $file->getClientOriginalExtension();
        $data->save();

        return response()->json(array('res' => 'berhasil'));
    }

    public function data_tokoTambah(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'nama_toko' => 'required',
            'platform_toko' => 'required',
            'no_telp_toko' => 'required',
            'alamat_toko' => 'required',
            'logo_toko' => 'required'
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        $file  = $request->file('logo_toko');
        $path = '/img/logo_toko';
        $nama_file = time()."_".$file->getClientOriginalExtension();
		$file->move($path,$nama_file);

        $id = uniqid();
        $data = data_toko::create([
            'toko_id' => $id,
            'nama_toko' => $request->nama_toko,
            'platform_toko' => $request->platform_toko,
            'no_telp_toko' => $request->no_telp_toko,
            'alamat_toko' => $request->alamat_toko,
            'logo_toko' => $nama_file, 
        ]);

        return response()->json(array('res' => 'berhasil'));
    }

    public function data_tokoDetail($id)
    {
        $data = penjualan::where('toko_id', $id)->get();

        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    public function data_tokoHapus(Request $request)
    {
        $id = $request->id;
        $data = data_toko::find($id);
        $data->delete();
        return response()->json(array('res' => 'berhasil'));
    }
}
