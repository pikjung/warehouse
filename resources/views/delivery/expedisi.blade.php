@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Expedisi <small>Table</small></h2>
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
                          <table id="data_expedisi" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>Nama Expedisi</th>
                                <th>No Telp</th>
                                <th>Alamat</th>
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
                    <label for="nama_expedisi">Nama Expedisi</label>
                    <input type="text" class="form-control" id="nama_expedisi"> 
                </div>
                <div class="form-group">
                    <label for="no_telp">No telp</label>
                    <input type="text" class="form-control" id="no_telp">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_expedisi" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_edit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Edit Data expedisi</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_expedisi">Nama Expedisi</label>
                    <input type="text" class="form-control" id="nama_expedisi_edit"> 
                    <input type="hidden" id="id_edit" >
                </div>
                <div class="form-group">
                    <label for="no_telp">No telp</label>
                    <input type="text" class="form-control" id="no_telp_edit">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat_edit" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_edit_expedisi" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_hapus" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Hapus Data Expedisi</h4>
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
      

      <div id="modal_detail" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Detail Paket</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-6">
                    Expedisi : <p id="expedisi_detail"></p>
                    <input type="hidden" id="detail_id">
                  </div>
                  <div class="col-6">
                    <div class="float-right">
                      <button class="btn btn-primary" id="tambah_detail"><i class="glyphicon glyphicon-plus"></i></button>
                    </div>
                  </div>
                  <div class="col-12">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>PO User</th>
                        </tr>
                      </thead>
                      <tbody id="detail_data">

                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript">
        $(document).ready(function() {
            $('#data_expedisi').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'Contoh File PDF Datatables'},
                    {extend: 'excel', title: 'Contoh File Excel Datatables'},
                    {extend:'print',title: 'Contoh Print Datatables'},
                ],
                ajax: '/delivery/logisticGet',
                columns: [
                    {data: 'nama_expedisi', name: 'nama_expedisi'},
                    {data: 'no_telp', name: 'no_telp'},
                    {data: 'alamat_expedisi', name: 'alamat_expedisi' },
                    {data: 'action', name:'action', orderable: false, searchable:false},
                ],
            });
        });
        </script>

        <script>
          $(document).ready(function () {
            $('#button_modal').click(function () {
              $('#nama_expedisi').val('');
              $('#no_telp').val('');
              $('#alamat').val('');
              $('#modal_tambah').modal('show');
            })
          })
        </script>

        <script>
          $(document).ready(function () {
            $('#save_expedisi').click(function () {
              var nama_expedisi = $('#nama_expedisi').val();
              var no_telp = $('#no_telp').val();
              var alamat = $('#alamat').val();
              if (nama_expedisi === '' || no_telp === '' || alamat === '') {
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
                    url: '/delivery/logistic/tambah',
                    data: { nama_expedisi:nama_expedisi, no_telp:no_telp, alamat:alamat}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                          new PNotify({
                              title: 'Success!!',
                              text: 'Data Berhasil di tambah!',
                              type: 'success',
                              styling: 'bootstrap3'
                          });
                          $('#data_expedisi').DataTable().ajax.reload()
                          $('#modal_tambah').modal('hide');
                        }
                    }
                  });
              }
            })
          })
        </script>

        <script>
            function edit_expedisi(id) {
                $('#nama_expedisi_edit').val('');
                $('#no_telp_edit').val('');
                $('#alamat_edit').val('');
                $('#id_edit').val('');
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    type: "POST",
                    url: '/delivery/logistic/editGet',
                    data: { id:id}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                            $('#id_edit').val(result.data.expedisi_id);
                            $('#nama_expedisi_edit').val(result.data.nama_expedisi);
                            $('#no_telp_edit').val(result.data.no_telp);
                            $('#alamat_edit').val(result.data.alamat_expedisi);
                          $('#modal_edit').modal('show');
                        }
                    }
                  });
            }
        </script>

        <script>
            $(document).ready(function () {
                $('#save_edit_expedisi').click(function () {
                    var id = $('#id_edit').val();
                    var nama_expedisi = $('#nama_expedisi_edit').val();
                    var no_telp = $('#no_telp_edit').val();
                    var alamat = $('#alamat_edit').val();
                    if (nama_expedisi === '' || no_telp === '' || alamat === '') {
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
                            url: '/delivery/logistic/editStore',
                            data: { id:id,nama_expedisi:nama_expedisi, no_telp:no_telp, alamat:alamat}, 
                            success: function( result ) {
                                if (result.res === 'berhasil') {
                                new PNotify({
                                    title: 'Success!!',
                                    text: 'Data Berhasil di tambah!',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });
                                $('#data_expedisi').DataTable().ajax.reload()
                                $('#modal_edit').modal('hide');
                                }
                            }
                        });
                    }
                })
            })
        </script>

        <script>
            function hapus_expedisi(id) {
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
                            url: '/delivery/logistic/hapus',
                            data: { id:id}, 
                            success: function( result ) {
                                if (result.res === 'berhasil') {
                                new PNotify({
                                    title: 'Success!!',
                                    text: 'Data Berhasil di tambah!',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });
                                $('#data_expedisi').DataTable().ajax.reload()
                                $('#modal_hapus').modal('hide');
                                }
                            }
                        });
                })
            })
        </script>

@endsection