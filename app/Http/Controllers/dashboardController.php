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

class dashboardController extends Controller
{
    public function index()
    {
        return view('/dashboard/index');
    }

    public function pouser($status)
    {
        $pouser = pouser::where('status', $status)->get()->count();
        return $pouser;
    }

    public function pogsc($status)
    {
        $pogsc = pogsc::where('status', $status)->get()->count();
        return $pogsc;
    }

    public function paket($status)
    {
        $paket = paket::where('status', $status)->get()->count();
        return $paket;
    }

    public function serial(Request $request)
    {
        $serial = $request->serial;
        $sn = serial::where('no_serial', $serial)->first();
        if ($sn->userReq_det_id == null) {
            $inventory = inventory::find($sn->inventory_id);
            return response()->json(array('res' => 'berhasil', 'type' => 'inventory', 'inventory' => $inventory));
        } else {
            //$pouser_det = pouser_det::find($sn->userReq_det_id);
            //$pouser = pouser::find($pouser_det->userReq_id);
            $inventory = inventory::find($sn->inventory_id);
        return response()->json(array('res' => 'berhasil', 'type' => 'pouser', 'inventory' => $inventory /*',pouser' => $pouser */));
        }
    }

    public function checkDN(Request $request)
    {
        
    }
}
