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
                          <table id="data_user" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Action</th>
                                <th>Active</th>
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
              <h4 class="modal-title" id="myModalLabel">Tambah Data User</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name"> 
                </div>
                <div class="form-group">
                    <label for="no_telp">Email</label>
                    <input type="text" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="re-password">Re-Password</label>
                    <input type="password" id="re-password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="alamat">Level</label>
                    <select name="" id="level">
                        @foreach ($role as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_user" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_edit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Edit Data User</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_user">Nama</label>
                    <input type="text" class="form-control" id="name_edit"> 
                </div>
                <div class="form-group">
                    <label for="no_telp">Email</label>
                    <input type="text" class="form-control" id="email_edit">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password_edit" class="form-control">
                </div>
                <div class="form-group">
                    <label for="re-password">Re-Password</label>
                    <input type="password" id="re-password_edit" class="form-control">
                </div>
                <div class="form-group">
                    <label for="alamat">Level</label>
                    <select name="" id="level_edit" class="form-control">
                        @foreach ($role as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_edit_user" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_hapus" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Hapus Data User</h4>
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
            $('#data_user').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'Contoh File PDF Datatables'},
                    {extend: 'excel', title: 'Contoh File Excel Datatables'},
                    {extend:'print',title: 'Contoh Print Datatables'},
                ],
                ajax: '/account/get',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name:'action', orderable: false, searchable:false},
                    {data: 'active', name: 'active'}
                ],
            });
        });
        </script>

        <script>
          $(document).ready(function () {
            $('#button_modal').click(function () {
              $('#name').val('');
              $('#email').val('');
              $('#password').val('');
              $('#re-password').val('');
              $('#modal_tambah').modal('show');
            })
          })
        </script>

        <script>
          $(document).ready(function () {
            $('#save_user').click(function () {
              var name = $('#name').val();
              var email = $('#email').val();
              var password = $('#password').val();
              var repassword = $('#re-password').val();
              var level = $('#level').val();
              if (name === '' || email === '' || password === '' || repassword === '') {
                new PNotify({
                    title: 'Error!!',
                    text: 'Data tidak boleh kosong!',
                    type: 'error',
                    styling: 'bootstrap3'
                });
              } else {
               if (password != repassword) {
                new PNotify({
                    title: 'Error!!',
                    text: 'Password tidak sama!',
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
                    url: '/account/tambah',
                    data: { name:name, email:email, password:password, level:level}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                          new PNotify({
                              title: 'Success!!',
                              text: 'Data Berhasil di tambah!',
                              type: 'success',
                              styling: 'bootstrap3'
                          });
                          $('#data_user').DataTable().ajax.reload()
                          $('#modal_tambah').modal('hide');
                        }
                    }
                  });
               }
              }
            })
          })
        </script>

        <script>
            function edit_user(id) {
                $('#name_edit').val('');
                $('#email_edit').val('');
                $('#password').val('');
                $('#id_edit').val('');
                $('#id_edit').val(id);
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    type: "POST",
                    url: '/account/editGet',
                    data: { id:id}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                            $('#name_edit').val(result.data.name);
                            $('#email_edit').val(result.data.email);
                          $('#modal_edit').modal('show');
                        }
                    }
                  });
            }
        </script>

        <script>
            $(document).ready(function () {
                $('#save_edit_user').click(function () {
                    var id = $('#id_edit').val();
                    var name = $('#name_edit').val();
                    var email = $('#email_edit').val();
                    var password = $('#password_edit').val();
                    var repassword = $('#re-password_edit').val();
                    var level = $('#level_edit').val();
                    if (name === '' || email === '' || password === '') {
                        new PNotify({
                            title: 'Error!!',
                            text: 'Data tidak boleh kosong!',
                            type: 'error',
                            styling: 'bootstrap3'
                        });
                    } else {
                       if (password != repassword) {
                        new PNotify({
                            title: 'Error!!',
                            text: 'Password tidak sama!',
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
                            url: '/account/editStore',
                            data: { id:id,name:name, email:email, password:password, level:level}, 
                            success: function( result ) {
                                if (result.res === 'berhasil') {
                                new PNotify({
                                    title: 'Success!!',
                                    text: 'Data Berhasil di tambah!',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });
                                $('#data_user').DataTable().ajax.reload()
                                $('#modal_edit').modal('hide');
                                }
                            }
                        });
                       }
                    }
                })
            })
        </script>

        <script>
            function hapus_user(id) {
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
                            url: '/account/hapus',
                            data: { id:id}, 
                            success: function( result ) {
                                if (result.res === 'berhasil') {
                                new PNotify({
                                    title: 'Success!!',
                                    text: 'Data Berhasil di tambah!',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });
                                $('#data_user').DataTable().ajax.reload()
                                $('#modal_hapus').modal('hide');
                                }
                            }
                        });
                })
            })
        </script>

        <script>
            function active_user(id) {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    type: "POST",
                    url: '/account/activated',
                    data: { id:id}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                        new PNotify({
                            title: 'Success!!',
                            text: 'Data Berhasil di tambah!',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                        $('#data_user').DataTable().ajax.reload()
                        }
                    }
                });
            }
        </script>

@endsection