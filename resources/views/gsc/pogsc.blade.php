@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> PO GSC <small>Table</small></h2>
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
                          <table id="data_po" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>Nama Disti</th>
                                <th width="10%">NO PO</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Other Information</th>
                                <th width="5%">Detail Barang</th>
                                <th width="20%">Action</th>
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
              <h4 class="modal-title" id="myModalLabel">Buat PO baru</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <b>Distributor</b>
                  <hr>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="">Nama Disti</label>
                    <input id="nama_disti" class="form-control" autocomplete="off">
                    <div id="nama_disti_select"></div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="">To</label>
                    <input type="text" class="form-control" id="to_name" placeholder="Mr/Mrs..">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="">No Telp</label>
                    <input type="text" class="form-control" id="no_telp">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="Fax">Fax</label>
                    <input type="text" class="form-control" id="fax">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="" id="alamat" class="form-control"></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <br>
                  <b>Pengiriman</b>
                  <hr>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="gudang">Gudang</label>
                    <select name="" id="gudang_id" class="form-control">
                      <option value="-- Other --">-- Other --</option>
                    </select>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="ship_to">Alamat Pengiriman</label>
                    <textarea name="" id="ship_to" class="form-control"></textarea>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" id="nama_pengiriman">
                  </div>
                </div>
                <div class="col-6">
                  <label for="">No Telp</label>
                  <input type="text" class="form-control" id="no_telp_pengiriman">
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="">No PO</label>
                    <input type="text" class="form-control" id="no_po">
                </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="">Other Information</label>
                    <textarea id="noted" class="form-control"></textarea>
                </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="Payment">Payment Terms</label>
                    <input type="text" class="form-control" id="payment_terms">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_po" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_edit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Edit Data PO GSC</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <b>Distributor</b>
                  <hr>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="">Nama Disti</label>
                    <input id="nama_disti_edit" class="form-control">
                      <input type="hidden" id="edit_id">
                </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="">To</label>
                    <input type="text" class="form-control" id="to_name_edit" placeholder="Mr/Mrs..">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="">No Telp</label>
                    <input type="text" class="form-control" id="no_telp_edit">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="Fax">Fax</label>
                    <input type="text" class="form-control" id="fax_edit">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat_edit">
                  </div>
                </div>
                <div class="col-12">
                  <br>
                  <b>Pengiriman</b>
                  <hr>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="gudang">Gudang</label>
                    <select name="" id="gudang_id_edit" class="form-control">
                      <option value="">-- Other --</option>
                    </select>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="ship_to">Alamat Pengiriman</label>
                    <textarea name="" id="ship_to_edit" class="form-control" data-editor="ClassicEditor"></textarea>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" id="nama_pengiriman_edit">
                  </div>
                </div>
                <div class="col-6">
                  <label for="">No Telp</label>
                  <input type="text" class="form-control" id="no_telp_pengiriman_edit">
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="">No PO</label>
                    <input type="text" class="form-control" id="no_po_edit">
                </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="">Other Information</label>
                    <textarea id="noted_edit" class="form-control"></textarea>
                </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="payment_terms_edit">Paymnet Terms</label>
                    <input type="text" class="form-control" id="payment_terms_edit">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_edit_po" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_hapus" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Hapus Data PO GSC</h4>
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
              <h4 class="modal-title" id="myModalLabel">Detail PO</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" id="detail_id">
                        <button class="btn btn-primary float-right" id="detail_edit">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>
                    </div>
                    <div class="col-12" id="modal_table">
                        <table class="table table-striped">
                            <thead>
                                <th>Nama Barang</th>
                                <th>Spek</th>
                                <th>PN</th>
                                <th>SKU</th>
                                <th>Quantity</th>
                                <th>Harga Beli</th>
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

      <script>
        $(document).ready(function () {
          var gudang = {!! json_encode($gudang->toArray()) !!};
          console.log(gudang)
          $.each(gudang, function (key,value) {
              $('#gudang_id').append($("<option></option>").attr("value", value.gudang_id).text(value.nama_gudang)); 
          })
          $('#gudang_id').select2({
              theme :'bootstrap',
              formatSelectionTooBig: function (limit) {

                  // Callback

                  return 'Too many selected items';
              }
          });
          
          $("#gudang_id").select2({
              width: '100%' // need to override the changed default
          });

          $.each(gudang, function (key,value) {
              $('#gudang_id_edit').append($("<option></option>").attr("value", value.gudang_id).text(value.nama_gudang)); 
          })
          $('#gudang_id_edit').select2({
              theme :'bootstrap',
              formatSelectionTooBig: function (limit) {

                  // Callback

                  return 'Too many selected items';
              }
          });
          $("#gudang_id_edit").select2({
              width: '100%' // need to override the changed default
          });
        })
      </script>

