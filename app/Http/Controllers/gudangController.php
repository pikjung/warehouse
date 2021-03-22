<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\gudang;

use Illuminate\Support\Facades\Auth;

use App\Models\log;

use Illuminate\Support\Facades\Validator;

use DataTables;

use DB;

class gudangController extends Controller
{
    //

    public function gudang()
    {
        return view('/gudang/gudang');
    }

    public function gudangView()
    {
        $data = gudang::orderBy('created_at','desc')->get();
        return Datatables::of(gudang::orderBy('created_at','desc'))
        ->addColumn('action', function ($data)
        {
            return '<a href="#" id="edit_gudang" onclick=edit_gudang("'.$data->gudang_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_gudang" onclick=hapus_gudang("'.$data->gudang_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
            
        })
        ->make(true);
    }

    public function gudangTambah(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'nama_gudang' => 'required',
            'alamat_gudang' => 'required'
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        $id = uniqid();

        gudang::create([
            'gudang_id' => $id,
            'nama_gudang' => $request->nama_gudang,
            'alamat_gudang' => $request->alamat_gudang,
        ]);

        return response()->json(array('res' => 'berhasil'));
    }
}
