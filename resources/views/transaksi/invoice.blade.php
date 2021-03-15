@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Invoice <small>Table</small></h2>
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
                          <table id="data_invoice" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>No Invoice</th>
                                <th>Nama Invoice</th>
                                <th>Jumlah</th>
                                <th>print</th>
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
              <h4 class="modal-title" id="myModalLabel">Tambah Data Paket</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="no_invoice">No invoice</label>
                    <input type="text" class="form-control" id="no_invoice"> 
                </div>
                <div class="form-group">
                    <label for="nama_invoice">Nama invoice</label>
                    <input type="text" class="form-control" id="nama_invoice"> 
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="text" class="form-control" id="jumlah">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_invoice" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_edit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Edit Data Invoice</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="no_invoice_edit">No invoice</label>
                    <input type="text" class="form-control" id="no_invoice_edit"> 
                </div>
                <div class="form-group">
                    <label for="nama_invoice">Nama Invoice</label>
                    <input type="text" class="form-control" id="nama_invoice_edit"> 
                    <input type="hidden" id="id_edit" >
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="text" class="form-control" id="jumlah_edit">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_edit_invoice" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_hapus" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Hapus Data Invoice</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="row">
                    <div class="col-12">
                      <div id="pesan_hapus"></div>
                    </div>
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
      

      <script type="text/javascript">
        $(document).ready(function() {
            var id = {!! json_encode($id) !!};
            $('#data_invoice').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'Contoh File PDF Datatables'},
                    {extend: 'excel', title: 'Contoh File Excel Datatables'},
                    {extend:'print',title: 'Contoh Print Datatables'},
                ],
                ajax: '/transaksi/invoice/get/'+id,
                columns: [
                    {data: 'no_invoice', name: 'no_invoice'},
                    {data: 'nama_invoice', name: 'nama_invoice'},
                    {data: 'jumlah', name: 'no_telp'},
                    {data: 'print', name: 'print' },
                    {data: 'action', name:'action', orderable: false, searchable:false},
                ],
            });
        });
        </script>

        <script>
          $(document).ready(function () {
            $('#button_modal').click(function () {
              $('#nama_invoice').val('');
              $('#no_invoice').val('');
              $('#jumlah').val('');
              $('#modal_tambah').modal('show');
            })
          })
        </script>

        <script>
          $(document).ready(function () {
            $('#save_invoice').click(function () {
            var id = {!! json_encode($id) !!};
              var nama_invoice = $('#nama_invoice').val();
              var jumlah = $('#jumlah').val();
              var no_invoice = $('#no_invoice').val();
              if (nama_invoice === '' || jumlah === '' || no_invoice === '') {
                new PNotify({
                    title: 'Error!!',
                    text: 'Data tidak boleh kosong!',
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
                    url: '/transaksi/invoice/tambah',
                    data: { nama_invoice:nama_invoice, jumlah:jumlah, userReq_id:id, no_invoice:no_invoice}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                          new PNotify({
                              title: 'Success!!',
                              text: 'Data Berhasil di tambah!',
                              type: 'success',
                              styling: 'bootstrap3'
                          });
                          $('#data_invoice').DataTable().ajax.reload()
                          $('#modal_tambah').modal('hide');
                        }
                    }
                  });
              }
            })
          })
        </script>

        <script>
            function edit_invoice(id) {
                $('#nama_invoice_edit').val('');
                $('#jumlah_edit').val('');
                $('#no_invoice_edit').val('');
                $('#id_edit').val('');
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    type: "POST",
                    url: '/transaksi/invoice/editGet',
                    data: { id:id}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                            $('#id_edit').val(result.data.invoice_id);
                            $('#nama_invoice_edit').val(result.data.nama_invoice);
                            $('#jumlah_edit').val(result.data.jumlah);
                            $('#no_invoice').val(result.data.no_invoice);
                          $('#modal_edit').modal('show');
                        }
                    }
                  });
            }
        </script>

        <script>
            $(document).ready(function () {
                $('#save_edit_invoice').click(function () {
                    var id = $('#id_edit').val();
                    var nama_invoice = $('#nama_invoice_edit').val();
                    var jumlah = $('#jumlah_edit').val();
                    var no_invoice = $('#no_invoice_edit').val();
                    if (nama_invoice === '' || jumlah === '' || no_invoice === '') {
                        new PNotify({
                            title: 'Error!!',
                            text: 'Data tidak boleh kosong!',
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
                            url: '/transaksi/invoice/editStore',
                            data: { id:id,nama_invoice:nama_invoice, jumlah:jumlah, no_invoice:no_invoice}, 
                            success: function( result ) {
                                if (result.res === 'berhasil') {
                                new PNotify({
                                    title: 'Success!!',
                                    text: 'Data Berhasil di tambah!',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });
                                $('#data_invoice').DataTable().ajax.reload()
                                $('#modal_edit').modal('hide');
                                }
                            }
                        });
                    }
                })
            })
        </script>

        <script>
            function hapus_invoice(id) {
                $('#hapus_id').val('')
                $('#hapus_id').val(id);
                $('#modal_hapus').modal('show');
            }
        </script>

        <script>
            $(document).ready(function() {
                $('#hapus_button').click(function () {
                    var id = $('#hapus_id').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        });
                        $.ajax({
                            type: "POST",
                            url: '/transaksi/invoice/hapus',
                            data: { id:id}, 
                            success: function( result ) {
                                if (result.res === 'berhasil') {
                                new PNotify({
                                    title: 'Success!!',
                                    text: 'Data Berhasil di tambah!',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });
                                $('#data_invoice').DataTable().ajax.reload()
                                $('#modal_hapus').modal('hide');
                                }
                            }
                        });
                })
            })
        </script>

@endsection