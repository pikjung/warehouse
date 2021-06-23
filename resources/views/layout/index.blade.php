<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GSC WAREHOUSE </title>

    <style>
      .loader {
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #44d1b0; /* Blue */
        border-radius: 50%;
        margin-left: auto;
        margin-right: auto;
        width: 60px;
        height: 60px;
        animation: spin 2s linear infinite;
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
    </style>
    <!-- Bootstrap -->
  <link href="{{asset('/template/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
  <link href="{{asset('/template/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
  <link href="{{asset('/template/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
  <link href="{{asset('/template/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
  <link href="{{asset('/template/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
  <link href="{{asset('/template/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
  <link href="{{asset('/template/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- datepicker -->
    <link rel="stylesheet" href="{{asset('/vendors/datepicker/css/datepicker.css')}}">


  <!-- Datatables -->

  <link href="{{asset('/template/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('/template/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('/template/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('/template/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('/template/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

  <!-- PNotify -->
  <link href="{{asset('/template/vendors/pnotify/dist/pnotify.css')}}" rel="stylesheet">
  <link href="{{asset('/template/vendors/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet">
  <link href="{{asset('/template/vendors/pnotify/dist/pnotify.nonblock.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
  <link href="{{asset('/template/build/css/custom.min.css')}}" rel="stylesheet">

    <!--select2 -->
  <link href="{{asset('/vendors/select2/css/select2.min.css')}}" rel="stylesheet">
  <link href="{{asset('/vendors/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet">

  <script src="{{asset('/template/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
<script src="{{asset('/template/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
<script src="{{asset('/template/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
<script src="{{asset('/template/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
<script src="{{asset('/template/vendors/Chartjs/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
<script src="{{asset('/template/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
<script src="{{asset('/template/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
<script src="{{asset('/template/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
<script src="{{asset('/template/vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
<script src="{{asset('/template//vendors/Flot/jquery.flot.js')}}"></script>
<script src="{{asset('/template/vendors/Flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('/template/vendors/Flot/jquery.flot.time.js')}}"></script>
<script src="{{asset('/template/vendors/Flot/jquery.flot.stack.js')}}"></script>
<script src="{{asset('/template/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
<script src="{{asset('/template/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
<script src="{{asset('/template/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
<script src="{{asset('/template/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
<script src="{{asset('/template/vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
<script src="{{asset('/template/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
<script src="{{asset('/template/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
<script src="{{asset('/template/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
<script src="{{asset('/template/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('/template/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!-- Datatables -->
<script src="{{asset('/template/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('/template/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('/template/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('/template/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('/template/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('/template/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('/template/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/template/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
<script src="{{asset('/template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
<script src="{{asset('/template/vendors/jszip/dist/jszip.min.js')}}"></script>
<script src="{{asset('/template/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('/template/vendors/pdfmake/build/vfs_fonts.js')}}"></script>

<!-- PNotify -->
<script src="{{asset('/template/vendors/pnotify/dist/pnotify.js')}}"></script>
<script src="{{asset('/template/vendors/pnotify/dist/pnotify.buttons.js')}}"></script>
<script src="{{asset('/template/vendors/pnotify/dist/pnotify.nonblock.js')}}"></script>

<!--select2 -->
<script src="{{asset('/vendors/select2/js/select2.min.js')}}"></script>

<!-- datepicker -->
<script src="{{asset('/vendors/datepicker/js/bootstrap-datepicker.js')}}"></script>

<!-- ckeditor -->
<script src="{{asset('/vendors/ckeditor/ckeditor.js')}}"></script>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/" class="site_title"><i class="fa fa-home"></i> <span>GSCWarehouse</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{Auth::User()->name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Company</h3>
                <ul class="nav side-menu">
                    <li><a href="/"><i class="fa fa-th-large"></i>Dashboard</a></li>
                    <li><a><i class="fa fa-exchange"></i>PO</a>
                      <ul class="nav child_menu">
                        <li><a href="/gsc/pogsc">PO GSC</a></li>
                        <li><a href="/transaksi">PO User</a></li>
                        <li><a href="/delivery/paket">Pengiriman</a></li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-home"></i>Master</a>
                      <ul class="nav child_menu">
                        <li><a href="/inventory">Inventory</a></li>
                        <li><a href="/customers">Customer</a></li>
                        <li><a href="/gsc/distributor">Distributor</a></li>
                        <li><a href="/delivery/logistic">Expedisi</a></li>
                      </ul>
                    </li>
                    @if(Auth::User()->level == '4')
                    <li><a href="/account"><i class="fa fa-user"></i>Account</a></li>
                    @endif
                    @if(Auth::User()->level == '2' || Auth::User()->level == '4')
                    <li><a href="/report"><i class="fa fa-book"></i>Report</a></li>
                    @endif
                </ul>
                <h3>Store</h3>
                <ul  class="nav side-menu">
                  <li><a><i class="fa fa-shopping-cart"></i>Store</a>
                    <ul class="nav child_menu">
                      <li><a href="/store/data_toko">Data Toko</a></li>
                      <li><a href="/store/platform">Platform</a></li>
                      <li><a href="/store/transaksi">Transaksi</a></li>
                      <!--<li><a href="/store/report">Report</a></li> -->
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
             /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    {{Auth::User()->name}}
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>
                <li>
                  <button class="btn btn-info" id="serial_track_button"><i class="fa fa-search"></i></button>
                </li>
                <li class="nav-item">
                  <input type="text" id="serial_track" class="form-control" placeholder="Cari Serial..">
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')

            <div id="modal_serial_track" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Serial</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="" id="body_serial_track"></div>
                  </div>

                </div>
              </div>
            </div>
        <!-- footer content -->
            <footer>
                <div class="pull-right">
                    GSC WAREHOUSE {{date("Y")}}
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
        <!--end of Page content -->
    </div>
    <!-- jQuery -->
        <!-- Custom Theme Scripts -->
        <script src="{{asset('/template/build/js/custom.min.js')}}"></script>
  </div>
<script>
  $(document).ready(function() {
    $('#serial_track_button').click(function(){
      $('#body_serial_track').html('')
      var serial = $('#serial_track').val();

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/dashboard/serial',
            data: { serial:serial},
            success: function( result ) {
                if (result.res === 'berhasil') {
                  if (result.type === 'inventory') {
                    $('#body_serial_track').html(
                        "<div class='row'> "+
                          "<div class='col-3'>Nama Barang</div>"+
                          "<div class='col-9'> :"+result.inventory.nama_barang+"</div>"+
                          "<div class='col-3'>Nama Disti</div>"+
                          "<div class='col-9'> :"+result.inventory.nama_disti+"</div>"+
                          "<div class='col-3'>PN</div>"+
                          "<div class='col-9'> :"+result.inventory.pn+"</div>"+
                          "<div class='col-3'>SKU</div>"+
                          "<div class='col-9'> :"+result.inventory.sku+"</div>"+
                          "<div class='col-3'>Spek</div>"+
                          "<div class='col-9'> :"+result.inventory.spek+"</div>"+
                          "<div class='col-3'>Tanggal</div>"+
                          "<div class='col-9'> :"+result.inventory.tanggal+"</div>"+
                        "</div>"+
                      "</div>")

                      $('#modal_serial_track').modal('show');
                  } else if (result.type === 'pouser'){
                    $('#body_serial_track').html(
                        "<div class='row'> "+
                          "<div class='col-3'>Nama Barang</div>"+
                          "<div class='col-9'> :"+result.inventory.nama_barang+"</div>"+
                          "<div class='col-3'>Nama Disti</div>"+
                          "<div class='col-9'> :"+result.inventory.nama_disti+"</div>"+
                          "<div class='col-3'>PN</div>"+
                          "<div class='col-9'> :"+result.inventory.pn+"</div>"+
                          "<div class='col-3'>SKU</div>"+
                          "<div class='col-9'> :"+result.inventory.sku+"</div>"+
                          "<div class='col-3'>Spek</div>"+
                          "<div class='col-9'> :"+result.inventory.spek+"</div>"+
                          "<div class='col-3'>Tanggal</div>"+
                          "<div class='col-9'> :"+result.inventory.tanggal+"</div>"+
                        "</div>"+
                      "</div>")

                      $('#modal_serial_track').modal('show');
                  }
                }
            }
        });
    })
  })
</script>

</body>

</html>
