@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Customers <small>Table</small></h2>
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
                          <table id="data_customers" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th width="10%">Nama Customers</th>
                                <th width="10%">No Telp</th>
                                <th>Fax</th>
                                <th>Alamat</th>
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
              <h4 class="modal-title" id="myModalLabel">Buat Customers baru</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="">Nama Customer</label>
                    <input id="nama_customer" class="form-control" autocomplete="off">
                    <div id="nama_customer_select"></div>
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
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_customers" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_edit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Edit Data Customer</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                          <label for="">Nama Customer</label>
                          <input id="nama_customers_edit" class="form-control">
                          <input type="hidden" id="edit_id">
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
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_edit_customers" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_hapus" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Hapus Data Customer</h4>
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
            $('#data_customers').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'Contoh File PDF Datatables'},
                    {extend: 'excel', title: 'Contoh File Excel Datatables'},
                    {extend:'print',title: 'Contoh Print Datatables'},
                ],
                ajax: '/customers/view',
                columns: [
                    {data: 'nama_customers', name: 'nama_customers'},
                    {data: 'no_telp', name: 'no_telp'},
                    {data: 'fax', name: 'fax' },
                    {data: 'alamat', name: 'alamat' },
                    {data: 'action', name:'action', orderable: false, searchable:false},
                ],
            });
        });
        </script>

      <script>
        $(document).ready(function () {
          $('#save_customers').click(function () {
            var nama_customer = $('#nama_customer').val();
            var no_telp = $('#no_telp').val();
            var fax = $('#fax').val();
            var alamat = $('#alamat').val();

            if (nama_customer === '' || no_telp === '' || fax === '' || alamat === '') {
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
                  url: '/customers/tambah',
                  data: { nama_customer:nama_customer, no_telp:no_telp, fax:fax, alamat:alamat }, 
                  success: function( result ) {
                      if (result.res === 'berhasil') {
                        new PNotify({
                          title: 'Success!!',
                          text: 'Data Berhasil di tambah!',
                          type: 'success',
                          styling: 'bootstrap3'
                      });
                      $('#modal_tambah').modal('hide');
                      $('#data_customers').DataTable().ajax.reload();
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
            $('#nama_customer').val('');
            $('#no_telp').val('');
            $('#fax').val('');
            $('#alamat').val('');

            $('#modal_tambah').modal('show');
          });
        });
      </script>

      

      <script>
        function edit_customers(id) {
            $('#nama_customers_edit').val('');
            $('#no_telp_edit').val('');
            $('#fax_edit').val('');
            $('#alamat_edit').val('');
            $('#edit_id').val(id);

          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
            $.ajax({
                type: "POST",
                url: '/customers/editGet',
                data: { id:id }, 
                success: function( result ) {
                    if (result.res === 'berhasil') {
                        $('#nama_customers_edit').val(result.data.nama_customers);
                        $('#no_telp_edit').val(result.data.no_telp);
                        $('#fax_edit').val(result.data.fax);
                        $('#alamat_edit').val(result.data.alamat);
                        $('#modal_edit').modal('show');
                      }
                    } 
            });
        }
      </script>

<script>
  $(document).ready(function () {
    $('#save_edit_customers').click(function () {
      var nama_customer = $('#nama_customers_edit').val();
      var id = $('#edit_id').val();
      var no_telp = $('#no_telp_edit').val();
      var fax = $('#fax_edit').val();
      var alamat = $('#alamat_edit').val();


      if (nama_customer === '' || no_telp === '' || fax === '' || alamat === '') {
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
            url: '/customers/editStore',
            data: { id:id,nama_customer:nama_customer, no_telp:no_telp, fax:fax, alamat:alamat }, 
            success: function( result ) {
                if (result.res === 'berhasil') {
                  new PNotify({
                    title: 'Success!!',
                    text: 'Data Berhasil di Edit!',
                    type: 'success',
                    styling: 'bootstrap3'
                });
                $('#modal_edit').modal('hide');
                $('#data_customers').DataTable().ajax.reload();
                }
            }
        });
      }
    });
  });
</script>

<script>
  function hapus_customers(id) {
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
            url: '/customers/hapus',
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
                $('#data_customers').DataTable().ajax.reload();
                }
            }
        });
    });
  });
</script>
@endsection