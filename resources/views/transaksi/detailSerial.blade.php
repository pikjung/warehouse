@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Serial <small>Table</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li>
                  <input type="hidden" value="{{$data->quantity - $sn}}" id="data_awal">
                    @if ($data->quantity == $sn)
                    <button type="button" class="btn btn-sm btn-success" id="button_modal" disabled>Tambah Data</button>
                    @else
                    <button type="button" class="btn btn-sm btn-success" id="button_modal">Tambah Data</button>
                    <button type="button" class="btn btn-sm btn-success" id="button_import">Import</button>
                    @endif
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">Nama Barang : <b>{{$data->nama_barang}}</b></div>
                                <div class="col-sm-12 col-md-12">Quantity : <b>{{$data->quantity}}</b> <input type="hidden" id="max_qty" value="{{$data->quantity - $sn}}"></div>
                                <div class="col-sm-12 col-md-12">QTY Serial : <b>{{$sn}}</b> @if ($data->quantity == $sn) <p style="color: red"> *Terpenuhi</p> @endif</div>
                            </div>
                            <br><br>
                          <table id="data_barang" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th width="50%">No Serial</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
      </div>

      <div id="modal_tambah" class="modal fade bs-example-modal-md" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Tambah Serial</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Inventory</label>
                    <div class="row">
                        <div class="col-10">
                            <select class="form-control" id="serial_tambah" style="width: 100%"></select>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-success" id="cari_inventory">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <form action="/transaksi/po/detailMode/serial/snStore" method="POST" id="form_serial">
                        <div id="serial_body" hidden>
                            {{ csrf_field() }}
                            <input type="hidden" name="userReq_det_id" value="{{$data->userReq_det_id}}">
                            <select name="no_serial[]" id="serialSelect" multiple="multiple" style="width:100%">
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" form="form_serial" id="form_serial_button" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_edit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Edit Data Data Barang</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">No Serial</label>
                    <input type="text" class="form-control" id="no_serial_edit">
                    <input type="hidden" id="edit_id">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_edit_serial" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_hapus" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Hapus Serial</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="row">
                    <div class="col-6 justify-content-center">
                      <input type="hidden" id="hapus_id">
                      <button id="hapus_button" class="btn btn-danger">
                        <i class="glyphicon glyphicon-trash"></i> Ya, saya yakin
                      </button>
                    </div>
                    <div class="col-6 justify-content-center">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
            </div>
          </div>
        </div>
      </div>

      <div id="modal_import" class="modal fade bs-example-modal-lg" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Import Serial</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            
            <div class="modal-body">
              <form method="POST" enctype="multipart/form-data" id="laravel-ajax-file-upload" action="javascript:void(0)"  >
                <div class="form-group">
                <input type="hidden" name="userReq_det_id" value="{{$id}}">
                    <input type="file" name="file" id="serial_excel" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Import</button>
                </div>
              </form>

              <div class="form-group">
                <div class="row">
                  <div class="col-12" id="count_valid">
                    
                  </div>
                </div>
                <div class="row" style="background-color: #D3D3D3;">
        
                  <div class="col-6">
                    <div class="row">
                      <div class="col-6">
                        Valid :
                      </div>
                      <div class="col-6">
                        <span id="valid_count"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="row">
                      <div class="col-6">
                        Invalid :
                      </div>
                      <div class="col-6">
                         <span id="invalid_count"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

                <div class="form-group">
                  <table class="table table-striped" id="exportSerial" style="width: 100%">
                    <thead>
                      <tr>
                        <th>Serial</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              
            </div>
            <div class="modal-footer">
              <div id="buttonsave_import"></div>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>

      <script type="text/javascript">
        $(document).ready(function() {
            var id = {!! json_encode($id) !!};
            var status = {!! json_encode($status) !!};
            $('#data_barang').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'Contoh File PDF Datatables'},
                    {extend: 'excel', title: 'Contoh File Excel Datatables'},
                    {extend:'print',title: 'Contoh Print Datatables'},
                ],
                ajax: '/transaksi/po/detailMode/serial/get/'+id+'/'+status,
                columns: [
                    {data: 'no_serial', name: 'no_serial'},
                    {data: 'action', name:'action', orderable: false, searchable:false},
                ],
            });
        });
        </script>

      <script>
        $(document).ready(function () {
          $('#save_detail').click(function () {
            var id = {!! json_encode($id) !!};
            var nama_barang = $('#nama_barang').val();
            var spek = $('#spek').val();
            var quantity = $('#quantity').val();
            var harga_beli = $('#harga_beli').val();

            if (nama_barang === '' || spek === '' || quantity === '' || harga_beli === '') {
              new PNotify({
                  title: 'Data Kosong!!',
                  text: 'Data harap tidak dikosongkan!',
                  type: 'error',
                  styling: 'bootstrap3'
              });
            }else {
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  type: "POST",
                  url: '/gsc/pogsc/detailEdit/tambah',
                  data: { id:id,nama_barang:nama_barang, spek:spek, quantity:quantity , harga_beli:harga_beli}, 
                  success: function( result ) {
                      if (result.res === 'berhasil') {
                        new PNotify({
                          title: 'Success!!',
                          text: 'Data Berhasil di tambah!',
                          type: 'success',
                          styling: 'bootstrap3'
                      });
                      $('#modal_tambah').modal('hide');
                      $('#data_barang').DataTable().ajax.reload();
                      }
                  }
              });
            }
          })
        })
      </script>

