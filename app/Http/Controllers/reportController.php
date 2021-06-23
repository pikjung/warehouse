<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\reportExport;

use App\Exports\tokoExport;

use Maatwebsite\Excel\Facades\Excel;

use DataTables;

use DB;

class reportController extends Controller
{
    public function report()
    {
        return view('/report/report');
    }

    public function reportExcel(Request $request)
    {
        $report = $request->report;
        $dateArr = $request->month;
        if ($report == 'gsc') {
           return Excel::download(new reportExport($dateArr), 'gscReport-'.$dateArr.'.ods');
        } else {
          return Excel::download(new tokoExport($dateArr), 'tokoReport-'.$dateArr.'.ods');
        }
    }
}
