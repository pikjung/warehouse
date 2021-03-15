@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> PO User <small>Table</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li>
                    <a href="/transaksi/arsip" role="button" class="btn btn-sm btn-primary text-light">Data Arsip</a>
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
                          <table id="data_pouser" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th width="10%">PO No</th>
                                <th width="10%">DN No.</th>
                                <th>Status</th>
                                <th>Noted</th>
                                <th width="5%">Detail Barang</th>
                                <th width="20%">Action</th>
                                <th>Print</th>
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
                <div class="col-6">
                  <div class="form-group">
                    <label for="">Customer</label>
                    <input id="nama_customer" class="form-control" autocomplete="off">
                    <div id="nama_customer_select"></div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="">Attn</label>
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
                <div class="col-6">
                  <div class="form-group">
                    <label for="">PO NO.</label>
                    <input type="text" class="form-control" id="no_po">
                  </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                      <label for="">DN NO.</label>
                      <input type="text" class="form-control" id="dn_no">
                    </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="">Noted</label>
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
              <button type="button" id="save_pouser" class="btn btn-primary">Save changes</button>
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
                    <div class="col-6">
                        <div class="form-group">
                          <label for="">Customer</label>
                          <input id="nama_customer_edit" class="form-control">
                          <input type="hidden" id="edit_id">
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Attn</label>
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
                          <textarea name="" id="alamat_edit" class="form-control"></textarea>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">PO NO.</label>
                          <input type="text" class="form-control" id="no_po_edit">
                        </div>
                      </div>
                      <div class="col-6">
                          <div class="form-group">
                            <label for="">DN NO.</label>
                            <input type="text" class="form-control" id="dn_no_edit">
                          </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Noted</label>
                          <textarea id="noted_edit" class="form-control"></textarea>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="Payment">Payment Terms</label>
                          <input type="text" class="form-control" id="payment_terms_edit">
                        </div>
                      </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_edit_pouser" class="btn btn-primary">Save changes</button>
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
              <h4 class="modal-title" id="myModalLabel">Detail Barang PO User</h4>
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
                                <th>Harga</th>
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

      <div id="modal_inv" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Isi Inv NO</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <div class="text-right" id="tambahan_invoice">
                </div>
              </div>
                <div class="form-group">
                  <label for="">INV No. *Tanggal Pada inv di buat pada pengisian No inv</label>
                  <input type="hidden" id="inv_id">
                  <input type="text" class="form-control" id="inv_po">
                  <div class="text-danger" id="inv_pesan"></div>
                </div>
                <div class="form-group">
                  <label for="">Diskon</label>
                  <input type="text" class="form-control" id="disc">
                </div>
            </div>
            <div class="modal-footer">
              <div id="inv_edit"></div>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" id="inv_button"><i class="glyphicon glyphicon-arrow-right"></i> Selesai</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_paket" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Paket</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div id="paket_body">

                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_payment" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Payment Confirm</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <input type="hidden" id="payment_id">
                  <button id="payment_button" class="btn btn-primary">
                    <i class="glyphicon glyphicon-usd"></i> Payment
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

      <div id="modal_arsip" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Arsip Confirm</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <h5 class="text-warning">Data berikut akan di Arsip, data tidak dapat di hapus maupun di edit. Klik Arsip untuk melanjutkan.</h5>
                  <br><br>
                </div>
                <div class="col-6">
                  <input type="hidden" id="arsip_id">
                  <button id="arsip_button" class="btn btn-primary">
                    <i class="glyphicon glyphicon-file"></i> Arsip
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

      <script>
        $(document).ready(function(){
          $('#nama_customer').keyup(function(){
            var nama_customer = $(this).val();
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  type: "POST",
                  url: '/transaksi/po/autofill',
                  data: { nama_customer:nama_customer }, 
                  success: function( result ) {
                      $('#nama_customer_select').show();
                      $('#nama_customer_select').html(result)
                      
                  }
              });
          })
        })
      </script>

<script>
  $(document).ready(function(){
    $('#nama_customer').change(function(){
      $('#nama_customer_select').hide('')
      var nama_customer = $(this).val();
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/transaksi/po/autofillCom',
            data: { nama_customer:nama_customer }, 
            success: function( result ) {
              $('#nama_customer').val(result.nama_customer)
                $('#alamat').html(result.alamat)
            }
        });
    })
  })