<script type="text/javascript">
  $(document).ready(function (e) {
    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#laravel-ajax-file-upload').submit(function(e) {
    e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type:'POST',
        url: "/transaksi/po/detailMode/inventory/serialImport",
        data: formData,
        processData: false,
        contentType: false,
        success: (result) => {
          if (result.res === 'berhasil') {
            var max_qty = $('#max_qty').val();
            if (result.valid > max_qty) {
              $('#count_valid').html('<span class="badge badge-danger">Jumlah serial export melampaui jumlah yang dibutuhkan</span>')
            } else {
              $('#count_valid').html('<span class="badge badge-success">Serial bisa di import: '+result.valid+' </span>')
            }
            $('#valid_count').html('<p class="text-success">'+result.valid+'</p>');
            $('#invalid_count').html('<p class="text-danger">'+result.invalid+'</p>');
            if (result.valid == max_qty) {
                $('#buttonsave_import').html('<button class="btn btn-info" onclick="simpan_import()">Simpan</button>');
              }
            var jsonData = result.data;
            var tableExport = $('#exportSerial').DataTable( {
                  dom: 'Bfrtip',
                  buttons: [
                      'copy', 'csv', 'excel', 'pdf', 'print'
                  ],
                  data : [],
                  columns : [
                    {name: 'Serial' , data : 'serial'},
                    {name: 'Status' , data : 'status'}
                  ]
              } );
            tableExport.clear();
            $.each(JSON.parse(jsonData), function (index, value) {
              tableExport.row.add(value)
            });
            tableExport.draw()
          } else if (result.res == 'gagal') {
                new PNotify({
                    title: 'Error!!',
                    text: result.message,
                    type: 'error',
                    styling: 'bootstrap3'
                });
          }
        },
          error: function(data){
          console.log(data);
        }
      });
    });
  });
  </script>

  <script>
    function simpan_import() {
      var form = document.getElementById('laravel-ajax-file-upload');
        var formData = new FormData(form);
        $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        type:'POST',
        url: "/transaksi/po/detailMode/inventory/serialImportSave",
        data: formData,
        processData: false,
        contentType: false,
        success: (result) => {
          if (result.res === 'berhasil') {
                  new PNotify({
                    title: 'Success!!',
                    text: 'Data Berhasil di Import!',
                    type: 'success',
                    styling: 'bootstrap3'
                });
          }
        }
      });
    }
  </script>

      <script>
        $(document).ready(function () {
          $('#button_modal').click(function () {
            $('#serial_tambah').val('');
            $('#selectSerial').val('');
            $('#laravel-ajax-file-upload').trigger("reset");
            $('#modal_tambah').modal('show');
          })
        })
      </script>

      

      <script>
        function edit_serial(id) {
            $('#no_serial').val('');
            $('#edit_id').val('');
          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
            $.ajax({
                type: "POST",
                url: '/inventory/barang_masuk/snEdit',
                data: { id:id }, 
                success: function( result ) {
                    if (result.res === 'berhasil') {
                        $('#no_serial_edit').val(result.data.no_serial);
                        $('#edit_id').val(result.data.sn_id);
                        $('#modal_edit').modal('show');
                      }
                    }
                
            });
        }
      </script>

