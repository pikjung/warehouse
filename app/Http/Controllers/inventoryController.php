<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\inventory;

use App\Models\serial;

use Illuminate\Support\Facades\Validator;

use DataTables;

use DB;

use App\Models\gudang;

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
        $gudang = gudang::all();
        return view('/inventory/inventory', ['gudang' => $gudang]);
    }

    //barang masuk
    public function barang_masukView($id)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses' ,'bagian' => 'Inventory']);
        return view('/inventory/barang_masuk', compact('id'));
    }

    public function barang_masukGet($id)
    {
        $data = inventory::where('quantity', '>','0')->where('gudang_id',$id)->orderBy('created_at','desc');

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
        ->editColumn('sn_total', function ($data) {
            $sn = serial::where('inventory_id', $data->inventory_id)->count();
            return $sn;
        })
        ->editColumn('jumlah_sn', function ($data)
        {
            $sn = serial::where('inventory_id', $data->inventory_id)->where('userReq_det_id', null)->count();
            return $sn;
        })
        ->editColumn('status', function ($data)
        {
            if ($data->status == 'active') return '<input type="checkbox" onchange=active("'.$data->inventory_id.'") checked><label>Active</label>';
            if ($data->status == 'inactive') return '<input type="checkbox" onchange=inactive("'.$data->inventory_id.'")><label>Active</label>';
        })
        ->rawColumns(['sn','action','status'])
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

        $gudang_id = $request->id;

        $id = uniqid();
        $data = inventory::create([
            'inventory_id' => $id,
            'gudang_id' => $gudang_id,
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


    public function inventoryGudangCariGudang(Request $request)
    {
        $id = $request->gudang;
        $data = inventory::where('gudang_id', $id)->get();
        $gudang = gudang::where('gudang_id','!=', $id)->get();
        return response()->json(array('res' => 'berhasil', 'data' => $data, 'gudang' => $gudang));
    }

    public function inventoryGudangCariBarang(Request $request)
    {
        $id = $request->barang;
        $data = serial::where('inventory_id', $id)->where('userReq_det_id', NULL)->get();
        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    public function inventoryGudangCariBarangDestination(Request $request)
    {
        $id = $request->barang;
        $data = inventory::where('gudang_id', $id)->get();
        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    public function inventoryTransfer(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Store' ,'bagian' => 'Transfer']);
        $validasi = Validator::make($request->all(),[
            'barang' => 'required',
            'serial' => 'required',
            'destination' => 'required',
            'destination_barang' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }
        $inventory_awal = inventory::find($request->barang);
        $inventory_qty = $inventory_awal->quantity - $request->qty;
        $inventory_qty_awal = $inventory_awal->quantity_awal - $request->qty;
        $inventory_awal->quantity = $inventory_qty;
        $inventory_awal->quantity_awal = $inventory_qty_awal;
        $inventory_awal->save();

        $inventory = inventory::find($request->destination_barang);
        $qty = $request->qty + $inventory->quantity;
        $qty_awal = $request->qty + $inventory->quantity_awal;

        $inventory->quantity = $qty;
        $inventory->quantity_awal = $qty_awal;
        $inventory->save();
        
        foreach ($request->serial  as $key => $value) {
            $data = serial::find($request->serial[$key]);
            $data->inventory_id = $request->destination_barang;
            $data->save();
        }
        
        return response()->json(array('res' => 'berhasil'));
    }

    public function inventoryTransferMake(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Store' ,'bagian' => 'Transfer']);
        $validasi = Validator::make($request->all(),[
            'barang' => 'required',
            'serial' => 'required',
            'destination' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }

        $id = uniqid();
        $inventory = inventory::find($request->barang);
        $qty = $inventory->quantity - $request->qty;
        $qty_awal = $inventory->quantity_awal - $request->qty;
        $inventory->quantity = $qty;
        $inventory->quantity_awal = $qty_awal;
        inventory::create([
            'inventory_id' => $id,
            'gudang_id' => $request->destination,
            'nama_disti' => $inventory->nama_disti,
            'tanggal' => date('Y-m-d'),
            'nama_barang' => $inventory->nama_barang,
            'spek' => $inventory->spek,
            'pn' => $inventory->pn,
            'sku' => $inventory->sku,
            'quantity' => $request->qty,
            'quantity_awal' => $request->qty,
        ]);
        $inventory->save();
        
        foreach ($request->serial  as $key => $value) {
            $data = serial::find($request->serial[$key]);
            $data->inventory_id = $id;
            $data->save();
        }
        
        return response()->json(array('res' => 'berhasil'));
    }

    public function active_data(Request $request)
    {
        $id = $request->id;
        $data = inventory::find($id);
        $data->status = 'active';
        $data->save();
        return response()->json(array('res' => 'berhasil'));
    }

    public function inactive_data(Request $request)
    {
        $id = $request->id;
        $data = inventory::find($id);
        $data->status = 'inactive';
        $data->save();
        return response()->json(array('res' => 'berhasil'));
    }
}
