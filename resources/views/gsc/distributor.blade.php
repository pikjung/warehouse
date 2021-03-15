@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Distributor <small>Table</small></h2>
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
                          <table id="data_disti" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th width="20%">Nama Distributor</th>
                                <th width="30%">Alamat</th>
                                <th>Telp</th>
                                <th>Jumlah PO</th>
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
              <h4 class="modal-title" id="myModalLabel">Tambah Data Distributor</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Distributor</label>
                        <input type="text" id="nama_disti" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea id="alamat" cols="20" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">No Telp</label>
                        <input type="number" id="no_telp" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_disti" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_edit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Edit Data Distributor</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Distributor</label>
                        <input type="hidden" id="disti_id_edit">
                        <input type="text" id="nama_disti_edit" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea id="alamat_edit" cols="20" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">No Telp</label>
                        <input type="number" id="no_telp_edit" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_edit_disti" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_hapus" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Hapus Data Distributor</h4>
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

      <script type="text/javascript">
        $(document).ready(function() {
            $('#data_disti').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'Contoh File PDF Datatables'},
                    {extend: 'excel', title: 'Contoh File Excel Datatables'},
                    {extend:'print',title: 'Contoh Print Datatables'},
                ],
                ajax: '/gsc/distributor/view',
                columns: [
                    {data: 'nama_disti', name: 'nama_disti'},
                    {data: 'alamat_disti', name: 'alamat_disti'},
                    {data: 'no_telp_disti', name: 'no_telp_disti'},
                    {data: 'disti_id', name: 'disti_id' },
                    {data: 'action', name:'action', orderable: false, searchable:false},
                ],
            });
        });
        </script>

      <script>
        $(document).ready(function () {
          $('#save_disti').click(function () {
            var nama = $('#nama_disti').val();
            var alamat = $('#alamat').val();
            var no_telp = $('#no_telp').val();

            if (nama === '' || alamat === '' || no_telp === '') {
              new PNotify({
                  title: 'Data Kosong!!',
                  text: 'Data harap tidak dikosongkan!',
                  type: 'error',
                  styling: 'bootstrap3'
              });
            } else if (isNaN(no_telp)) {
              new PNotify({
                  title: 'Error',
                  text: 'No Telepon Harus berupa Angka!',
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
                  url: '/gsc/distributor/tambah',
                  data: { nama:nama, alamat:alamat, no_telp:no_telp }, 
                  success: function( result ) {
                      if (result.res === 'success') {
                        new PNotify({
                          title: 'Success!!',
                          text: 'Data Berhasil di tambah!',
                          type: 'success',
                          styling: 'bootstrap3'
                      });
                      $('#modal_tambah').modal('hide');
                      $('#data_disti').DataTable().ajax.reload();
                      }
                  },
                  error: function(status, message) {
                        console.log(message);
                      }
              });
            }
          })
        })
      </script>

      <script>
        $(document).ready(function () {
          $('#button_modal').click(function () {

            $('#nama_disti').val('');
            $('#alamat').val('');
            $('#no_telp').val('');

            $('#modal_tambah').modal('show');
          })
        })
      </script>

      

      <script>
        function edit_disti(id) {
          $('#nama_disti').val('');
            $('#alamat').val('');
            $('#no_telp').val('');
            $('#disti_id_edit').val('');
          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
            $.ajax({
                type: "POST",
                url: '/gsc/distributor/editGet',
                data: { id:id }, 
                success: function( result ) {
                    if (result.res === 'berhasil') {
                      $('#nama_disti_edit').val(result.data.nama_disti);
                      $('#alamat_edit').html(result.data.alamat_disti);
                      $('#no_telp_edit').val(result.data.no_telp_disti);
                      $('#disti_id_edit').val(result.data.disti_id);
                      $('#modal_edit').modal('show');
                      }
                    }
                
            });
        }
      </script>

<script>
  $(document).ready(function () {
    $('#save_edit_disti').click(function () {
      var nama = $('#nama_disti_edit').val();
      var alamat = $('#alamat_edit').val();
      var no_telp = $('#no_telp_edit').val();
      var id = $('#disti_id_edit').val();

      if (nama === '' || alamat === '' || no_telp === '') {
        new PNotify({
            title: 'Data Kosong!!',
            text: 'Data harap tidak dikosongkan!',
            type: 'error',
            styling: 'bootstrap3'
        });
      } else if (isNaN(no_telp)) {
        new PNotify({
            title: 'Error',
            text: 'No Telepon Harus berupa Angka!',
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
            url: '/gsc/distributor/editStore',
            data: { id:id,nama:nama, alamat:alamat, no_telp:no_telp }, 
            success: function( result ) {
                if (result.res === 'berhasil') {
                  new PNotify({
                    title: 'Success!!',
                    text: 'Data Berhasil di Edit!',
                    type: 'success',
                    styling: 'bootstrap3'
                });
                $('#modal_edit').modal('hide');
                $('#data_disti').DataTable().ajax.reload();
                }
            }
        });
      }
    })
  })
</script>

<script>
  function hapus_disti(id) {
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
            url: '/gsc/distributor/hapus',
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
                $('#data_disti').DataTable().ajax.reload();
                }
            }
        });
    })
  })
</script>
  

@endsection