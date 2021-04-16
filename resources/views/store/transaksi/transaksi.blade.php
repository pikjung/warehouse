@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Transaksi</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li>
                    <button type="button" class="btn btn-sm btn-success" id="button_modal">Transaksi Baru</button>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          <table id="transaksi" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>Toko</th>
                                <th>No Transaksi</th>
                                <th>No Invoice Platform</th>
                                <th>Customer</th>
                                <th>Alamat</th>
                                <th>Kurir</th>
                                <th>Plat Kurir</th>
                                <th>Tanggal</th>
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
              <h4 class="modal-title" id="myModalLabel">Tambah Data Platform</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="">Toko</label>
                        <select name="" id="toko_id" class="form-control">
                            @foreach ($toko as $item)
                                <option value="{{$item->toko_id}}">{{$item->nama_toko. " | " .$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                  <div class="form-group">
                    <label for="nama_platform">No Transaksi</label>
                    <input type="text" class="form-control" id="no_transaksi">
                    <div id="pesan"></div>
                  </div>
                  <div class="form-group">
                      <label for="">No Invoice Platform</label>
                      <input type="text" class="form-control" id="no_inv_platform">
                  </div>
                  <div class="form-group">
                    <label for="">Customer</label>
                    <input type="text" class="form-control" id="customer">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Kurir</label>
                    <input type="text" class="form-control" id="kurir">
                  </div>
                  <div class="form-group">
                    <label for="">Plat Kendaraan Kurir</label>
                    <input type="text" class="form-control" id="plat_kendaraan_kurir">
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_transaksi" class="btn btn-primary">Save changes</button>
            </div>
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
              <div class="modal-body">
                <div class="form-group">
                    <label for="">Toko</label>
                    <select name="" id="toko_id_edit" class="form-control">
                        @foreach ($toko as $item)
                            <option value="{{$item->toko_id}}">{{$item->nama_toko. " | " .$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama_platform">No Transaksi</label>
                    <input type="hidden" id="id_edit">
                    <input type="text" class="form-control" id="no_transaksi_edit">
                    <div id="pesan_edit">

                    </div>
                  </div>
                  <div class="form-group">
                      <label for="">No Invoice Platform</label>
                      <input type="text" class="form-control" id="no_inv_platform_edit">
                  </div>
                  <div class="form-group">
                    <label for="">Customer</label>
                    <input type="text" class="form-control" id="customer_edit">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat_edit" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Kurir</label>
                    <input type="text" class="form-control" id="kurir_edit">
                  </div>
                  <div class="form-group">
                    <label for="">Plat Kendaraan Kurir</label>
                    <input type="text" class="form-control" id="plat_kendaraan_kurir_edit">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="save_edit_transaksi" class="btn btn-primary">Save changes</button>
              </div>
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
            $('#transaksi').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'Contoh File PDF Datatables'},
                    {extend: 'excel', title: 'Contoh File Excel Datatables'},
                    {extend:'print',title: 'Contoh Print Datatables'},
                ],
                ajax: '/store/transaksi/get',
                columns: [
                    {data: 'toko', name: 'toko'},
                    {data: 'no_transaksi', name: 'no_transaksi'},
                    {data: 'no_inv_platform', name: 'no_inv_platform'},
                    {data: 'customer', name: 'customer'},
                    {data: 'alamat', name: 'alamat'},
                    {data: 'kurir', name: 'kurir'},
                    {data: 'plat_kendaraan_kurir', name: 'plat_kendaraan_kurir'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'detail', name: 'detail'},
                    {data: 'action', name:'action', orderable: false, searchable:false},
                ],
            });
        });
        </script>

        <script>
          $(document).ready(function () {
            $('#button_modal').click(function () {
                $('#toko_id').val('');
              $('#no_transaksi').val('')
              $('#no_inv_platform').val('')
              $('#customer').val('')
              $('#alamat').val('')
              $('#kurir').val('')
              $('#plat_kendaraan_kurir').val('')
              $('#modal_tambah').modal('show');
            })
          })
        </script>

        <script>
          $(document).ready(function () {
            $('#save_transaksi').click(function () {
              var no_transaksi = $('#no_transaksi').val();
              var no_inv_platform = $('#no_inv_platform').val();
              var customer = $('#customer').val();
              var alamat = $('#alamat').val();
              var kurir = $('#kurir').val();
              var plat_kendaraan_kurir = $('#plat_kendaraan_kurir').val();
              var toko_id = $('#toko_id').val();

              if (no_transaksi === '' ||  no_inv_platform === '' || customer === '' || kurir === '' || plat_kendaraan_kurir === '' || toko_id === '' || alamat === '') {
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
                    url: '/store/transaksi/tambah',
                    data: { no_transaksi:no_transaksi,  no_inv_platform:no_inv_platform, customer:customer, alamat:alamat,kurir:kurir, plat_kendaraan_kurir:plat_kendaraan_kurir,toko_id:toko_id}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                          new PNotify({
                              title: 'Success!!',
                              text: 'Data Berhasil di tambah!',
                              type: 'success',
                              styling: 'bootstrap3'
                          });
                          $('#transaksi').DataTable().ajax.reload()
                          $('#modal_tambah').modal('hide');
                        }
                    }
                  });
              }
            })
          })
        </script>

        <script>
            function edit_transaksi(id) {
                $('#toko_id').val('');
                $('#no_transaksi').val('')
                $('#no_inv_platform').val('')
                $('#customer').val('')
                $('#alamat').val('')
                $('#kurir').val('')
                $('#plat_kendaraan_kurir').val('')
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    type: "POST",
                    url: '/store/transaksi/editGet',
                    data: { id:id}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                            $('#toko_id').val(result.data.toko_id);
                            $('#no_transaksi').val(result.data.no_transaksi)
                            $('#no_inv_platform').val(result.data.no_inv_platform)
                            $('#customer').val(result.data.customer)
                            $('#alamat').val(result.data.alamat)
                            $('#kurir').val(result.data.kurir)
                            $('#plat_kendaraan_kurir').val(result.data.plat_kendaraan_kurir)
                            $('#id_edit').val(result.data.transaksi_id)
                          $('#modal_edit').modal('show');
                        }
                    }
                  });
            }
        </script> 

        <script>
            $(document).ready(function () {
            $('#save_edit_transaksi').click(function () {
                var no_transaksi = $('#no_transaksi_edit').val();
                var no_inv_platform = $('#no_inv_platform_edit').val();
                var customer = $('#customer_edit').val();
                var alamat = $('#alamat_edit').val();
                var kurir = $('#kurir_edit').val();
                var plat_kendaraan_kurir = $('#plat_kendaraan_kurir_edit').val();
                var toko_id = $('#toko_id_edit').val();
                var id = $('#id_edit').val();

                if (no_transaksi === '' ||  no_inv_platform === '' || customer === '' || kurir === '' || plat_kendaraan_kurir === '' || toko_id === '' || alamat === '') {
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
                    url: '/store/transaksi/editStore',
                    data: { no_transaksi:no_transaksi,  no_inv_platform:no_inv_platform, customer:customer, alamat:alamat,kurir:kurir, plat_kendaraan_kurir:plat_kendaraan_kurir,toko_id:toko_id, id:id}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                            new PNotify({
                                title: 'Success!!',
                                text: 'Data Berhasil di tambah!',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            $('#transaksi').DataTable().ajax.reload()
                            $('#modal_edit').modal('hide');
                        }
                    }
                    });
                }
            })
            })
        </script>

        <script>
            function hapus_transaksi(id) {
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
                            url: '/store/transaksi/hapus',
                            data: { id:id}, 
                            success: function( result ) {
                                if (result.res === 'berhasil') {
                                new PNotify({
                                    title: 'Success!!',
                                    text: 'Data Berhasil di tambah!',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                });
                                $('#transaksi').DataTable().ajax.reload()
                                $('#modal_hapus').modal('hide');
                                }
                            }
                        });
                })
            })
        </script>

        <script>
            $(document).ready(function () {
                $('#toko_id').change(function(){
                    var data = $(this).val();
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        });
                    $.ajax({
                        type: "POST",
                        url: '/store/transaksi/no_transaksi',
                        data: { id:data}, 
                        success: function( result ) {
                            var no = result.no + 1;
                            const monthNames = ["I", "II", "III", "IV", "V", "VI",
                            "VII", "VII", "IX", "X", "XI", "XII"
                            ];

                            const d = new Date();
                            var bulan =  monthNames[d.getMonth()];
                            var tahun = d.getFullYear();
                            var po =  result.data.nama_toko +'/' + tahun + '/' + bulan + '/' + no;
                            $('#no_transaksi').val(po)
                        }
                    });
                })
            })
        </script>
        
        <script>
            $(document).ready(function () {
                $('#no_transaksi').keyup(function(){
                    $('#pesan').html('')
                    var data = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        });
                    $.ajax({
                        type: "POST",
                        url: '/store/transaksi/no_transaksiFilter',
                        data: { no_transaksi:data}, 
                        success: function( result ) {
                            if (result.res === 'berhasil') {
                                $('#pesan').html('<div class="text-success">NO Transaksi available</div>')
                            } else if (result.res === 'gagal') {
                                $('#pesan').html('<div class="text-dange">NO Transaksi not available</div>')
                            } else {
                                console.log('Error')
                            }
                        }
                    });
                })
            })
        </script>

        <script>
            $(document).ready(function () {
                $('#no_transaksi_edit').keyup(function(){
                    $('#pesan_edit').html('')
                    var data = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        });
                    $.ajax({
                        type: "POST",
                        url: '/store/transaksi/no_transaksiFilter',
                        data: { no_transaksi:data}, 
                        success: function( result ) {
                            if (result.res === 'berhasil') {
                                $('#pesan_edit').html('<div class="text-success">NO Transaksi available</div>')
                            } else if (result.res === 'gagal') {
                                $('#pesan_edit').html('<div class="text-dange">NO Transaksi not available</div>')
                            } else {
                                console.log('Error')
                            }
                        }
                    });
                })
            })
        </script>

@endsection