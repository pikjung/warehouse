@extends('layout.index')

@section('content')
<h1>Welcome @php echo Auth::User()->name @endphp </h1>

@php
$no = 0;
$dashboard = app('App\Http\Controllers\dashboardController');
@endphp
    <div class="row" style="display: inline-block;" >
      <div class="tile_count">
        <div class="col-md-2 col-sm-4  tile_stats_count">
          <span class="count_top"><i class="fa fa-home"></i>PO GSC Draft</span>
          <div class="count">{{$dashboard->pogsc('po')}}</div>
        </div>
        <div class="col-md-2 col-sm-4  tile_stats_count">
          <span class="count_top"><i class="fa fa-home"></i>PO GSC Diterima</span>
          <div class="count">{{$dashboard->pogsc('diterima')}}</div>
        </div>
        <div class="col-md-2 col-sm-4  tile_stats_count">
          <span class="count_top"><i class="fa fa-user"></i>PO User Draft</span>
          <div class="count">{{$dashboard->pouser('po')}}</div>
        </div>
        <div class="col-md-2 col-sm-4  tile_stats_count">
          <span class="count_top"><i class="fa fa-user"></i>PO User Terkirim</span>
          <div class="count">{{$dashboard->pouser('Terkirim')}}</div>
        </div>
        <div class="col-md-2 col-sm-4  tile_stats_count">
          <span class="count_top"><i class="fa fa-user"></i>PO User Arsip</span>
          <div class="count">{{$dashboard->pouser('Arsip')}}</div>
        </div>
        <div class="col-md-2 col-sm-4  tile_stats_count">
          <span class="count_top"><i class="fa fa-truck"></i>Paket Terkirim</span>
          <div class="count green">{{ $dashboard->paket('Terkirim') }}</div>
        </div>
      </div>
    </div>
      <br />
    </div>
    <!-- /page content -->
@endsection