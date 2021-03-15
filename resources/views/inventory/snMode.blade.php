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
                  <input type="hidden" value="{{$inventory->quantity_awal - $sn}}" id="inventory_awal">
                    @if ($inventory->quantity_awal == $sn)
                    <button type="button" class="btn btn-sm btn-success" id="button_modal" disabled>Tambah Data</button>
                    @else
                    <button type="button" class="btn btn-sm btn-success" id="button_modal">Tambah Data</button>
                    <button type="button" class="btn btn-sm btn-success" id="button_import">Import Data</button>
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
                                <div class="col-sm-12 col-md-12">Nama Barang : <b>{{$inventory->nama_barang}}</b></div>
                                <div class="col-sm-12 col-md-12">Quantity : <b>{{$inventory->quantity_awal}}</b></div>
                                <div class="col-sm-12 col-md-12">Quantity Tersisa : <b>{{$inventory->quantity_awal - $sn_tersisa}}</b></div>
                                <div class="col-sm-12 col-md-12">QTY Serial : <b>{{$sn}}</b> @if ($inventory->quantity_awal == $sn) <p style="color: red"> *Terpenuhi</p> @endif</div>
                            </div>
                            <br><br>
                          <table id="data_barang" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th width="10%">No Serial</th>
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

      <div id="modal_tambah" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Tambah Serial</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">No Serial</label>
                    <input type="text" class="form-control" id="serial_tambah">
                </div>
                <form action="/inventory/barang_masuk/snStore" method="POST" id="form_serial">
                <table class="table table striped">
                    <thead>
                        <th>No Serial</th>
                        <th>Action</th>
                    </thead>
                        {{ csrf_field() }}
                        <input type="hidden" id="serial_no" value="0" name="serial_jum">
                        <input type="hidden" name="inventory_id" id="inventory_id" value="{{$inventory->inventory_id}}">
                        <tbody id="serial_body">

                        </tbody>
                </table>
            </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" form="form_serial" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_import" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Tambah Serial</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" enctype="multipart/form-data" id="laravel-ajax-file-upload" action="javascript:void(0)"  >
                <div class="form-group">
                  <input type="hidden" name="id" value="{{$inventory->inventory_id}}">
                    <input type="file" name="file" id="serial_excel" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Import</button>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

      <script type="text/javascript">
        $(document).ready(function() {
            var id = {!! json_encode($id) !!};
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
                ajax: '/inventory/barang_masuk/snMode/get/'+id,
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
                      window.location.reload();
                      }
                  }
              });
            }
          })
        })
      </script>

      <script>
        $(document).ready(function () {
          $('#button_modal').click(function () {
            $('#serial_tambah').val('');
              $('#serial_body').html('');
            $('#modal_tambah').modal('show');
          })
        })
      </script>

<script>
  $(document).ready(function () {
    $('#button_import').click(function () {
      $('#modal_import').modal('show');
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
            url: '/inventory/barang_masuk/snHapus',
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
                }
            }
        });
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
        url: "/inventory/barang_masuk/snImport",
        data: formData,
        processData: false,
        contentType: false,
        success: (result) => {
         if (result.res === 'berhasil') {
          new PNotify({
              title: 'Success!!',
              text: 'Berhasil!',
              type: 'success',
              styling: 'bootstrap3'
          });
          $('#modal_import').modal('hide');
          $('#data_barang').DataTable().ajax.reload();
         }
        }
      });
    });
  });
  </script>

<!-- gsc -->

<script>
    function detail_po(id) {
        $('#detail_barang').html('');
        $('#detail_id').val('');
        $('#detail_id').val(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/gsc/pogsc/detail',
            data: { id:id}, 
            success: function( result ) {
                if (result.res === 'berhasil') {
                    $.each(result.data, function (key, value) {
                        $('#detail_barang').append(
                            '<tr>' +
                                '<td>'+value.nama_barang+'</td>' +
                                '<td>'+value.spek+'</td>' +
                                '<td>'+value.quantity+'</td>' +
                                '<td>'+value.harga_barang_satuan+'</td>' +
                                '<td>'+value.harga_beli_satuan+'</td>' +
                            '</tr>'
                        )
                    });
                    $('#modal_detail').modal('show');
                }
            }
        });
    }
</script>

<script>
    $('#serial_tambah').on('keypress',function(e) {
    if(e.which == 13) {
            var inventory_awal = $('#inventory_awal').val();
            var no = parseInt($('#serial_no').val());
            if (inventory_awal == no) {
                new PNotify({
                    title: 'Error!!',
                    text: 'Kuota Serial Terpenuhi!',
                    type: 'error',
                    styling: 'bootstrap3'
                });
            } else {
                no = no + 1;
                $('#serial_no').val(no);
                var sn = $('#serial_tambah').val();
                $('#serial_body').append(
                    '<tr id="tr'+no+'">' +
                        '<td><input name="serialName[]" value="' + sn +'" class="form-control" readonly></td>' +
                        '<td><button onclick="serialHapus('+no+')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button><td>' +
                    '<tr>'
                );
                $('#serial_tambah').val('');
            }
        }
    });
</script>

<script>
    function serialHapus(no) {
        var data = $('#serial_no').val();
        $('#tr'+no).remove();
        data = data - 1;
        $('#serial_no').val(data);
    }
</script>


@endsection