</script>


      <script type="text/javascript">
        $(document).ready(function() {
            $('#data_pouser').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'Contoh File PDF Datatables'},
                    {extend: 'excel', title: 'Contoh File Excel Datatables'},
                    {extend:'print',title: 'Contoh Print Datatables'},
                ],
                ajax: '/transaksi/po/view',
                columns: [
                    {data: 'po_customer', name: 'po_customer'},
                    {data: 'dn_no', name: 'dn_no'},
                    {data: 'status', name: 'status' },
                    {data: 'noted', name: 'noted' },
                    {data: 'detail', name:'detail', orderable: false, searchable:false},
                    {data: 'action', name:'action', orderable: false, searchable:false},
                    {data: 'print', name:'print', orderable: false, searchable:false},
                ],
            });
        });
        </script>

      <script>
        $(document).ready(function () {
          $('#save_pouser').click(function () {
            var nama_customer = $('#nama_customer').val();
            var no_po = $('#no_po').val();
            var noted = $('#noted').val();
            var payment_terms = $('#payment_terms').val();
            var to_name = $('#to_name').val();
            var no_telp = $('#no_telp').val();
            var fax = $('#fax').val();
            var dn_no = $('#dn_no').val();
            var alamat = $('#alamat').val();

            if (nama_customer === '' || no_po === ''|| dn_no === '' || noted === '' || payment_terms === '' || to_name === '' || no_telp === '' || fax === '' || alamat === '') {
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
                  url: '/transaksi/po/tambah',
                  data: { nama_customer:nama_customer, no_po:no_po,dn_no:dn_no, noted:noted, payment_terms:payment_terms, to_name:to_name, no_telp:no_telp, fax:fax, alamat:alamat }, 
                  success: function( result ) {
                      if (result.res === 'berhasil') {
                        new PNotify({
                          title: 'Success!!',
                          text: 'Data Berhasil di tambah!',
                          type: 'success',
                          styling: 'bootstrap3'
                      });
                      $('#modal_tambah').modal('hide');
                      $('#data_pouser').DataTable().ajax.reload();
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
            $('#nama_customer_select').html('')
            $('#nama_customer').val('');
            $('#no_po').val('');
            $('#noted').val('');
            $('#paymnet_terms').val('');
            $('#alamat').html('');

            $('#modal_tambah').modal('show');
          });
        });
      </script>

      

      <script>
        function edit_pouser(id) {
            $('#nama_customer_edit').val('');
            $('#no_po_edit').val('');
            $('#noted_edit').val('');
            $('#to_name_edit').val('');
            $('#no_telp_edit').val('');
            $('#fax_edit').val('');
            $('#dn_no_edit').val('');
            $('#edit_id').val('');
            $('#payment_terms_edit').val('');
            $('#alamat_edit').val('');

          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
            $.ajax({
                type: "POST",
                url: '/transaksi/po/editGet',
                data: { id:id }, 
                success: function( result ) {
                    if (result.res === 'berhasil') {
                        $('#nama_customer_edit').val(result.data.customer);
                        $('#no_po_edit').val(result.data.po_customer);
                        $('#noted_edit').val(result.data.noted);
                        $('#edit_id').val(result.data.userReq_id);
                        $('#payment_terms_edit').val(result.data.payment_terms);
                        $('#to_name_edit').val(result.data.penerima);
                        $('#no_telp_edit').val(result.data.no_telp);
                        $('#fax_edit').val(result.data.fax);
                        $('#dn_no_edit').val(result.data.dn_no);
                        $('#alamat_edit').val(result.data.alamat);
                        $('#modal_edit').modal('show');
                      }
                    } 
            });
        }
      </script>

<script>
  $(document).ready(function () {
    $('#save_edit_pouser').click(function () {
      var nama_customer = $('#nama_customer_edit').val();
      var no_po = $('#no_po_edit').val();
      var noted = $('#noted_edit').val();
      var id = $('#edit_id').val();
      var payment_terms = $('#payment_terms_edit').val();
      var to_name = $('#to_name_edit').val();
      var no_telp = $('#no_telp_edit').val();
      var dn_no = $('#dn_no_edit').val();
      var fax = $('#fax_edit').val();
      var alamat = $('#alamat_edit').val();


      if (nama_customer === '' || no_po === ''|| dn_no === '' || noted === '' || to_name === '' || no_telp === '' || fax === '' || alamat === '') {
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
            url: '/transaksi/po/editStore',
            data: { id:id,nama_customer:nama_customer, no_po:no_po,dn_no:dn_no ,noted:noted, payment_terms:payment_terms, to_name:to_name, no_telp:no_telp, fax:fax, alamat:alamat }, 
            success: function( result ) {
                if (result.res === 'berhasil') {
                  new PNotify({
                    title: 'Success!!',
                    text: 'Data Berhasil di Edit!',
                    type: 'success',
                    styling: 'bootstrap3'
                });
                $('#modal_edit').modal('hide');
                $('#data_pouser').DataTable().ajax.reload();
                }
            }
        });
      }
    });
  });
</script>

<script>
  function hapus_pouser(id) {
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
            url: '/transaksi/po/hapus',
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
                $('#data_pouser').DataTable().ajax.reload();
                }
            }
        });
    });
  });
</script>

<!-- gsc -->

