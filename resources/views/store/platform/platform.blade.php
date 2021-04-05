@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Data Platform <small>Table</small></h2>
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
                          <table id="data_platform" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>Nama</th>
                                <th>Logo</th>
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
              <h4 class="modal-title" id="myModalLabel">Tambah Data Platform</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <form method="POST" enctype="multipart/form-data" id="save_data_platform" action="javascript:void(0)" >
            <div class="modal-body">
                
                  <div class="form-group">
                    <label for="nama_platform">Nama</label>
                    <input type="text" class="form-control" id="nama_platform" name="nama"> 
                  </div>
                  <div class="form-group">
                      <label for="">Logo</label>
                      <input type="file" class="form-control" id="logo" name="logo">
                  </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>

          </div>
        </div>
      </div>

      <div id="modal_edit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Edit Data Platform</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <form method="POST" enctype="multipart/form-data" id="save_edit_data_platform" action="javascript:void(0)" >
              <div class="modal-body">
                  
                    <div class="form-group">
                      <input type="hidden" id="id_edit" name="id">
                      <label for="nama_platform">Nama</label>
                      <input type="text" class="form-control" id="nama_platform_edit" name="nama"> 
                    </div>
                    <div class="form-group">
                        <label for="">Logo</label>
                        <input type="file" class="form-control" id="logo_edit" name="logo">
                    </div>
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>

          </div>
        </div>
      </div>

      <div id="modal_hapus" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Hapus Data Platform</h4>
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
            $('#data_platform').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'Contoh File PDF Datatables'},
                    {extend: 'excel', title: 'Contoh File Excel Datatables'},
                    {extend:'print',title: 'Contoh Print Datatables'},
                ],
                ajax: '/store/platform/get',
                columns: [
                    {data: 'nama', name: 'nama'},
                    {data: 'logo', name: 'logo'},
                    {data: 'action', name:'action', orderable: false, searchable:false},
                ],
            });
        });
        </script>

        <script>
          $(document).ready(function () {
            $('#button_modal').click(function () {
              $('#nama_platform').val('');
              $('#logo').val('');
              $('#modal_tambah').modal('show');
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
            $('#save_data_platform').submit(function(e) {
            e.preventDefault();
              var formData = new FormData(this);
              $.ajax({
                type:'POST',
                url: "/store/platform/tambah",
                data: formData,
                processData: false,
                contentType: false,
                success: (result) => {
                  if (result.res === 'berhasil') {
                    new PNotify({
                        title: 'Success!!',
                        text: 'Data Berhasil di tambah!',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                    $('#data_platform').DataTable().ajax.reload()
                    $('#modal_tambah').modal('hide');
                  }
                },
                  error: function(data){
                  console.log(data);
                }
              });
            });
          });
          </script>
<!--
        <script>
          $(document).ready(function () {
            $('#save_toko').click(function () {
              var nama_platform = $('#nama_platform').val();
              var alamat = $('#alamat').val();
              var platform_toko = $('#platform_toko').val();
              var logo = $('#logo').val();
              if (nama_platform === '' ||  alamat === '' || platform_toko === '' || logo === '') {
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
                    url: '/store/data_platform/tambah',
                    data: { nama_platform:nama_platform,  alamat:alamat, platform_toko:platform_toko, logo_toko:logo}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                          new PNotify({
                              title: 'Success!!',
                              text: 'Data Berhasil di tambah!',
                              type: 'success',
                              styling: 'bootstrap3'
                          });
                          $('#data_platform').DataTable().ajax.reload()
                          $('#modal_tambah').modal('hide');
                        }
                    }
                  });
              }
            })
          })
        </script>-->

        <script>
            function edit_data_platform(id) {
                $('#nama_platform_edit').val('');
                $('#id_edit').val('');
                $('#logo_edit').val('')
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    type: "POST",
                    url: '/store/platform/editGet',
                    data: { id:id}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                            $('#id_edit').val(result.data.platform_id);
                            $('#nama_platform_edit').val(result.data.nama);
                          $('#modal_edit').modal('show');
                        }
                    }
                  });
            }
        </script> 

      <script>
        $(document).ready(function () {
          $('#button_modal').click(function () {
            $('#nama_platform').val('');
            $('#logo').val('');
            $('#modal_tambah').modal('show');
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
          $('#save_edit_data_platform').submit(function(e) {
          e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
              type:'POST',
              url: "/store/platform/editStore",
              data: formData,
              processData: false,
              contentType: false,
              success: (result) => {
                if (result.res === 'berhasil') {
                  new PNotify({
                      title: 'Success!!',
                      text: 'Data Berhasil di tambah!',
                      type: 'success',
                      styling: 'bootstrap3'
                  });
                  $('#data_platform').DataTable().ajax.reload()
                  $('#modal_edit').modal('hide');
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
            function hapus_data_platform(id) {
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
                            url: '/store/platform/hapus',
                            data: { id:id}, 
                            success: function( result ) {
                                if (result.res === 'berhasil') {
                                new PNotify({
                                    title: 'Success!!',
                                    text: 'Data Berhasil di tambah!',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });
                                $('#data_platform').DataTable().ajax.reload()
                                $('#modal_hapus').modal('hide');
                                }
                            }
                        });
                })
            })
        </script>

@endsection