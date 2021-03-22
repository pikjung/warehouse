
@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Detail Barang POUSER <small>Table</small></h2>
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
                                <th width="20%">Nama Barang</th>
                                <th width="30%">SPEK</th>
                                <th>PN</th>
                                <th>SKU</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Detail</th>
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
                      <label for="">Pilih Dari Inventory</label>
                      <select name="" id="pilih_barang" class="form-control"></select>
                    </div>
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
                        <label for="">Harga</label>
                        <input type="number" class="form-control" id="harga_barang">
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
                  <label for="">Pilih Dari Inventory</label>
                  <select name="" id="pilih_barang" class="form-control" style="width: 100%"></select>
                </div>
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
                    <input type="number" class="form-control" id="harga_barang_edit">
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
                ajax: '/transaksi/po/detailMode/view/'+id,
                columns: [
                    {data: 'nama_barang', name: 'nama_barang'},
                    {data: 'spek', name: 'spek'},
                    {data: 'pn', name: 'pn'},
                    {data: 'sku', name: 'sku'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'harga_barang_satuan', name: 'harga_barang_satuan' },
                    {data: 'total', name: 'total' },
                    {data: 'detail', name : 'detail' },
                    {data: 'action', name:'action', orderable: false, searchable:false},
                ],
            });
        });
        </script>

      <script>
        $(document).ready(function () {
          var barang = {!! json_encode($barang->toArray()) !!};
          console.log(barang)
          $.each(barang, function (key,value) {
              $('#pilih_barang').append($("<option></option>").attr("value", value.inventory_id).text(value.nama_barang + '|' + value.nama_gudang)); 
          })
          $('#pilih_barang').select2({
              theme :'bootstrap',
              formatSelectionTooBig: function (limit) {

                  // Callback

                  return 'Too many selected items';
              }
          });
          
          $("#pilih_barang").select2({
              width: '100%' // need to override the changed default
          });

          $.each(barang, function (key,value) {
              $('#pilih_barang_edit').append($("<option></option>").attr("value", value.inventory_id).text(value.nama_barang + '|' + value.nama_gudang)); 
          })
          $('#pilih_barang_edit').select2({
              theme :'bootstrap',
              formatSelectionTooBig: function (limit) {

                  // Callback

                  return 'Too many selected items';
              }
          });
          $("#pilih_barang_edit").select2({
              width: '100%' // need to override the changed default
          });
        })
      </script>

      <script>
        $(document).ready(function(){
          $('#pilih_barang').change(function(){
            var pilih_barang = $(this).val();
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  type: "POST",
                  url: '/transaksi/detail/autofillCom',
                  data: { pilih_barang:pilih_barang }, 
                  success: function( result ) {
                     $('#nama_barang').val('');
                     $('#spek').val('');
                     $('#part_number').val('');
                     $('#sku').val('');
                     $('#nama_barang').val(result.nama_barang);
                     $('#spek').val(result.spek);
                     $('#part_number').val(result.pn);
                     $('#sku').val(result.sku);
                  }
              });
          })
        })
      </script>

      <script>
        $(document).ready(function(){
          $('#pilih_barang_edit').change(function(){
            var pilih_barang = $(this).val();
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  type: "POST",
                  url: '/transaksi/detail/autofillCom',
                  data: { pilih_barang:pilih_barang }, 
                  success: function( result ) {
                     $('#nama_barang_edit').val('');
                     $('#spek_edit').val('');
                     $('#part_number_edit').val('');
                     $('#sku_edit').val('');
                     $('#nama_barang_edit').val(result.nama_barang);
                     $('#spek_edit').val(result.spek);
                     $('#part_number_edit').val(result.pn);
                     $('#sku_edit').val(result.sku);
                  }
              });
          })
        })
      </script>

      <script>
        $(document).ready(function () {
          $('#save_detail').click(function () {
            var id = {!! json_encode($id) !!};
            var nama_barang = $('#nama_barang').val();
            var spek = $('#spek').val();
            var quantity = $('#quantity').val();
            var harga_barang = $('#harga_barang').val();
            var pn = $('#part_number').val();
            var sku = $('#sku').val();

            if (nama_barang === '' || spek === '' || quantity === '' || harga_barang === '') {
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
                  url: '/transaksi/po/detailMode/tambah',
                  data: { id:id,nama_barang:nama_barang, spek:spek, quantity:quantity , harga_barang:harga_barang, pn:pn, sku:sku}, 
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
                      } else {
                        new PNotify({
                          title: 'Warning!!',
                          text: 'Status PO Terkirim, sudah tidak bisa menambah data!',
                          type: 'warning',
                          styling: 'bootstrap3'
                        });
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
            $('#harga_barang').val('');

            $('#modal_tambah').modal('show');
          })
        })
      </script>

      

      <script>
        function edit_pouser_det(id) {
            $('#nama_barang_edit').val('');
            $('#spek_edit').val('');
            $('#quantity_edit').val('');
            $('#harga_barang_edit').val(''); 
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
                url: '/transaksi/po/detailMode/editGet',
                data: { id:id }, 
                success: function( result ) {
                    if (result.res === 'berhasil') {
                        $('#nama_barang_edit').val(result.data.nama_barang);
                        $('#spek_edit').val(result.data.spek);
                        $('#quantity_edit').val(result.data.quantity);
                        $('#harga_barang_edit').val(result.data.harga_barang_satuan); 
                        $('#edit_id').val(result.data.userReq_det_id);
                        $('#part_number_edit').val(result.data.pn);
                        $('sku_edit').val(result.data.sku);
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
      var harga_barang = $('#harga_barang_edit').val(); 
      var id = $('#edit_id').val();
      var pn = $('#part_number_edit').val();
      var sku = $('#sku_edit').val();

      if (nama_barang === '' || spek === '' || quantity === '' || harga_barang === '') {
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
            url: '/transaksi/po/detailMode/editStore',
            data: { id:id,nama_barang:nama_barang, spek:spek, quantity:quantity, harga_barang:harga_barang, pn:pn, sku:sku}, 
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
  function hapus_pouser_det(id) {
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
            url: '/transaksi/po/detailMode/hapus',
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
    function serial_pouser(id) {
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
            url: '/transaksi/po/detailMode/serial/view',
            data: { id:id}, 
            success: function( result ) {
                if (result.res === 'berhasil') {
                    $.each(result.data, function (key, value) {
                        $('#detail_barang').append(
                            '<tr>' +
                                '<td>'+value.no_serial+'</td>' +
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
            url: '/transaksi/po/detailMode/serial/view',
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
      $(document).ready(function () {
          $('#detail_edit').click(function () {
            var status = {!! json_encode($status) !!};
              var id = $('#detail_id').val();
              window.location.href = '/transaksi/po/detailMode/serial/'+id+'/'+status;
          })
      })
  </script>
@endsection