<script>
  $(document).ready(function () {
    $('#save_edit_serial').click(function () {
      var no_serial = $('#no_serial_edit').val();
      var id = $('#edit_id').val();

      if (no_serial === '') {
        new PNotify({
            title: 'Data Kosong!!',
            text: 'Data harap tidak dikosongkan!',
            type: 'error',
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
            url: '/inventory/barang_masuk/snUpdate',
            data: { id:id,no_serial:no_serial}, 
            success: function( result ) {
                if (result.res === 'berhasil') {
                  new PNotify({
                    title: 'Success!!',
                    text: 'Data Berhasil di Edit!',
                    type: 'success',
                    styling: 'bootstrap3'
                });
                $('#modal_edit').modal('hide');
                $('#data_barang').DataTable().ajax.reload();
                }
            }
        });
      }
    })
  })
</script>

<script>
  function hapus_serial(id) {
    $('#hapus_id').val('');
    $('#hapus_id').val(id);

    $('#modal_hapus').modal('show');
  }
</script>

<script>
  $(document).ready(function () {
    $('#hapus_button').click(function () {
      var id = $('#hapus_id').val();
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/transaksi/po/detailMode/snHapus',
            data: { id:id}, 
            success: function( result ) {
                if (result.res === 'berhasil') {
                  new PNotify({
                    title: 'Success!!',
                    text: 'Data Berhasil di Hapus!',
                    type: 'success',
                    styling: 'bootstrap3'
                });
                $('#modal_hapus').modal('hide');
                $('#data_barang').DataTable().ajax.reload();
                window.location.reload();
                }
            }
        });
    })
  })
</script>

<script>
    $('#serial_tambah').select2({
        theme: 'bootstrap'
    });
    $('#serial_tambah').select2({
    ajax: {
        placeholder: "Nama barang atau serial..",
        url: '/transaksi/po/detailMode/inventory/select',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
            results:  $.map(data, function (item) {
                return {
                text: 'Nama Barang:'+item.nama_barang+'| Qty:'+item.quantity,
                id: item.inventory_id
                }
            })
            };
        },
        cache: true
    }
  });
</script>

<script>
    $(document).ready(function () {
        $('#cari_inventory').click(function () {
            var sn = $('#serial_tambah').val();
            var max_qty = $('#max_qty').val();
            $('#serialSelect').html('');
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: "POST",
                url: '/transaksi/po/detailMode/inventory/serial',
                data: { id:sn, max_qty:max_qty}, 
                success: function( result ) {
                    if (result.res === 'berhasil') {
                        $.each(result.data, function (key,value) {
                            $('#serialSelect').append($("<option></option>").attr("value", value.sn_id).text(value.no_serial)); 
                        })
                        $('#serialSelect').select2({
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
  $(document).ready(function () {
    $('#button_import').click(function () {
      $('#valid_count').html('');
      $('#invalid_count').html('');
      $('#import_body').html('');
      $('#modal_import').modal('show');
    })
  })
</script>

<script>
  $(document).ready(function () {
    $('#form_import_button').click(function () {
      var formData = new FormData(this);
      var serial = $('#serial_excel').val();
      var max_qty = $('#max_qty').val();
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: "POST",
                url: '/transaksi/po/detailMode/inventory/serialImport',
                data: formData, 
                processData: false,
                contentType: false,
                success: function( result ) {
                    if (result.res === 'berhasil') {
                        $('#import_body').html(result.data);
                    } else if (result.res == 'gagal') {
                      new PNotify({
                          title: 'Error!!',
                          text: result.message,
                          type: 'error',
                          styling: 'bootstrap3'
                      });
                    }
                }
            });
    })
  })
</script>


@endsection