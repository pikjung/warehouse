@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Detail Transaksi</h2>
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
                          <table id="detail_transaksi" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>Nama Barang</th>
                                <th>Type</th>
                                <th>QTY</th>
                                <th>SN</th>
                                <th>Gudang</th>
                                <th>Deskripsi</th>
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
              <h4 class="modal-title" id="myModalLabel">Tambah Data Barang</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <label for="">Pilih Barang</label>
                        <select name="" id="pilih_barang" class="form-control">
                          @foreach($barang as $item)
                            <option value="{{$item->inventory_id}}">{{$item->nama_barang}} || {{$item->nama_gudang}} || {{$item->count}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <label for="">  </label>
                      <button class="btn btn-info" id="button_cari_barang">
                        <span class="glyphicon glyphicon-search"></span>
                      </button>
                    </div>

                    <div class="col-md-10">
                      <div class="form-group">
                        <label for="">Pilih SN</label>
                        <select name="" id="pilih_sn" class="form-control" >
                        </select>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="">Qty</label>
                        <input type="text" class="form-control" id="qty" readonly>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi">
                      </div>
                    </div>

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
              <h4 class="modal-title" id="myModalLabel">Edit Data Barang</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="">Toko</label>
                    <select name="" id="toko_id_edit" class="form-control">
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
              <h4 class="modal-title" id="myModalLabel">Hapus Data Barang</h4>
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
                                <th>Type</th>
                                <th>Qty</th>
                                <th>SN</th>
                                <th>Gudang</th>
                                <th>Description</th>
                                <th>Tanggal</th>
                            </thead>
                            <tbody id="detail_transaksi_body">
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

      <script type="text/javascript">
        $(document).ready(function() {
            var id = {!! json_encode($id) !!};
            $('#detail_transaksi').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'Contoh File PDF Datatables'},
                    {extend: 'excel', title: 'Contoh File Excel Datatables'},
                    {extend:'print',title: 'Contoh Print Datatables'},
                ],
                ajax: '/store/detail_transaksi/get/'+id,
                columns: [
                    {data: 'nama_barang', name: 'nama_barang'},
                    {data: 'type', name: 'type'},
                    {data: 'qty', name: 'qty'},
                    {data: 'sn', name: 'sn'},
                    {data: 'gudang', name: 'gudang'},
                    {data: 'deskripsi', name: 'deskripsi'},
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
                                $('#detail_transaksi').DataTable().ajax.reload()
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

        <script>
          function detail_transaksi(id) {
            $('#detail_id').val('');
            $('#detail_id').val(id);
            $('#detail_transaksi_body').html('')
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                  });
              $.ajax({
                  type: "get",
                  url: '/store/transaksi/detail/'+id, 
                  success: function( result ) {
                    if (result.res === 'berhasil') {
                      $.each(result.data, function(key, val){
                      $('#detail_transaksi_body').append('<tr><td>'+val.nama_barang+'</td><td>'+val.type+'</td><td>'+val.qty+'</td><td>'+val.sn+'</td><td>'+val.deskripsi+'</td><td>'+val.tanggal+'</td><tr>');
                    });
                    $('#modal_detail').modal('show');
                    }
                  }, error: function() { 
                    console.log("Error")
                }  
              });
          }
        </script>

        <script>
          $(document).ready(function() {
            $('#detail_edit').click(function () {
              var id = $('#detail_id').val();
              window.location.href = '/store/detail_transaksi/'+id;
            })
          })
        </script>

        <script>
          $('#pilih_barang').select2({
            theme :'bootstrap',
            width: '100%',
          });
        </script>


        <script>
          $(document).ready(function () {
            $('#button_cari_barang').click(function(){
              var id = $('#pilih_barang').val();
              $('#pilih_sn').html('')
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                  });
              $.ajax({
                  type: "get",
                  url: '/store/detail_transaksi/cari_barang/'+id, 
                  success: function( result ) {
                    if (result.res === 'berhasil') {
                      $('#pilih_sn').attr('multiple',"multiple")
                      $.each(result.data, function (key,value) {
                            $('#pilih_sn').append($("<option></option>").attr("value", value.sn_id).text(value.no_serial)); 
                        })
                        $('#pilih_sn').select2({
                        });
                    }
                  }, error: function() { 
                    console.log("Error")
                }  
              });

            })
          })
        </script>

<script>
  $(document).ready(function (){
    $('#pilih_sn').on('select2:close', function (evt) {
    var count = $(this).select2('data').length
    if(count==0){
      $('#qty').val(0);
    }
    else{
        $('#qty').val(count);
    }
  })
})
</script>

@endsection