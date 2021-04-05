<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\data_toko;

class storeController extends Controller
{
    //data toko

    //view data toko
    public function data_toko()
    {
        return view('/store/data_toko/data_toko');
    }

    //dataTables data toko
    public function data_tokoView()
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
}