<script>
    function detail_pouser(id){
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
            url: '/transaksi/po/detail',
            data: { id:id}, 
            success: function( result ) {
                if (result.res === 'berhasil') {
                  console.log(result.status)
                    $.each(result.data, function (key, value) {
                        $('#detail_barang').append(
                            '<tr>' +
                                '<td>'+value.nama_barang+'</td>' +
                                '<td>'+value.spek+'</td>' +
                                '<td>'+value.pn+'</td>'+
                                '<td>'+value.sku+'</td>' +
                                '<td>'+value.quantity+'</td>' +
                                '<td>'+value.harga_barang_satuan+'</td>' +
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
           window.location.href = '/transaksi/po/detailMode/'+id;
        })
    })
</script>

<script>
  function print_invoice(id) {
    window.location.href = "/transaksi/po/print_invoice/"+id;
  }
</script>

<script>
  function print_dn(id) {
    window.location.href = "/transaksi/po/print_dn/"+id;
  }
</script>

<script>
  function data_inv(id) {
        $('#inv_po').val('');
        $('#inv_id').val('');
        $('#disc').val('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/transaksi/po/editGet',
            data: { id:id}, 
            success: function( result ) {
                if (result.res === 'berhasil') {
                  if (result.data.no_invoice === null) {
                    $('#inv_id').val(id);
                    $('#tambahan_invoice').html('<a href="/transaksi/invoice/'+id+'" class="btn btn-sm btn-primary float-right" data-toggle="tooltip" data-placement="top" title="Invoice Tambahan"><i class="fa fa-plus"></i></a>');
                    $('#modal_inv').modal('show');
                  }else {
                    $('#tambahan_invoice').html('<a href="/transaksi/invoice/'+id+'" class="btn btn-sm btn-primary float-right" data-toggle="tooltip" data-placement="top" title="Invoice Tambahan"><i class="fa fa-plus"></i></a>');
                    $('#inv_pesan').html('<b>No Inv Sudah diisi, Klik EDIT untuk merubah</b>')
                    $('#inv_edit').html('<button class="btn btn-primary" onclick="edit_inv_button()">Edit</button>')
                    $('#inv_po').val(result.data.no_invoice)
                    $('#disc').val(result.data.disc)
                    $('#inv_po').attr('readonly','')
                    $('#disc').attr('readonly','')
                    $('#inv_button').attr('disabled','')
                    $('#inv_id').val(id);
                    $('#modal_inv').modal('show');
                  }
            }
            }
          });
  }
</script>

<script>
 function edit_inv_button() {
      $('#inv_po').removeAttr('readonly','')
      $('#disc').removeAttr('readonly','')
      $('#inv_button').removeAttr('disabled','')
 }
</script>

<script>
  $(document).ready(function () {
    $('#inv_button').click(function () {
            var inv_po = $('#inv_po').val();
            var inv_id = $('#inv_id').val();
            var disc = $('#disc').val();

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/transaksi/po/inv',
            data: { id:inv_id, inv_po : inv_po, disc:disc}, 
            success: function( result ) {
                if (result.res === 'berhasil') {
                  new PNotify({
                    title: 'Success!!',
                    text: 'Data INV Berhasil di Update!',
                    type: 'success',
                    styling: 'bootstrap3'
                });
                $('#data_pouser').DataTable().ajax.reload();
                $('#modal_inv').modal('hide');
            }
            }
          });
    })
  })
</script>

<script>
  function lihat_paket(id) {
    $('#paket_body').html('');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/transaksi/po/lihat_paket',
            data: { id:id}, 
            success: function( result ) {
                if (result.res === 'berhasil') {
                  $('#paket_body').html(result.data);
                $('#modal_paket').modal('show');
            }
            }
          });
  }
</script>

<script>
  function payment_pouser(id) {
    $('#payment_id').val('');
    $('#payment_id').val(id);
   $('#modal_payment').modal('show');
  }
</script>

<script>
  $(document).ready(function () {
    $('#payment_button').click(function() {
      var id = $('#payment_id').val();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: "POST",
          url: '/transaksi/po/payment',
          data: { id:id}, 
          success: function( result ) {
              if (result.res === 'berhasil') {
                  new PNotify({
                    title: 'Success!!',
                    text: 'Payment OK',
                    type: 'success',
                    styling: 'bootstrap3'
                });
                $('#data_pouser').DataTable().ajax.reload();
                $('#modal_payment').modal('hide');
            }
          }
        });
    })
  })
</script>

<script>
  function arsip_pouser(id) {
    $('#arsip_id').val('');
    $('#arsip_id').val(id);
   $('#modal_arsip').modal('show');
  }
</script>

<script>
  $(document).ready(function () {
    $('#arsip_button').click(function() {
      var id = $('#arsip_id').val();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: "POST",
          url: '/transaksi/po/arsip',
          data: { id:id}, 
          success: function( result ) {
              if (result.res === 'berhasil') {
                  new PNotify({
                    title: 'Success!!',
                    text: 'Payment OK',
                    type: 'success',
                    styling: 'bootstrap3'
                });
                $('#data_pouser').DataTable().ajax.reload();
                $('#modal_arsip').modal('hide');
            }
          }
        });
    })
  })
</script>

@endsection