<script>
  $(document).ready(function(){
    $('#gudang_id').change(function(){
      var gudang_id = $(this).val();
      if (gudang_id === '') {
        $('#ship_to').html('');
      } else {
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/gsc/gudang/autofillCom',
            data: { gudang_id:gudang_id }, 
            success: function( result ) {
               $('#ship_to').html('');
               $('#ship_to').html(result.alamat_gudang);
            }
        });
      }
    })
  })
</script>

<script>
  $(document).ready(function(){
    $('#gudang_id_edit').change(function(){
      var gudang_id = $(this).val();
      if (gudang_id === '') {
        $('#ship_to_edit').val('');
      } else {
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/gsc/gudang/autofillCom',
            data: { gudang_id:gudang_id }, 
            success: function( result ) {
               $('#ship_to_edit').val('');
               $('#ship_to_edit').val(result.alamat_gudang);
            }
        });
      }
    })
  })
</script>

      <script>
        $(document).ready(function(){
          $('#nama_disti').keyup(function(){
            var nama_disti = $(this).val();
            var html = '';
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  type: "POST",
                  url: '/gsc/pogsc/autofill',
                  data: { nama_disti:nama_disti }, 
                  success: function( result ) {
                    $.each( result.data, function(key, value) {
                      html = html + "<a onclick=autofill('"+value.disti_id+"')>"+value.nama_disti+"</a><br>";
                    })
                      $('#nama_disti_select').show();
                      $('#nama_disti_select').html(html);
                  }
              });
          })
        })
      </script>

      <script>
        function autofill(disti_id) {
          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  type: "POST",
                  url: '/gsc/pogsc/autofillCom',
                  data: { disti_id:disti_id }, 
                  success: function( result ) {
                      $('#nama_disti').val('');
                      $('#nama_disti').val(result.data.nama_disti);
                      $('#alamat').html(result.data.alamat_disti);
                  }
              });
          $('#nama_disti_select').hide();
        }
      </script>


      <script type="text/javascript">
        $(document).ready(function() {
            $('#data_po').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'Contoh File PDF Datatables'},
                    {extend: 'excel', title: 'Contoh File Excel Datatables'},
                    {extend:'print',title: 'Contoh Print Datatables'},
                ],
                ajax: '/gsc/pogsc/view',
                columns: [
                    {data: 'nama_disti', name: 'nama_disti'},
                    {data: 'no_po_gsc', name: 'no_po_gsc'},
                    {data: 'tanggal', name: 'tanggal'},
                    {data: 'status', name: 'status' },
                    {data: 'noted', name: 'noted' },
                    {data: 'detail', name:'detail', orderable: false, searchable:false},
                    {data: 'action', name:'action', orderable: false, searchable:false},
                ],
            });
        });
        </script>

      <script>
        $(document).ready(function () {
          $('#save_po').click(function () {
            var nama_disti = $('#nama_disti').val();
            var no_po = $('#no_po').val();
            var noted = $('#noted').val();
            var payment_terms = $('#payment_terms').val();
            var to_name = $('#to_name').val();
            var no_telp = $('#no_telp').val();
            var fax = $('#fax').val();
            var alamat = $('#alamat').val();
            var gudang_id = $('#gudang_id').val();
            var ship_to = $('#ship_to').val();

            if (nama_disti === '' || no_po === '' || noted === '' || payment_terms === '' || to_name === '' || no_telp === '' || fax === '' || alamat === '' || ship_to == '') {
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
                  url: '/gsc/pogsc/tambah',
                  data: { nama_disti:nama_disti, no_po:no_po, noted:noted, payment_terms:payment_terms, to_name:to_name, no_telp:no_telp, fax:fax, alamat:alamat, ship_to:ship_to, gudang_id:gudang_id }, 
                  success: function( result ) {
                      if (result.res === 'success') {
                        new PNotify({
                          title: 'Success!!',
                          text: 'Data Berhasil di tambah!',
                          type: 'success',
                          styling: 'bootstrap3'
                      });
                      $('#modal_tambah').modal('hide');
                      $('#data_po').DataTable().ajax.reload();
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

            const monthNames = ["I", "II", "III", "IV", "V", "VI",
            "VII", "VII", "IX", "X", "XI", "XII"
            ];

            const d = new Date();
            var bulan =  monthNames[d.getMonth()];
            var tahun = d.getFullYear();
            var po = 'GSC/PO/' + tahun + '/' + bulan + '/';
            $('#nama_disti').val('');
            $('#no_po').val(po);
            $('#noted').val('');
            $('#paymnet_terms').val('');

            $('#modal_tambah').modal('show');
          })
        })
      </script>

      

      <script>
        function edit_po(id) {
          $('#nama_disti_edit').val('');
            $('#no_po_edit').val('');
            $('#noted_edit').val('');
            $('#to_name_edit').val('');
            $('#no_telp_edit').val('');
            $('#fax_edit').val('');
            $('#edit_id').val('');
            $('#payment_terms_edit').val('');
            $('#alamat_edit').val('');
            $('#gudang_id_edit').val('');
            $('#ship_to_edit').val('');

          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
            $.ajax({
                type: "POST",
                url: '/gsc/pogsc/editGet',
                data: { id:id }, 
                success: function( result ) {
                    if (result.res === 'berhasil') {
                        $('#nama_disti_edit').val(result.data.nama_disti);
                        $('#no_po_edit').val(result.data.no_po_gsc);
                        $('#noted_edit').val(result.data.noted);
                        $('#edit_id').val(result.data.data_barang_id);
                        $('#payment_terms_edit').val(result.data.payment_terms);
                        $('#to_name_edit').val(result.data.name);
                        $('#no_telp_edit').val(result.data.no_telp);
                        $('#fax_edit').val(result.data.fax);
                        $('#alamat_edit').val(result.data.alamat);
                        $('#gudang_id_edit').val(result.data.gudang_id);
                        $('#ship_to_edit').val(result.data.ship_to)
                        $('#modal_edit').modal('show');
                      }
                    }
            });
        }
      </script>

<script>
  $(document).ready(function () {
    $('#save_edit_po').click(function () {
      var nama_disti = $('#nama_disti_edit').val();
      var no_po = $('#no_po_edit').val();
      var noted = $('#noted_edit').val();
      var id = $('#edit_id').val();
      var payment_terms = $('#payment_terms_edit').val();
      var to_name = $('#to_name_edit').val();
      var no_telp = $('#no_telp_edit').val();
      var fax = $('#fax_edit').val();
      var alamat = $('#alamat_edit').val();
      var gudang_id = $('#gudang_id_edit').val();
      var ship_to = $('#ship_to_edit').val();


      if (nama_disti === '' || no_po === '' || noted === '' || to_name === '' || no_telp === '' || fax === '' || alamat === '' || ship_to === '') {
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
            url: '/gsc/pogsc/editStore',
            data: { id:id,nama_disti:nama_disti, no_po:no_po, noted:noted, payment_terms:payment_terms, to_name:to_name, no_telp:no_telp, fax:fax, alamat:alamat,ship_to:ship_to, gudang_id:gudang_id }, 
            success: function( result ) {
                if (result.res === 'berhasil') {
                  new PNotify({
                    title: 'Success!!',
                    text: 'Data Berhasil di Edit!',
                    type: 'success',
                    styling: 'bootstrap3'
                });
                $('#modal_edit').modal('hide');
                $('#data_po').DataTable().ajax.reload();
                }
            }
        });
      }
    })
  })
</script>

<script>
  function hapus_po(id) {
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
            url: '/gsc/pogsc/hapus',
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
                $('#data_po').DataTable().ajax.reload();
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
                  console.log(result.status)
                  if (result.status.status === 'diterima') {
                    $('#detail_edit').attr('disabled','');
                  } else {
                    $('#detail_edit').removeAttr('disabled','');
                  }
                    $.each(result.data, function (key, value) {
                        $('#detail_barang').append(
                            '<tr>' +
                                '<td>'+value.nama_barang+'</td>' +
                                '<td>'+value.spek+'</td>' +
                                '<td>'+value.pn+'</td>'+
                                '<td>'+value.sku+'</td>' +
                                '<td>'+value.quantity+'</td>' +
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
                              '<td>'+value.harga_beli_satuan+'</td>'+
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
           window.location.href = '/gsc/pogsc/detailEdit/'+id;
        })
    })
</script>


<script>
  $(document).ready(function () {
    $('#terima_button').click(function () {
      var id = $('#konfirmasi_id').val();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: "POST",
          url: '/gsc/pogsc/terima',
          data: { id:id}, 
          success: function( result ) {
              if (result.res === 'berhasil') {
                    new PNotify({
                        title: 'Success!!',
                        text: 'Data Diterima, Barang masuk inventory!',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                  }
                  $('#modal_konfirmasi').modal('hide');
                  $('#data_po').DataTable().ajax.reload();
              }
      });
    })
  })
</script>

<script>
  function print_po(id) {
    window.location.href = "/gsc/pogsc/print/"+id;
  }
</script>

@endsection