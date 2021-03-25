@extends('layout.index')

@section('content')

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


    <div class="row">
      <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2> Check DN</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
                        <div class="form-group">
                          <label for="">DN Checking</label>
                          <input type="text" id="checkDN" class="form-control">
                          <div id="pesan"></div>
                        </div>
                        <div class="form-group">
                          <button type="button" class="btn btn-primary" id="button_check">Check</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </div>
    </div>

    <script>
      $(document).ready(function () {
        $('#button_check').on('click', function (){
          var check = $('#checkDN').val();
          $('#pesan').html('');
          if (check === '') {
            new PNotify({
                title: 'Warning!!',
                text: 'form tidak boleh kosong!',
                type: 'warning',
                styling: 'bootstrap3'
            });
          } else {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '/dashboard/checkDN',
                data: { check:check }, 
                success: function( result ) {
                  if (result.res === 'berhasil') {
                      if ( result.dn === 'pouser') {
                        $('#pesan').html('<b class="text-danger">DN tidak dapat digunakan, sudah digunakan di bagian POUSER</b>');
                      } else if (result.dn === 'delivery') {
                        $('#pesan').html('<b class="text-danger">DN tidak dapat digunakan, sudah digunakan di bagian POUSER</b>');
                      } else {
                        $('#pesan').html('<b class="text-success">DN dapat digunakan');
                      }
                    }
                }
            });
          }
        })
      })
    </script>
    <!-- /page content -->
@endsection