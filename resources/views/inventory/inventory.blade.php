@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Inventory <small></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li>
                    <button type="button" class="btn btn-sm btn-info" id="button_transfer">Transfer Barang</button>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                    <div class="col-md-12">
                      <div class="">
                        <div class="x_content">
                          <div class="row">
                            @foreach ($gudang as $item)
                                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                                    <div class="tile-stats">
                                    <div class="icon">
                                    </div>
                                    <h3>{{$item->nama_gudang}}</h3>
                                    <p><a href="/inventory/barang_masuk/{{$item->gudang_id}}"><i class="fa fa-arrow-right"></i>Show</a></p>
                                    </div>
                                </div>
                            @endforeach
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
      </div>

      <div id="modal_transfer" class="modal fade bs-example-modal-md" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Transfer Barang</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Source</label>
                    <div class="row">
                        <div class="col-10">
                            <select class="form-control" id="gudang_data" style="width: 100%">
                                @foreach($gudang as $data)
                                    <option value="{{$data->gudang_id}}">{{$data->nama_gudang}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-success" id="gudang_cari">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                        <div id="barang_body" hidden>
                            <div class="row">
                                <div class="col-10">
                                    <label for="">Pilih Barang</label>
                                    <select id="barang_data"  style="width:100%">
                                    </select>
                                </div>
                                <div class="col-2">
                                    <br>
                                    <button class="btn btn-success" id="barang_cari">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="form-group">
                    <div id="serial_body" hidden>
                        <div class="row">
                            <div class="col-10">
                                <label for="">Pilih Serial</label>
                                <select id="serial_data" multiple="multiple" style="width:100%">
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="">QTY</label>
                                <input type="text" id="serial_qty" class="form-control">
                            </div>
                            <div class="col-10">
                                <label for="">Destination</label>
                                <select name="" id="destination" class="form-control">
                                </select>
                            </div>
                            <div class="col-2">
                                <br>
                                <button class="btn btn-success" id="barang_cari_destination">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                            <div class="col-12">
                                <label for="">Buat barang baru</label>
                                <input type="checkbox" id="barangBaru" onclick="checkedBarang()">
                            </div>
                            <div class="col-12">
                                <div id="destination_body">
                                    <select name="" id="destination_barang" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" form="form_serial" id="form_transfer" class="btn btn-primary">Transfer Item</button>
            </div>

          </div>
        </div>
      </div>


      <script>
          $(document).ready(function(){
              $('#button_transfer').on('click', function(){
                  $('#modal_transfer').modal('show');
              })
          })
      </script>

      <script>
        $(document).ready(function(){
              $('#gudang_cari').on('click', function(){
                  var gudang = $('#gudang_data').val();
                $('#barang_data').html('');
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    type: "POST",
                    url: '/inventory/gudang/cariGudang',
                    data: { gudang:gudang}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                            $.each(result.data, function (key,value) {
                                $('#barang_data').append($("<option></option>").attr("value", value.inventory_id).text(value.nama_barang)); 
                            })
                            $.each(result.gudang, function (key,value) {
                                $('#destination').append($("<option></option>").attr("value", value.gudang_id).text(value.nama_gudang)); 
                            })
                            $('#barang_data').select2({
                                theme :'bootstrap',
                                maximumSelectionLength: result.max_qty,
                                formatSelectionTooBig: function (limit) {

                                    // Callback

                                    return 'Too many selected items';
                                }
                            });
                            $('#barang_body').removeAttr('hidden');
                        }
                    }
                });
              })
          })
      </script>

<script>
    $(document).ready(function(){
          $('#barang_cari').on('click', function(){
              var barang = $('#barang_data').val();
            $('#serial_data').html('');
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: "POST",
                url: '/inventory/gudang/cariBarang',
                data: { barang:barang}, 
                success: function( result ) {
                    if (result.res === 'berhasil') {
                        $.each(result.data, function (key,value) {
                            $('#serial_data').append($("<option></option>").attr("value", value.sn_id).text(value.no_serial)); 
                        })
                        $('#serial_data').select2({
                            theme :'bootstrap',
                            maximumSelectionLength: result.max_qty,
                            formatSelectionTooBig: function (limit) {

                                // Callback

                                return 'Too many selected items';
                            }
                        });
                        $('#serial_body').removeAttr('hidden');
                    }
                }
            });
          })
      })
  </script>

  <script>
      $(document).ready(function (){
        $('#serial_data').on('select2:close', function (evt) {
        var count = $(this).select2('data').length
        if(count==0){
          $('#serial_qty').val(0);
        }
        else{
            $('#serial_qty').val(count);
        }
      })
    })
  </script>

  <script>
      $(document).ready(function(){
          $('#barang_cari_destination').on('click', function(){
              var barang = $('#destination').val();
              $('#destination_barang').html('');
              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    type: "POST",
                    url: '/inventory/gudang/cariBarangDestination',
                    data: { barang:barang}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                            $.each(result.data, function (key,value) {
                                $('#destination_barang').append($("<option></option>").attr("value", value.inventory_id).text(value.nama_barang)); 
                            })
                            $('#destination_barang').select2({
                                theme :'bootstrap',
                                maximumSelectionLength: result.max_qty,
                                formatSelectionTooBig: function (limit) {

                                    // Callback

                                    return 'Too many selected items';
                                }
                            });
                            //$('#serial_body').removeAttr('hidden');
                        }
                    }
                });
          })
      })
  </script>


<script>
    function checkedBarang() {
        if ($('#barangBaru').is(':checked')) {
            $('#destination_body').attr('hidden', true);
        } else {
            $('#barangBaru').prop('checked', false)
            $('#destination_body').attr('hidden', false);
        }
    }
</script>

<script>
    //transfer store
    $(document).ready(function(){
        $('#form_transfer').on('click', function(){
            if ($('#barangBaru').is(':checked')) {
                var barang = $('#barang_data').val();
                var serial = $('#serial_data').val();
                var qty = $('#serial_qty').val();
                var destination = $('#destination').val();
                console.log("barang : " + barang + " serial :" + serial + " quantity: "+ qty + " destination: " + destination);
                if (serial === null || destination === null || barang === null) {
                    new PNotify({
                        title: 'Error!!',
                        text: 'Data tidak boleh Kosong',
                        type: 'error',
                        styling: 'bootstrap3'
                    });
                } else {

                //store
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    type: "POST",
                    url: '/inventory/transferStoreMake',
                    data: { barang:barang, serial:serial, destination:destination, qty:qty}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                            new PNotify({
                                title: 'Success!!',
                                text: 'Berhasil',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            $('#modal_transfer').modal('hide');
                        }
                    }
                });
            }

                
            } else {
                var barang = $('#barang_data').val();
                var serial = $('#serial_data').val();
                var qty = $('#serial_qty').val();
                var destination = $('#destination').val();
                var destination_barang = $('#destination_barang').val();

                if (serial === null || destination === null || barang === null || destination_barang === null) {
                    new PNotify({
                        title: 'Error!!',
                        text: 'Data tidak boleh Kosong',
                        type: 'error',
                        styling: 'bootstrap3'
                    });
                } else {

                //store
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    type: "POST",
                    url: '/inventory/transferStore',
                    data: { barang:barang, serial:serial, destination:destination, destination_barang:destination_barang, qty:qty}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                            new PNotify({
                                title: 'Success!!',
                                text: '',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            $('#modal_transfer').modal('hide');
                        }
                    }
                });
            }
                console.log("barang : " + barang + " serial :" + serial + " quantity: "+ qty + " destination: " + destination + " destination_barang: " + destination_barang);
            }
        })
    })
</script>

@endsection