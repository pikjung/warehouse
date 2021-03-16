@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Barang Masuk <small>Table</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li>
                    <button type="button" class="btn btn-sm btn-info" id="button_transfer">Transfer Barang</button>
                  </li>
                  <li>
                    <button type="button" class="btn btn-sm btn-success" id="button_modal">Tambah Data</button>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          <table id="data_barang" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th width="10%">Nama Disti</th>
                                <th width="10%">Tanggal</th>
                                <th>Nama Barang</th>
                                <th>SPEK</th>
                                <th>Qty</th>
                                <th>SN List</th>
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

      <div id="modal_tambah" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Tambah Data Barang</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang">
                    </div>
                    <div class="form-group">
                        <label for="">SPEK</label>
                        <textarea name="" id="spek" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Qty</label>
                        <input type="number" class="form-control" id="quantity">
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_barang" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_edit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Edit Data Barang</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                  <label for="">Nama Barang</label>
                  <input type="hidden" id="edit_id">
                  <input type="text" class="form-control" id="nama_barang_edit">
              </div>
              <div class="form-group">
                  <label for="">SPEK</label>
                  <textarea name="" id="spek_edit" class="form-control"></textarea>
              </div>
              <div class="form-group">
                  <label for="">Qty</label>
                  <input type="number" class="form-control" id="quantity_edit">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_edit_barang" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_hapus" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Hapus Data Inventory</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="row">
                    <div class="col-6">
                      <input type="hidden" id="hapus_id">
                      <button id="hapus_button" class="btn btn-danger">
                        <i class="glyphicon glyphicon-trash"></i> Ya, saya yakin
                      </button>
                    </div>
                    <div class="col-6">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
            </div>
          </div>
        </div>
      </div>

      <div id="modal_detail" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">List SN</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" id="detail_id"> 
                        <button class="btn btn-info float-right" id="detail_view">
                          <i class="glyphicon glyphicon-eye-open"></i>
                        </button>
                        <button class="btn btn-primary float-right" id="detail_edit">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>
                    </div>
                    <div class="col-12" id="modal_table">
                        <table class="table table-striped" id="table_detail">
                            <thead>
                                <th>Serial</th>
                            </thead>
                            <tbody id="detail_barang">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_konfirmasi" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Konfirmasi terima barang</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" id="konfirmasi_id">
                    </div>
                    <div class="col-12" id="modal_table">
                        <table class="table table-striped">
                            <thead>
                                <th>Nama Barang</th>
                                <th>Spek</th>
                                <th>Quantity</th>
                                <th>Harga Jual</th>
                                <th>Harga Beli</th>
                            </thead>
                            <tbody id="konfirmasi_barang">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" id="terima_button"><i class="glyphicon glyphicon-arrow-right"></i> Terima Barang</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_sn" class="modal fade bs-example-modal-lg" tabindex="99999" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">SN</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                   <div id="detail_body">
                    <textarea name="" id="detail_body_area" class="form-control" rows="10"></textarea>
                   </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-info" onclick="copyFun()">Copy</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                ajax: '/inventory/barang_masuk/view/'+id,
                columns: [
                    {data: 'nama_disti', name: 'nama_disti'},
                    {data: 'tanggal', name: 'tanggal'},
                    {data: 'nama_barang', name: 'nama_barang'},
                    {data: 'spek', name: 'spek' },
                    {data: 'quantity', name: 'quantity' },
                    {data: 'sn', name:'sn', orderable: false, searchable:false},
                    {data: 'action', name:'action', orderable: false, searchable:false},
                ],
            });
        });
        </script>

      <script>
        $(document).ready(function () {
          $('#save_barang').click(function () {
            var nama_barang = $('#nama_barang').val();
            var spek = $('#spek').val();
            var quantity = $('#quantity').val();

            if (nama_barang === '' || spek === '' || quantity === '') {
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
                  url: '/inventory/barang_masuk/tambah',
                  data: { nama_barang:nama_barang, spek:spek, quantity:quantity}, 
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

      <script>
        $(document).ready(function () {
          $('#button_modal').click(function () {

            $('#nama_barang').val('');
            $('#spek').val('');
            $('#quantity').val('');

            $('#modal_tambah').modal('show');
          })
        })
      </script>

      

      <script>
        function edit_inventory(id) {
            $('#nama_barang_edit').val('');
            $('#spek_edit').val('');
            $('#quantity_edit').val('');
            $('#harga_beli_edit').val('');
            $('#harga_jual_edit').val('');
            $('#edit_id').val('');
          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
            $.ajax({
                type: "POST",
                url: '/inventory/barang_masuk/editGet',
                data: { id:id }, 
                success: function( result ) {
                    if (result.res === 'berhasil') {
                      $('#nama_barang_edit').val(result.data.nama_barang);
                      $('#spek_edit').val(result.data.spek);
                      $('#quantity_edit').val(result.data.quantity);
                      $('#harga_beli_edit').val(result.data.harga_beli_satuan);
                      $('#harga_jual_edit').val(result.data.harga_barang_satuan);
                      $('#edit_id').val(result.data.inventory_id);
                        $('#modal_edit').modal('show');
                      }
                    }
                
            });
        }
      </script>

<script>
  $(document).ready(function () {
    $('#save_edit_barang').click(function () {
      var nama_barang = $('#nama_barang_edit').val();
      var spek = $('#spek_edit').val();
      var quantity = $('#quantity_edit').val();
      var id = $('#edit_id').val();

      if (nama_barang === '' || spek === '' || quantity === '') {
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
            url: '/inventory/barang_masuk/editStore',
            data: { id:id,nama_barang:nama_barang, spek:spek, quantity:quantity }, 
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
  function hapus_inventory(id) {
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
            url: '/inventory/barang_masuk/hapus',
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

<!-- gsc -->

<script>
    function sn_detail(id) {
        $('#detail_id').val('');
        $('#detail_id').val(id);
        $('#detail_barang').html('');
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: "POST",
          url: '/inventory/barang_masuk/sn_view',
          data: { id:id}, 
          success: function( result ) {
              if (result.res === 'berhasil') {
                  $.each(result.data, function (key, value) {
                      $('#detail_barang').append(
                          '<tr>' +
                              '<td>'+value.no_serial+'</td>' +
                              '<td></td>'+
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
  function konfirmasi_po(id) {
      $('#konfirmasi_barang').html('');
      $('#konfirmasi_id').val('');
      $('#konfirmasi_id').val(id);
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
                      $('#konfirmasi_barang').append(
                          '<tr>' +
                              '<td>'+value.nama_barang+'</td>' +
                              '<td>'+value.spek+'</td>' +
                              '<td>'+value.quantity+'</td>' +
                              '<td>'+value.harga_barang_satuan+'</td>' +
                              '<td>'+value.harga_beli_satuan+'</td>' +
                          '</tr>'
                      )
                  });
                  $('#modal_konfirmasi').modal('show');
                  
              }
          }
      });
  }
</script>

<script>
    $(document).ready(function () {
        $('#detail_edit').click(function () {
           var id =  $('#detail_id').val();
           window.location.href = '/inventory/barang_masuk/snMode/'+id;
        })
    })
</script>

<script>
  $(document).ready(function () {
      $('#detail_view').click(function () {
         var id =  $('#detail_id').val();
         $('#detail_body_area').val('')
         var jum = ',';
         $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: "POST",
          url: '/inventory/barang_masuk/sn_view',
          data: { id:id}, 
          success: function( result ) {
              if (result.res === 'berhasil') {
                  $.each(result.data, function (key, value) {
                    jum = jum + value.no_serial+",";

                  });
                  $('#detail_body_area').val(jum)
                  $('#modal_sn').modal('show');
              }
          }
      });
      })
  })
</script>

<script>
  function copyFun() {
    var data = document.getElementById('detail_body_area');
    data.select();
    document.execCommand("copy");

      new PNotify({
          title: 'Success!!',
          text: 'Copied to clipboard!',
          type: 'success',
          styling: 'bootstrap3'
      });
    
}
</script>

@endsection