@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Detail Barang <small>Table</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                <th width="10%">Nama Barang</th>
                                <th width="10%">SPEK</th>
                                <th>PN</th>
                                <th>SKU</th>
                                <th>Qty</th>
                                <th>Harga Beli</th>
                                <th>Total</th>
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
        <div class="modal-dialog modal-lg">
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
                        <textarea id="spek" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="">Part Number</label>
                      <textarea id="part_number" class="form-control"></textarea>
                  </div>
                    <div class="form-group">
                      <label for="">SKU</label>
                      <textarea id="sku" class="form-control"></textarea>
                  </div>
                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" class="form-control" id="quantity">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Beli</label>
                        <input type="number" class="form-control" id="harga_beli">
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_detail" class="btn btn-primary">Save changes</button>
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
                    <label for="">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang_edit">
                    <input type="hidden" id="edit_id">
                </div>
                <div class="form-group">
                    <label for="">SPEK</label>
                    <textarea id="spek_edit" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="">Part Number</label>
                  <textarea id="part_number_edit" class="form-control"></textarea>
                </div>
                  <div class="form-group">
                    <label for="">SKU</label>
                    <textarea id="sku_edit" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Quantity</label>
                    <input type="number" class="form-control" id="quantity_edit">
                </div>
                <div class="form-group">
                    <label for="">Harga Beli</label>
                    <input type="number" class="form-control" id="harga_beli_edit">
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
              <h4 class="modal-title" id="myModalLabel">Hapus Data Barang</h4>
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
                ajax: '/gsc/pogsc/detailEdit/view/'+id,
                columns: [
                    {data: 'nama_barang', name: 'nama_barang'},
                    {data: 'spek', name: 'spek'},
                    {data: 'pn', name: 'pn'},
                    {data: 'sku', name: 'sku'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'harga_beli_satuan', name: 'harga_beli_satuan' },
                    {data: 'total_beli', name: 'total_beli' },
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
            var pn = $('#part_number').val();
            var sku = $('#sku').val();

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
                  data: { id:id,nama_barang:nama_barang, spek:spek, quantity:quantity , harga_beli:harga_beli, pn:pn, sku:sku}, 
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
            $('#harga_beli').val('');

            $('#modal_tambah').modal('show');
          })
        })
      </script>

      

      <script>
        function edit_detail(id) {
            $('#nama_barang_edit').val('');
            $('#spek_edit').val('');
            $('#quantity_edit').val('');
            $('#harga_beli_edit').val(''); 
            $('#edit_id').val('');
            $('#part_number_edit').val('');
            $('#sku_edit').val('');
          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
            $.ajax({
                type: "POST",
                url: '/gsc/pogsc/detailEdit/editGet',
                data: { id:id }, 
                success: function( result ) {
                    if (result.res === 'berhasil') {
                        $('#nama_barang_edit').val(result.data.nama_barang);
                        $('#spek_edit').val(result.data.spek);
                        $('#quantity_edit').val(result.data.quantity);
                        $('#harga_beli_edit').val(result.data.harga_beli_satuan); 
                        $('#edit_id').val(result.data.detData_barang_id);
                        $('#sku_edit').val(result.data.sku);
                        $('#part_number_edit').val(result.data.pn);
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
      var harga_beli = $('#harga_beli_edit').val(); 
      var id = $('#edit_id').val();
      var pn = $('#part_number_edit').val();
      var sku = $('#sku_edit').val();

      if (nama_barang === '' || spek === '' || quantity === '' || harga_beli === '') {
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
            url: '/gsc/pogsc/detailEdit/editStore',
            data: { id:id,nama_barang:nama_barang, spek:spek, quantity:quantity, harga_beli:harga_beli, pn:pn, sku:sku}, 
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
  function hapus_detail(id) {
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
            url: '/gsc/pogsc/detailEdit/hapus',
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
    $(document).ready(function () {
        $('#detail_edit').click(function () {
           var id =  $('#detail_id').val();
           window.location.href = '/gsc/pogsc/detailEdit/'+id;
        })
    })
</script>

<script>
    $('#nama_disti').select2({
        theme: "bootstrap",
        tags: true,
        dropdownParent: $("#modal_tambah"),
        ajax: {
      url: '/gsc/pogsc/select',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.nama_disti,
              id: item.nama_disti
            }
          })
        };
      },
      cache: true
    }
});
</script>
  
<script>
    $('#nama_disti_edit').select2({
        theme: "bootstrap",
        tags: true,
        dropdownParent: $("#modal_edit"),
        ajax: {
      url: '/gsc/pogsc/select',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.nama_disti,
              id: item.nama_disti
            }
          })
        };
      },
      cache: true
    }
});
</script>

@endsection