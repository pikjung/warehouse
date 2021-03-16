<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\inventory;

use App\Models\serial;

use Illuminate\Support\Facades\Validator;

use DataTables;

use DB;

use Illuminate\Support\Facades\Auth;

use App\Models\log;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Input;

use App\Imports\SerialImport;

class inventoryController extends Controller
{

    //gudang
    public function inventory()
    {
        return view('/inventory/inventory');
    }

    //barang masuk
    public function barang_masukView($id)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses' ,'bagian' => 'Inventory']);
        return view('/inventory/barang_masuk', compact('id'));
    }

    public function barang_masukGet($id)
    {
        $data = inventory::where('quantity', '>','0')->orderBy('created_at','desc');

        return Datatables::of($data)
        ->addColumn('action', function ($data)
        {
            if ($data->nama_disti == 'Gudang GSC') return '<a href="#" id="edit_inventory" onclick=edit_inventory("'.$data->inventory_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_inventory" onclick=hapus_inventory("'.$data->inventory_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
            if ($data->nama_disti != 'gudang') return '<span class="badge badge-info">Dari Disti</span>';
        })
        ->editColumn('sn', function ($data)
        {
            return '<a href="#" id="sn_detail" onclick=sn_detail("'.$data->inventory_id.'") class="btn btn-sm btn-secondary"><i class="glyphicon glyphicon-eye-open"></i></a>';
        })
        ->rawColumns(['sn','action'])
        ->editColumn('inventory_id','{{$inventory_id}}')
        ->make(true);
    }

    public function barang_masukTambah(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tambah' ,'bagian' => 'Inventory']);
        $validasi = Validator::make($request->all(),[
            'nama_barang' => 'required',
            'spek' => 'required',
            'quantity' => 'required'
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        $id = uniqid();
        $data = inventory::create([
            'inventory_id' => $id,
            'nama_disti' => 'Gudang GSC',
            'tanggal' => date('Y-m-d'),
            'nama_barang' => $request->nama_barang,
            'spek' => $request->spek,
            'quantity' => $request->quantity,
            'quantity_awal' => $request->quantity,
        ]);

        return response()->json(array('res' => 'berhasil'));
    }

    public function barang_masukEditGet(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tampil Edit' ,'bagian' => 'Inventory']);
        $id = $request->id;

        $data = inventory::find($id);

        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    public function barang_masukEditStore(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Edit' ,'bagian' => 'Inventory']);
        $validasi = Validator::make($request->all(),[
            'nama_barang' => 'required',
            'spek' => 'required',
            'quantity' => 'required'
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        $data = inventory::find($request->id);
        $data->nama_barang = $request->nama_barang;
        $data->spek = $request->spek;
        $data->quantity = $request->quantity;
        $data->save();
        
        return response()->json(array('res' => 'berhasil'));
    }

    public function barang_masukSn_view(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tampil SN' ,'bagian' => 'Inventory']);
        $id = $request->id;
        $data = serial::where('inventory_id',$id)->get();

        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    public function barang_masukHapus(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Hapus' ,'bagian' => 'Inventory']);
        $id = $request->id;
        $data = inventory::find($id);
        $data->delete();

        return response()->json(array('res' => 'berhasil'));
    }

    public function snMode($id)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses SN' ,'bagian' => 'Inventory']);
        $data = inventory::find($id);
        $sn = serial::where('inventory_id',$id)->get()->count();
        $sn_tersisa = serial::where('inventory_id',$id)->whereNotNull('userReq_det_id')->get()->count();
        return view('/inventory/snMode',['inventory' => $data,'sn' => $sn, 'sn_tersisa' => $sn_tersisa],compact('id'));
    }

    public function snModeGet($id)
    {
        $data = serial::select(['sn_id','no_serial','barang_keluar_id','customer','status']);
        return Datatables::of(serial::where('inventory_id',$id))
        ->addColumn('action', function ($data)
        {
            if ($data->status == 'Gudang GSC') return '<a href="#" id="edit_serial" onclick=edit_serial("'.$data->sn_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_serial" onclick=hapus_serial("'.$data->sn_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
            if ($data->status != 'po') return '<span class="badge badge-info">Telah masuk Paket</span>';
        })
        ->editColumn('sn_id','{{$sn_id}}')
        ->make(true);
    }

    public function snStore(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tambah SN' ,'bagian' => 'Inventory']);
        $inventory_id = $request->inventory_id;
        $validasi = Validator::make($request->all(),[
            'serialName' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back();
        }
        foreach ($request->serialName  as $key => $value) {
            $id = uniqid();
            serial::create([
                'sn_id' => $id,
                'inventory_id' => $inventory_id,
                'no_serial' => $request->serialName[$key],
                'status' => 'Gudang GSC',
            ]);
        }

        return redirect()->back();
    }

    public function snEdit(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tampil Edit' ,'bagian' => 'Inventory']);
        $id = $request->id;
        $data = serial::find($id);
        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    public function snUpdate(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Edit SN' ,'bagian' => 'Inventory']);
        $id = $request->id;
        $sn = $request->no_serial;

        $data = serial::find($id);
        $data->no_serial = $sn;
        $data->save();

        return response()->json(array('res' => 'berhasil'));
    }

    public function snHapus(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Hapus SN' ,'bagian' => 'Inventory']);
        $id = $request->id;
        $data = serial::find($id);
        $data->delete();

        return response()->json(array('res' => 'berhasil'));
    }

    public function snImport(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Import SN' ,'bagian' => 'Inventory']);
        $data = Excel::import(new SerialImport($request->id), request()->file('file'));
        if ($data) {
            return response()->json(array('res' => 'berhasil'));
        }
    }
}
