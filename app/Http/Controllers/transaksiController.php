<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\distributor;

use App\Models\pogsc;

use App\Models\serial;

use App\Models\pogsc_det;

use App\Models\inventory;

use App\Models\pouser;

use App\Models\pouser_det;

use App\Models\paket;

use App\Models\customer;

use Illuminate\Support\Facades\Validator;

use DataTables;

use Illuminate\Support\Facades\Auth;

use App\Models\log;

use DB;

use App\Models\invoice;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Input;

use App\Imports\GetSerialImport;

class transaksiController extends Controller
{
    //

    public function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "SATU", "DUA", "TIGA", "EMPAT", "LIMA", "ENAM", "TUJUH", "DELAPAN", "SEMBILAN", "SEPULUH", "SEBELAS");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->penyebut($nilai - 10). " BELAS";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai/10)." PULUH". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " SERATUS" . $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai/100) . " RATUS" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " SERIBU" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai/1000) . " RIBU" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai/1000000) . " JUTA" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai/1000000000) . " MILYAR" . $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai/1000000000000) . " TRILYUN" . $this->penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	public function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}     		
		return $hasil;
	}

    public function rupiah($angka)
    {
        $hasil_rupiah =  number_format($angka);
	    return $hasil_rupiah;
    }

    public function pouser()
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses' ,'bagian' => 'PO USER']);
        $data = customer::all();
        return view('/transaksi/pouser', compact('data'));
    }

    public function pouserView()
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses' ,'bagian' => 'PO USER']);
        $data = pouser::select(['userReq_id','po_customer','tanggal','status','no_telp','lokasi','no_invoice','noted'])->where('status','!=','Arsip');
        return Datatables::of(pouser::orderBy('created_at','desc')->where('status','!=','Arsip'))
        ->addColumn('action', function ($data)
        {
            if ($data->status == 'po') return '<a href="#" id="edit_pouser" onclick=edit_pouser("'.$data->userReq_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_pouser" onclick=hapus_pouser("'.$data->userReq_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a><button class="btn btn-sm btn-success " onclick=data_inv("'.$data->userReq_id.'")><span class="glyphicon glyphicon-plus"></span>Invoice</button>';
            if ($data->status == 'Terkirim') return '<a href="#" onclick=lihat_paket("'.$data->paket_id.'") class="btn btn-sm btn-info" >Lihat Paket</a><button class="btn btn-sm btn-success " onclick=data_inv("'.$data->userReq_id.'")><span class="glyphicon glyphicon-plus"></span>Invoice</button><button onclick=payment_pouser("'.$data->userReq_id.'") class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-usd"></span> Payment</button>';
            if ($data->status == 'Payment') return '<a href="#" onclick=lihat_paket("'.$data->paket_id.'") class="btn btn-sm btn-info" >Lihat Paket</a><button class="btn  btn-sm btn-warning" onclick=arsip_pouser("'.$data->userReq_id.'")><span class="glyphicon glyphicon-file"></span>Arsip</button>';
        })
        ->editColumn('detail', function ($data)
        {
            return '<a href="#" class="btn btn-info" onclick=detail_pouser("'.$data->userReq_id.'") ><span class="glyphicon glyphicon-eye-open"></span></a>';
        })
        ->editColumn('status',function ($data)
        {
            if ($data->status == 'Terkirim') return '<span class="badge badge-info">Terkirim</span>';
            if ($data->status == 'po') return '<span class="badge badge-secondary">PO</span>';
            if ($data->status == 'Payment') return '<span class="badge badge-primary">Payment</span>';
        })
        ->editColumn('print', function ($data)
        {
            if ($data->no_invoice == null) return '<button class="btn btn-sm btn-success" onclick=print_dn("'.$data->userReq_id.'")><span class="glyphicon glyphicon-print"></span>DN</button>'; 
            if (!empty($data->no_invoice)) return '<button class="btn btn-sm btn-success" onclick=print_invoice("'.$data->userReq_id.'")><span class="glyphicon glyphicon-print"></span>INV</button> <button class="btn btn-sm btn-success" onclick=print_dn("'.$data->userReq_id.'")><span class="glyphicon glyphicon-print"></span>DN</button>'; 
            
        })
        ->rawColumns(['action','detail','status','print'])
        ->make(true);
    }

    public function pouserTambah(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tambah' ,'bagian' => 'PO USER']);
        $validasi = Validator::make($request->all(),[
            'nama_customer' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'no_po' => 'required',
            'to_name' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json(array('res' => 'gagal'));
        }
        $id = uniqid();
        $customer_id = $request->nama_customer;
        $customer_data = customer::find($customer_id);
        $nama_customer = $customer_data->nama_customers;

        $data = pouser::create([
            'userReq_id' => $id,
            'customer_id' => $request->nama_customer,
            'po_customer' => $request->no_po,
            'dn_no' => $request->dn_no,
            'tanggal' => date('Y-m-d'),
            'status' => 'po',
            'customer' => $nama_customer,
            'penerima' => $request->to_name,
            'no_telp' => $request->no_telp,
            'fax' => $request->fax,
            'alamat' => $request->alamat,
            'payment_terms' => $request->payment_terms,
            'noted' => $request->noted
        ]);

        return response()->json(array('res' => 'berhasil'));
    }

    public function pouserEditGet(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tampil Edit' ,'bagian' => 'PO USER']);
        $id = $request->id;

        $data = pouser::find($id);
        $customer_id = $data->customer_id;

        return response()->json(array('res' => 'berhasil', 'data' => $data, 'customer_id' => $customer_id));
    }

    public function pouserEditStore(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Edit' ,'bagian' => 'PO USER']);
        $validasi = Validator::make($request->all(),[
            'nama_customer' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'no_po' => 'required',
            'to_name' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json(array('res' => 'gagal'));
        }

        $id = $request->id;

        $data = pouser::find($id);
        $customer = customer::find($request->nama_customer);
        $nama_customer = $customer->nama_customers;

        $data->customer_id = $request->nama_customer;
        $data->customer = $nama_customer;
        $data->dn_no = $request->dn_no;
        $data->po_customer = $request->no_po;
        $data->penerima = $request->to_name;
        $data->payment_terms = $request->payment_terms;
        $data->no_telp = $request->no_telp;
        $data->fax = $request->fax;
        $data->alamat = $request->alamat;
        $data->noted = $request->noted;
        $data->save();

        return response()->json(array('res' => 'berhasil'));

    }

    public function pouserInv(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tambah Invoice' ,'bagian' => 'PO USER']);
        $validasi = Validator::make($request->all(),[
            'inv_po' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json(array('res' => 'gagal'));
        }

        $data = pouser::find($request->id);
        $data->no_invoice = $request->inv_po;
        $data->disc = $request->disc;
        $data->tgl_inv = date('Y-m-d');
        $data->save();

        return response()->json(array('res' => 'berhasil'));
    }

    public function pouserHapus(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Hapus' ,'bagian' => 'PO USER']);
        $id = $request->id;

        $data = pouser::find($id);

        $po_det = pouser_det::where('userReq_id',$id)->get();
        foreach ($po_det as $k) {
            $userReq_det_id = $k->userReq_det_id;
            $serial = serial::where('userReq_det_id',$userReq_det_id)->get();
            foreach ($serial as $p) {
                $p->userReq_det_id = null;
                $p->status = 'Gudang GSC';
                $p->save();
            }
        }
        $pouser_del = pouser_det::where('userReq_id',$id)->delete();
        
        $data->delete();

        return response()->json(array('res' => 'berhasil'));
    }

    public function pouserDetail(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tampil Detail' ,'bagian' => 'PO USER']);
        $id = $request->id;
        $data = pouser_det::where('userReq_id',$id)->get();
        $status = pouser::find($id);

        return response()->json(array('res' => 'berhasil', 'data' => $data, 'status' => $status->status));
    }

    public function detailMode($id)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses Detail' ,'bagian' => 'PO USER']);
        $barang = DB::table('gudang')
                    ->join('inventorie', 'gudang.gudang_id', '=', 'inventorie.gudang_id')
                    ->select('gudang.*', 'inventorie.*')
                    ->orderBy('inventorie.created_at','desc')
                    ->get();
        $pouser = pouser::find($id);
        $status = $pouser->status;
        return view('/transaksi/detailMode', ['pouser' => $pouser, 'barang' => $barang], compact(['id','status']));
    }

    public function detailModeView($id)
    {
        $pouser = pouser::find($id);
        $status = $pouser->status;
        $data = pouser::select(['userReq_det_id','userReq_id','nama_barang','spek','quantity','harga_barang_satuan']);
        return Datatables::of(pouser_det::orderBy('created_at','desc')->where('userReq_id', $id))
        ->addColumn('action', function ($data) use ($status)
        {
            if ($status == 'po') return '<a href="#" id="edit_pouser_det" onclick=edit_pouser_det("'.$data->userReq_det_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_pouser_det" onclick=hapus_pouser_det("'.$data->userReq_det_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
            if ($status != 'po') return '<span class="badge badge-info">Tidak bisa di ubah</span>';
            
        })
        ->editColumn('detail', function ($data)
        {
            return '<a href="#" class="btn btn-info" onclick=serial_pouser("'.$data->userReq_det_id.'") ><span class="glyphicon glyphicon-eye-open"></span></a>';
        })
        ->editColumn('total', function ($data)
        {
            return $this->rupiah($data->harga_barang_satuan * $data->quantity);
        })
        ->editColumn('userReq_det_id','{{$userReq_det_id}}')
        ->rawColumns(['action','detail'])
        ->make(true);
    }

    public function detailModeTambah(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tambah Detail' ,'bagian' => 'PO USER']);
        $id = $request->id;
        $pouser = pouser::find($id);
        if ($pouser->status != 'po') {
            return response()->json(array('res' => 'gagal'));
        }
        $validasi = Validator::make($request->all(),[
            'nama_barang' => 'required',
            'spek' => 'required',
            'quantity' => 'required',
            'harga_barang' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json(array('res' => 'gagal'));
        }

        $id_det = uniqid();

        $data = pouser_det::create([
            'userReq_det_id' => $id_det,
            'userReq_id' => $id,
            'nama_barang' => $request->nama_barang,
            'spek' => $request->spek,
            'pn' => $request->pn,
            'sku' => $request->sku,
            'quantity' => $request->quantity,
            'harga_barang_satuan' => $request->harga_barang,
        ]);

        return response()->json(array('res' => 'berhasil'));
    }

    public function detailModeEditGet(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tampil Edit Detail' ,'bagian' => 'PO USER']);
        $id = $request->id;

        $data = pouser_det::find($id);

        return response()->json(array('res' => 'berhasil' , 'data' => $data));
    }

    public function detailModeEditStore(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Edit Detail' ,'bagian' => 'PO USER']);
        $id = $request->id;

        $data = pouser_det::find($id);

        $data->nama_barang = $request->nama_barang;
        $data->spek = $request->spek;
        $data->pn = $request->pn;
        $data->sku = $request->sku;
        $data->quantity = $request->quantity;
        $data->harga_barang_satuan = $request->harga_barang;
        $data->save();

        return response()->json(array('res' => 'berhasil'));
    }

    public function detailModeHapus(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Hapus Detail' ,'bagian' => 'PO USER']);
        $id = $request->id;

        $data = pouser_det::find($id);
        $data->delete();

        return response()->json(array('res' => 'berhasil'));
    }

    public function detailAutofillCom(Request $request)
    {
        $pilih_barang = $request->pilih_barang;
        $data = inventory::find($pilih_barang);
        return response()->json($data);
    }

    public function detailModeSerialView(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tampil SN' ,'bagian' => 'PO USER']);
        $id = $request->id;

        $serial = serial::where('userReq_det_id',$id)->get();
        return response()->json(array('res' => 'berhasil', 'data' => $serial));
    }

    public function detailModeSerial($id,$status)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses Serial' ,'bagian' => 'PO USER']);
        $data = pouser_det::find($id);
        $sn = serial::where('userReq_det_id',$id)->get()->count();
        return view('/transaksi/detailSerial', ['data' => $data, 'sn' => $sn, 'id' => $id], compact(['id','status']));
    }

    public function detailModeSerialGet($id,$status)
    {
        $data = serial::select(['sn_id','no_serial','barang_keluar_id','customer','status']);
        return Datatables::of(serial::where('userReq_det_id',$id))
        ->addColumn('action', function ($data) use ($status)
        {
            if ($status == 'po') return '<a href="#" id="hapus_serial" onclick=hapus_serial("'.$data->sn_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
            if ($status != 'po') return '<span class="badge badge-info">Terkirim</span>';
        })
        ->editColumn('sn_id','{{$sn_id}}')
        ->make(true);
    }

    public function detailModeSerialAdd(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tambah SN' ,'bagian' => 'PO USER']);
        $sn = $request->sn;
        $serial = serial::where('no_serial',$sn)
        ->where('userReq_det_id', null)
        ->first();
        if ($serial === null) {
            return response()->json(array('res' => 'gagal'));
        } else {
            return response()->json(array('res' => 'berhasil', 'sn' => $serial));
        }
    }

    public function detailModeInventorySelect(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('inventorie')
                        ->join('gudang', 'inventorie.gudang_id', '=', 'gudang.gudang_id')
                        ->join('serial', 'inventorie.inventory_id', '=', 'serial.inventory_id')
                        ->where('inventorie.nama_barang', 'LIKE', '%'.$cari.'%')
                        ->where('inventorie.quantity', '>', 0)
                        ->where('inventorie.status','active')
                        ->where('serial.userReq_det_id', null)
                        ->select('inventorie.inventory_id','inventorie.nama_barang','inventorie.quantity', 'gudang.nama_gudang', DB::raw("IFNULL(count(serial.sn_id),0) as count"))
                        ->groupBy('inventorie.inventory_id','inventorie.nama_barang','inventorie.quantity','gudang.nama_gudang')
                        ->get();
            if ($data->count() < 1) {
                $serial = DB::table('serial')
                ->join('inventorie', 'serial.inventory_id', '=', 'inventorie.inventory_id')
                ->select('serial.*', 'inventorie.inventory_id','inventorie.nama_barang','inventorie.quantity')
                ->where('serial.no_serial', 'LIKE', '%'.$cari.'%')
                ->where('serial.userReq_det_id', null)
                ->where('inventorie.quantity','>',0)
                ->get(); 
                return response()->json($serial);
            } else {
                return response()->json($data);
            }
            
        }
    }

    public function detailModeInventorySerial(Request $request)
    {
        $id = $request->id;
        $max_qty = $request->max_qty;
        $serial = serial::where('inventory_id',$id)->where('status','Gudang GSC')->get();
        return response()->json(array('res' => 'berhasil', 'data' => $serial, 'max_qty' => $max_qty));
    }

    public function detailModeInventorySerialsnStore(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tambah SN Inventory' ,'bagian' => 'PO USER']);
        $userReq_det_id = $request->userReq_det_id;
        $validasi = Validator::make($request->all(),[
            'no_serial' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back();
        }
        foreach ($request->no_serial  as $key => $value) {
            $data = serial::find($request->no_serial[$key]);
            $data->userReq_det_id = $userReq_det_id;
            $data->status = 'po';
            $data->save();
        }
        return redirect()->back();
    }

    public function detailModeSnHapus(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Hapus SN' ,'bagian' => 'PO USER']);
        $id = $request->id;
        $data = serial::find($id);
        $data->userReq_det_id = null;
        $data->status = 'Gudang GSC';
        $data->save();
        return response()->json(array('res' => 'berhasil'));
    }

    public function pouserPrint_dn($id)
    {
        $data = pouser::find($id);
        $det = pouser_det::where('userReq_id',$id)->get();
        $rows = pouser_det::where('userReq_id',$id)->get()->count();
        return view('/transaksi/print_dn',['pouser' => $data, 'det' => $det], compact(['rows']));
    }

    public function pouserPrint_invoice($id)
    {
        $data = pouser::find($id);
        $customer_id = $data->customer_id;
        $customer = customer::find($customer_id);
        $det = pouser_det::where('userReq_id',$id)->get();

        return view('/transaksi/print_invoice',['pouser' => $data, 'det' => $det, 'customer' => $customer]);
    }

    public function panggil_serial($id)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'View Serial' ,'bagian' => 'PO USER']);
        $serial = serial::where('userReq_det_id',$id)->get();
        $data ="";
        foreach ($serial as $key) {
            $data = $data. $key->no_serial ."; ";
        }
        return $data;
    }

    public function compareSerial(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Import Compare SN' ,'bagian' => 'PO USER']);
        $validasi = Validator::make($request->all(),[
            'file' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json(array('res' => 'gagal'));
        } 
        else 
        {
            $sn = serial::all();
            $row = array();
            $validCount = 0;
            $invalidCount = 0;
            $count = 0;
            $array = (new GetSerialImport)->toArray($request->file);
            foreach ($array as $key => $value) {
                foreach ($value as $key) {
                    if (serial::where('no_serial',$key[0])->where('status','Gudang GSC')->count() > 0) {
                        $row[] = ['serial' => $key[0], 'status' => 'Valid'];
                        $validCount +=1;
                        $count +=1;
                    } else {
                        $row[] = ['serial' => $key[0], 'status' => 'Invalid'];
                        $invalidCount +=1;
                        $count +=1;
                    }
                }
            }
            $rowJson = json_encode($row);
            return response()->json(array('res' => 'berhasil', 'data' => $rowJson, 'valid' => $validCount, 'invalid' => $invalidCount, 'count' =>  $count));
        } 

    }

    public function compareSerialSave(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Import Compare Save' ,'bagian' => 'PO USER']);
        $validasi = Validator::make($request->all(),[
            'file' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json(array('res' => 'gagal'));
        } 
        else 
        {
            $sn = serial::all();
            $row = array();
            $validCount = 0;
            $invalidCount = 0;
            $count = 0;
            $array = (new GetSerialImport)->toArray($request->file);
            foreach ($array as $key => $value) {
                foreach ($value as $key) {
                    $data = serial::where('no_serial',$key[0])->first();
                    $data->userReq_det_id = $request->userReq_det_id;
                    $data->status = 'po';
                    $data->save();
                }
            }
            return response()->json(array('res' => 'berhasil'));
        } 

    }

    public function pouserLihat_paket(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Lihat Paket' ,'bagian' => 'PO USER']);
        $id = $request->id;
        $paket = paket::find($id);
        $html ='';
        $pouser = pouser::where('paket_id',$id)->get();
        foreach($pouser as $key) {
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
        $tag = "
            <div class='col-12'>
                <table>
                    <tr>
                        <td>Nama Paket </td>
                        <td>: ".$paket->nama_paket."</td>
                    </tr>
                    <tr>
                        <td>No Resi </td>
                        <td>: ".$paket->no_resi."</td>
                    </tr>
                    <tr>
                        <td>Tanggal Kirim </td>
                        <td>: ".$paket->tgl_kirim."</td>
                    </tr>
                </table>
                
            </div>
            <div class='col-12'>
            <br>
            <br>
            </div>
            ".$html."
        ";

        return response()->json(array('res' => 'berhasil', 'data' => $tag));
    }

    public function pouserPayment(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Payment' ,'bagian' => 'PO USER']);
        $id = $request->id;
        $data = pouser::find($id);
        $data->status = "Payment";
        $data->tgl_payment = date('Y-m-d');
        $data->save();

        return response()->json(array('res' => 'berhasil'));
    }

    public function pouserArsip(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Arsip' ,'bagian' => 'PO USER']);
        $id = $request->id;
        $data = pouser::find($id);
        $data->status = "Arsip";
        $data->save();

        return response()->json(array('res' => 'berhasil'));
    }

    public function arsip()
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses Arsip' ,'bagian' => 'PO USER']);
        return view('/transaksi/arsip');
    }

    public function arsipView()
    {
        $data = pouser::select(['userReq_id','po_customer','tanggal','status','no_telp','lokasi','no_invoice','noted'])->where('status','=','Arsip');
        return Datatables::of(pouser::orderBy('created_at','desc')->where('status','=','Arsip'))
        ->editColumn('detail', function ($data)
        {
            return '<a href="#" onclick=lihat_paket("'.$data->userReq_id.'") class="btn btn-sm btn-info" >Lihat Paket</a>';
        })
        ->editColumn('status',function ($data)
        {
            if ($data->status == 'Arsip') return '<span class="badge badge-warning">Arsip</span>';

        })
        ->editColumn('print', function ($data)
        {
            if (!empty($data->no_invoice)) return '<button class="btn btn-sm btn-success" onclick=print_invoice("'.$data->userReq_id.'")><span class="glyphicon glyphicon-print"></span>INV</button> <button class="btn btn-sm btn-success" onclick=print_dn("'.$data->userReq_id.'")><span class="glyphicon glyphicon-print"></span>DN</button>'; 
            
        })
        ->rawColumns(['action','detail','status','print'])
        ->make(true);
    }
    
    public function arsipLihat_paket(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Lihat Paket Arsip' ,'bagian' => 'PO USER']);
        $id = $request->id;
        $pouser = pouser::find($id);
        $html ='';
        $tr = '';
        $det = pouser_det::where('userReq_id',$id)->get();
        foreach ($det as $by ) {
            $sn = '';
            $serial = serial::where('userReq_det_id',$by->userReq_det_id)->get();
            foreach ($serial as $key ) {
                $sn = $sn . $key->no_serial. ",";
            }
            $tr = $tr. "<tr>
                <td>".$by->nama_barang."</td>
                <td>".$by->quantity."</td>
                <td><textarea cols='20' rows='5' readonly class='form-control'>".$sn."</textarea></td>
            </tr>";
        }
        
            $html = $html . "<div class='col-12'>
            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>QTY</th>
                        <th>SN</th>
                    </tr>
                </thead>
                <tbody>
                ".$tr."
                </tbody>
            </table>
        </div>";
        
        $tag = "
            <div class='col-6'>
                <b> PO Customer </b> : ".$pouser->po_customer." <br>
                <b> DN NO </b> : ".$pouser->dn_no." <br>
                <b> Tanggal </b> : ".$pouser->tanggal." <br>
                <b> Status </b> : ".$pouser->status." <br>
                <b> Customer </b> : ".$pouser->customer." <br>
                <b> Payment Terms </b> : ".$pouser->payment_terms." <br>
            </div>
            <div class='col-12'>
            <br>
            <br>
            </div>
            ".$html."
        ";

        return response()->json(array('res' => 'berhasil', 'data' => $tag));
    }

    public function det_pouser($id)
    {
        $data = pouser_det::where('userReq_id', $id)->get();
        return $data;
    }

    public function invoice($id)
    {
        return view('/transaksi/invoice', compact('id'));
    }

    public function invoiceGet($id)
    {
        $data = invoice::where('userReq_id', $id)->get();
        return DataTables::of(invoice::where('userReq_id',$id)->orderBy('created_at','desc'))
        ->editColumn('action', function ($data) {
            return '<a href="#" onclick=edit_invoice("'.$data->invoice_id.'") class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> <a href="#" onclick=hapus_invoice("'.$data->invoice_id.'") class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
        })
        ->editColumn('print', function ($data) {
            return '<a href="/transaksi/invoice/print/'.$data->invoice_id.'" class="btn btn-sm btn-info"><i class="fa fa-print"></i></a>';
        })
        ->rawColumns(['action','print'])
        ->make(true);
    }

    public function invoiceEditGet(Request $request)
    {
        $id = $request->id;
        $data = invoice::find($id);
        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    public function invoiceEditStore(Request $request)
    {
        $id = $request->id;

        $validasi = Validator::make($request->all(),[
            'nama_invoice' => 'required',
            'jumlah' => 'required',
            'no_invoice' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json(array('res' => 'gagal'));
        }

        $data = invoice::find($id);
        $data->nama_invoice = $request->nama_invoice;
        $data->jumlah = $request->jumlah;
        $data->no_invoice = $request->no_invoice;
        $data->tgl = date('Y-m-d');
        $data->save();

        return response()->json(array('res' => 'berhasil'));
    }

    public function invoiceTambah(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'nama_invoice' => 'required',
            'jumlah' => 'required',
            'no_invoice' => 'required'
        ]);

        if ($validasi->fails()) {
            return response()->json(array('res' => 'gagal'));
        }

        $id = uniqid();
        $userReq_id = $request->userReq_id;

        $data = invoice::create([
            'invoice_id' => $id,
            'userReq_id' => $userReq_id,
            'no_invoice' => $request->no_invoice,
            'tgl' => date('Y-m-d'),
            'nama_invoice' => $request->nama_invoice,
            'jumlah' => $request->jumlah
        ]);

        return response()->json(array('res' => 'berhasil'));
    }

    public function invoicePrint($id)
    {
        $data = invoice::find($id);
        $pouser = pouser::find($data->userReq_id);
        $customer_id = $data->customer_id;
        $customer = customer::find($customer_id);
        $det = pouser_det::where('userReq_id',$data->userReq_id)->get();

        return view('/transaksi/invoice_print',['pouser' => $pouser, 'det' => $det, 'data' => $data, 'customer' => $customer]);
    }

    public function invoiceHapus(Request $request)
    {
        $id = $request->id;
        $data = invoice::find($id);
        $data->delete();

        return response()->json(array('res' => 'berhasil'));
    }

    public function invoiceDet($id)
    {
        return $data = pouser_det::where('userReq_id',$id)->get();
    }
    
    public function autofill(Request $request)
    {
        $data = customer::all();
        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    public function autofillCom(Request $request)
    {
        $nama_customer = $request->nama_customer;
        $data =customer::find($nama_customer);
        $alamat = $data->alamat;
        $nama_customer = $data->customer;
        return response()->json(array('alamat' => $alamat, 'nama_customer' => $nama_customer));
    }

    public function customers()
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses' ,'bagian' => 'CUSTOMERS']);
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses' ,'bagian' => 'CUSTOMERS']);
        return view('/transaksi/customers');
    }

    public function customersView()
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Akses' ,'bagian' => 'CUSTOMERS']);
        $data = customer::select(['customer_id','nama_customers','no_telp','fax','alamat']);
        return Datatables::of(customer::orderBy('created_at','desc'))
        ->addColumn('action', function ($data)
        {
            return '<a href="#" id="edit_customers" onclick=edit_customers("'.$data->customer_id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_customers" onclick=hapus_customers("'.$data->customer_id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function customersTambah(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tambah' ,'bagian' => 'CUSTOMERS']);
        $validasi = Validator::make($request->all(),[
            'nama_customer' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'fax' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json(array('res' => 'gagal'));
        }
        $id = uniqid();

        $data = customer::create([
            'customer_id' => $id,
            'nama_customers' => $request->nama_customer,
            'no_telp' => $request->no_telp,
            'fax' => $request->fax,
            'alamat' => $request->alamat,
        ]);

        return response()->json(array('res' => 'berhasil'));
    }

    public function customersEditGet(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Tampil Edit' ,'bagian' => 'CUSTOMERS']);
        $id = $request->id;

        $data = customer::find($id);

        return response()->json(array('res' => 'berhasil', 'data' => $data));
    }

    public function customersEditStore(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Edit Store' ,'bagian' => 'CUSTOMERS']);
        $validasi = Validator::make($request->all(),[
            'nama_customer' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'fax' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json(array('res' => 'gagal'));
        }

        $data = customer::find($request->id);
        $data->nama_customers = $request->nama_customer;
        $data->no_telp = $request->no_telp;
        $data->fax = $request->fax;
        $data->alamat = $request->alamat;
        $data->save();

        return response()->json(array('res' => 'berhasil'));
    }

    public function customersHapus(Request $request)
    {
        DB::table('log')->insert(['user_id'=> Auth::User()->id, 'created_at' => date('Y-m-d H:i:s') ,'aksi'=> 'Hapus' ,'bagian' => 'CUSTOMERS']);
        $id = $request->id;
        $data = customer::find($id);
        $data->delete();

        return response()->json(array('res' => 'berhasil'));
    }
}
