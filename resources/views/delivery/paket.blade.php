@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Paket <small>Table</small></h2>
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
                          <table id="data_paket" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>DN No</th>
                                <th>Nama Paket</th>
                                <th>No Resi</th>
                                <th>Tanggal Kirim</th>
                                <th>Status</th>
                                <th>Detail</th>
                                <th>Action</th>
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
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Tambah Data Paket</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                      <label for="">DN No</label>
                      <input type="text" class="form-control" id="dn_no">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Paket</label>
                        <input type="text" class="form-control" id="nama_paket">
                    </div>
                    <div class="form-group">
                        <label for="">Expedisi</label>
                        <select name="expedisi" id="expedisi" class="form-control">
                          @foreach ($expedisi as $item)
                            <option value="{{$item->expedisi_id}}">{{$item->nama_expedisi}}</option>
                          @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_paket" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_edit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Edit Data Paket</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="">DN No</label>
                <input type="text" class="form-control" id="dn_no_edit">
              </div>
              <div class="form-group">
                  <label for="">Nama Paket</label>
                  <input type="hidden" id="edit_id">
                  <input type="text" class="form-control" id="nama_paket_edit">
              </div>
              <div class="form-group">
                <label for="">Expedisi</label>
                <select name="expedisi" id="expedisi_edit" class="form-control">
                  @foreach ($expedisi as $item)
                    <option value="{{$item->expedisi_id}}">{{$item->nama_expedisi}}</option>
                  @endforeach
                </select>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="save_edit_paket" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>

      <div id="modal_hapus" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Hapus Data Paket</h4>
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
                      <button class="btn btn-success" id="detail_po"><i class="glyphicon glyphicon-list"></i></button>|
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

      <div id="modal_detail_select" class="modal fade bs-example-modal-md" tabindex="9" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Pilih PO</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">Pilih PO</label>
                      <input type="hidden" id="delivery_id">
                      <select name="" id="detail_select" class="form-control" multiple="multiple" style="width:100%"></select>
                    </div>
                  </div>
                </div>
            </div>

            <div class="modal-footer">
              <div class="float-right">
                <button class="btn btn-success" id="save_detail">Save</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="modal_konfirmasi" class="modal fade bs-example-modal-md" tabindex="9" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Konfirmasi Pengiriman</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div id="konfirmasi_data">

                </div>
            </div>

            <div class="modal-footer">
              <div class="col-6">
                <div class="float-left">
                  <input type="hidden" id="id_kirim">
                  <input type="text" class="form-control" id="no_resi" placeholder="Isi no resi di sini ...">
                </div>
              </div>
              <div class="col-6">
                <div class="float-right">
                  <button class="btn btn-success" id="save_kirim">Kirim</button>
                </div>
              </div>
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

      <script type="text/javascript">
        $(document).ready(function() {
            $('#data_paket').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'Contoh File PDF Datatables'},
                    {extend: 'excel', title: 'Contoh File Excel Datatables'},
                    {extend:'print',title: 'Contoh Print Datatables'},
                ],
                ajax: '/delivery/paket/view',
                columns: [
                    {data: 'dn_no', name: 'dn_no'},
                    {data: 'nama_paket', name: 'nama_paket'},
                    {data: 'no_resi', name: 'no_resi'},
                    {data: 'tgl_kirim', name: 'tgl_kirim' },
                    {data: 'status', name: 'status' },
                    {data: 'detail', name: 'detail'},
                    {data: 'action', name:'action', orderable: false, searchable:false},
                    {data: 'print', name: 'print'},
                ],
            });
        });
        </script>

        <script>
          $(document).ready(function () {
            $('#button_modal').click(function () {
              $('#button_modal').val('');
              $('#modal_tambah').modal('show');
            })
          })
        </script>

        <script>
          $(document).ready(function () {
            $('#save_paket').click(function () {
              var dn_no = $('#dn_no').val();
              var nama_paket = $('#nama_paket').val()
              var expedisi = $('#expedisi').val()
              if (dn_no =='' || nama_paket === '') {
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
                    url: '/delivery/paket/tambah',
                    data: {dn_no:dn_no, nama_paket:nama_paket, expedisi_id:expedisi}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                          new PNotify({
                              title: 'Success!!',
                              text: 'Data Berhasil di tambah!',
                              type: 'success',
                              styling: 'bootstrap3'
                          });
                          $('#data_paket').DataTable().ajax.reload()
                          $('#modal_tambah').modal('hide');
                        }
                    }
                  });
              }
            })
          })
        </script>

        <script>
          function edit_paket(id) {
            $('#nama_paket_edit').val('');
            $('#dn_no_edit').val('');
            $('#edit_id').val('')
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: "POST",
                url: '/delivery/paket/editGet',
                data: { id:id}, 
                success: function( result ) {
                    if (result.res === 'berhasil') {
                      $('#nama_paket_edit').val(result.data.nama_paket);
                      $('#edit_id').val(id)
                      $('#modal_edit').modal('show');
                    }
                }
              });
              }
        </script>

        <script>
          $(document).ready(function () {
            $('#save_edit_paket').click(function () {
              var dn_no = $('#dn_no_edit').val();
              var nama_paket = $('#nama_paket_edit').val()
              var expedisi = $('#expedisi_edit').val()
              var id = $('#edit_id').val()
              if (dn_no === '' || nama_paket === '') {
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
                    url: '/delivery/paket/editStore',
                    data: { id:id,dn_no:dn_no,nama_paket:nama_paket, expedisi_id:expedisi}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                          new PNotify({
                              title: 'Success!!',
                              text: 'Data Berhasil di tambah!',
                              type: 'success',
                              styling: 'bootstrap3'
                          });
                          $('#data_paket').DataTable().ajax.reload()
                          $('#modal_edit').modal('hide');
                        }
                    }
                  });
              }
            })
          })
        </script>

        <script>
          function hapus_paket(id) {
            $('#hapus_id').val('')
            $('#hapus_id').val(id);
            $('#pesan_hapus').html('')
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
              });
              $.ajax({
                  type: "GET",
                  url: '/delivery/paket/hapusGet',
                  data: { id:id}, 
                  success: function( result ) {
                      if (result.res === 'berhasil') {
                        $('#pesan_hapus').html('<p class="text-danger">Harap Kosongkan Detail sebelum menghapus Paket</p>')
                        $('#hapus_button').attr('disabled','');
                      } else {
                        $('#hapus_button').removeAttr('disabled','');
                      }
                  }
                });
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
                  url: '/delivery/paket/hapus',
                  data: { id:id}, 
                  success: function( result ) {
                      if (result.res === 'berhasil') {
                        new PNotify({
                            title: 'Success!!',
                            text: 'Data Berhasil di Hapus!',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                        $('#data_paket').DataTable().ajax.reload()
                        $('#modal_hapus').modal('hide');
                      }
                  }
                });
            })
          })
        </script>

        <script>
          function detail_paket(id) {
            $('#detail_data').html('');
            $('#delivery_id').val('');
            $('#delivery_id').val(id);
            $('#expedisi_detail').html('')
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
              });
              $.ajax({
                  type: "POST",
                  url: '/delivery/paket/detail',
                  data: { id:id}, 
                  success: function( result ) {
                      if (result.res === 'berhasil') {
                        if (result.paket.status == 'Terkirim') {
                          $('#expedisi_detail').html(result.nama_expedisi)
                          $('#detail_id').val(result.id)
                          $.each(result.data, function (key, val) {
                            $('#detail_data').append('<tr><td>'+val.po_customer+'</td></tr>');
                          })
                          $('#tambah_detail').attr('disabled','')
                        } else {
                          $('#expedisi_detail').html(result.nama_expedisi)
                          $('#detail_id').val(result.id)
                          $.each(result.data, function (key, val) {
                            $('#detail_data').append('<tr><td>'+val.po_customer+'</td><td><button class="btn btn-danger" onclick=hapus_detail("'+val.userReq_id+'")><i class="glyphicon glyphicon-trash"></i></button></td></tr>');
                          })
                          $('#tambah_detail').removeAttr('disabled','')
                        }
                        $('#modal_detail').modal('show');
                      }
                  }
                });
          }
        </script>

        <script>
          $(document).ready(function(){
            $('#detail_po').click(function(){
              var id = $('#delivery_id').val();
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
                          $('#modal_detail').modal('hide');
                          $('#modal_paket').modal('show');
                        }
                      }
                });
            })
          })
        </script>

        <script>
          $(document).ready(function () {
            $('#tambah_detail').click(function () {
              $('#detail_select').html('');
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: "GET",
                url: '/delivery/paket/detail/select',
                success: function( result ) {
                    if (result.res === 'berhasil') {
                        $.each(result.data, function (key,value) {
                            $('#detail_select').append($("<option></option>").attr("value", value.userReq_id).text(value.po_customer)); 
                        })
                        $('#detail_select').select2({
                            theme :'bootstrap'
                        });
                    }
                }
            });
              $('#modal_detail_select').modal('show');
            })
          })
        </script>

        <script>
          $(document).ready(function () {
            $('#save_detail').click(function () {
              var data = $("#detail_select").val();
              var id = $('#delivery_id').val();
              console.log(data)
              $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
              });
              $.ajax({
                  type: "POST",
                  url: '/delivery/paket/detail/add',
                  data: {id:id, data:data},
                  success: function( result ) {
                      if (result.res === 'berhasil') {
                        new PNotify({
                            title: 'Success!!',
                            text: 'Detail delivery dibuat!',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                          $('#modal_detail_select').modal('hide');
                          $('#modal_detail').modal('hide');
                      }
                  }
              });
            })
          })
        </script>

        <script>
          function hapus_detail(id) {
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
              });
              $.ajax({
                  type: "POST",
                  url: '/delivery/paket/detail/delete',
                  data: {id:id},
                  success: function( result ) {
                      if (result.res === 'berhasil') {
                        new PNotify({
                            title: 'Success!!',
                            text: 'PO dihapus pada Paket!',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                          $('#modal_detail').modal('hide');
                      }
                  }
              });
          }
        </script>

        <script>
          function kirim_paket(id) {
            $('#konfirmasi_data').html('');
            $('#id_kirim').val('')
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
              });
              $.ajax({
                  type: "GET",
                  url: '/delivery/paket/konfirmasi',
                  data: {id:id},
                  success: function( result ) {
                      if (result.res === 'berhasil') {
                          $('#konfirmasi_data').html(result.data)
                          $('#no_resi').val('');
                          $('#id_kirim').val(result.id)
                          $('#modal_konfirmasi').modal('show');
                      }
                  }
              });
          }
        </script>

        <script>
          $(document).ready(function () {
            $('#save_kirim').click(function () {
              var id = $('#id_kirim').val();
              var no_resi = $('#no_resi').val();

              if (no_resi === '') {
                new PNotify({
                    title: 'Error!!',
                    text: 'No Resi Kosong!',
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
                  url: '/delivery/paket/kirim',
                  data: {id:id,no_resi:no_resi},
                  success: function( result ) {
                      if (result.res === 'berhasil') {
                        new PNotify({
                            title: 'Success!!',
                            text: 'Paket Terkirim!',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                        $('#data_paket').DataTable().ajax.reload()
                          $('#modal_konfirmasi').modal('hide');
                      }
                  }
              });
              }
            })
          })
        </script>


@endsection