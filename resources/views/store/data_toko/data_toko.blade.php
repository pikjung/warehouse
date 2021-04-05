@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Data Toko <small>Table</small></h2>
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
                          <table id="data_toko" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>Nama Toko</th>
                                <th>Platform</th>
                                <th>No Telp</th>
                                <th>Alamat</th>
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
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Tambah Data Toko</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_toko">Nama Toko</label>
                    <input type="text" class="form-control" id="nama_toko"> 
                </div>
                <div class="form-group">
                    <label for="platform_toko">Platform Toko</label>
                    <input type="text" class="form-control" id="platform_toko"> 
                </div>
                <div class="form-group">
                    <label for="no_telp">No telp</label>
                    <input type="text" class="form-control" id="no_telp">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Logo</label>
                    <input type="file" class="form-control" id="logo">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_toko" class="btn btn-primary">Save changes</button>
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
                    <label for="nama_toko">Nama Toko</label>
                    <input type="text" class="form-control" id="nama_toko_edit"> 
                    <input type="hidden" id="id_edit" >
                </div>
                <div class="form-group">
                    <label for="">Platform Toko</label>
                    <input type="text" class="form-control" id="platform_toko_edit">
                </div>
                <div class="form-group">
                    <label for="no_telp">No telp</label>
                    <input type="text" class="form-control" id="no_telp_edit">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat_edit" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Logo</label>
                    <input type="file" class="form-control" id="logo_edit">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_edit_toko" class="btn btn-primary">Save changes</button>
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
            $('#data_toko').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'Contoh File PDF Datatables'},
                    {extend: 'excel', title: 'Contoh File Excel Datatables'},
                    {extend:'print',title: 'Contoh Print Datatables'},
                ],
                ajax: '/store/data_toko/get',
                columns: [
                    {data: 'nama_toko', name: 'nama_toko'},
                    {data: 'platform_toko', name: 'platform_toko'},
                    {data: 'no_telp_toko', name: 'no_telp_toko'},
                    {data: 'alamat_toko', name: 'alamat_toko' },
                    {data: 'detail', name: 'detail'},
                    {data: 'action', name:'action', orderable: false, searchable:false},
                ],
            });
        });
        </script>

        <script>
          $(document).ready(function () {
            $('#button_modal').click(function () {
              $('#nama_toko').val('');
              $('#no_telp').val('');
              $('#alamat').val('');
              $('#logo').val('');
              $('#platform_toko').val('');
              $('#modal_tambah').modal('show');
            })
          })
        </script>

        <script>
          $(document).ready(function () {
            $('#save_toko').click(function () {
              var nama_toko = $('#nama_toko').val();
              var no_telp = $('#no_telp').val();
              var alamat = $('#alamat').val();
              var platform_toko = $('#platform_toko').val();
              var logo = $('#logo').val();
              if (nama_toko === '' || no_telp === '' || alamat === '' || platform_toko === '' || logo === '') {
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
                    url: '/store/data_toko/tambah',
                    data: { nama_toko:nama_toko, no_telp_toko:no_telp, alamat_toko:alamat, platform_toko:platform_toko, logo_toko:logo}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                          new PNotify({
                              title: 'Success!!',
                              text: 'Data Berhasil di tambah!',
                              type: 'success',
                              styling: 'bootstrap3'
                          });
                          $('#data_toko').DataTable().ajax.reload()
                          $('#modal_tambah').modal('hide');
                        }
                    }
                  });
              }
            })
          })
        </script>

        <script>
            function edit_toko(id) {
                $('#nama_toko_edit').val('');
                $('#no_telp_edit').val('');
                $('#alamat_edit').val('');
                $('#id_edit').val('');
                $('#platform_toko_edit').val('')
                $('#logo_toko_edit').val('')
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    type: "POST",
                    url: '/store/data_toko/editGet',
                    data: { id:id}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                            $('#id_edit').val(result.data.toko_id);
                            $('#nama_toko_edit').val(result.data.nama_toko);
                            $('#no_telp_edit').val(result.data.no_telp);
                            $('#alamat_edit').val(result.data.alamat_toko);
                            $('#platform_toko_edit').val(result.data.platform_toko);
                            $('#logo_toko_edit').val(result.data.logo_toko);
                          $('#modal_edit').modal('show');
                        }
                    }
                  });
            }
        </script>

        <script>
            $(document).ready(function () {
                $('#save_edit_toko').click(function () {
                    var id = $('#id_edit').val();
                    var nama_toko = $('#nama_toko_edit').val();
                    var no_telp = $('#no_telp_edit').val();
                    var alamat = $('#alamat_edit').val();
                    var platform_toko = $('#platform_toko_edit').val();
                    var logo = $('#logo_edit').val()
                    if (nama_toko === '' || no_telp === '' || alamat === '' || platform_toko === '' || logo=== '') {
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
                            url: '/store/data_toko/editStore',
                            data: { id:id,nama_toko:nama_toko, no_telp_toko:no_telp, alamat_toko:alamat, platform_toko:platform_toko, logo_toko:logo}, 
                            success: function( result ) {
                                if (result.res === 'berhasil') {
                                new PNotify({
                                    title: 'Success!!',
                                    text: 'Data Berhasil di tambah!',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });
                                $('#data_toko').DataTable().ajax.reload()
                                $('#modal_edit').modal('hide');
                                }
                            }
                        });
                    }
                })
            })
        </script>

        <script>
            function hapus_toko(id) {
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
                            url: '/store/data_toko/hapus',
                            data: { id:id}, 
                            success: function( result ) {
                                if (result.res === 'berhasil') {
                                new PNotify({
                                    title: 'Success!!',
                                    text: 'Data Berhasil di tambah!',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });
                                $('#data_toko').DataTable().ajax.reload()
                                $('#modal_hapus').modal('hide');
                                }
                            }
                        });
                })
            })
        </script>

@endsection