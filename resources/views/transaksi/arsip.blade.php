@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> PO User <small>Table</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          <table id="data_pouser" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th width="10%">PO No</th>
                                <th width="10%">DN No.</th>
                                <th>Status</th>
                                <th>Noted</th>
                                <th width="20%">Detail</th>
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
                                <th>Spek</th>
                                <th>Quantity</th>
                                <th>Harga</th>
                            </thead>
                            <tbody id="detail_barang">
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
            $('#data_pouser').DataTable({
                processing: true,
                serverSide: true,
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'Contoh File PDF Datatables'},
                    {extend: 'excel', title: 'Contoh File Excel Datatables'},
                    {extend:'print',title: 'Contoh Print Datatables'},
                ],
                ajax: '/transaksi/arsipView',
                columns: [
                    {data: 'po_customer', name: 'po_customer'},
                    {data: 'dn_no', name: 'dn_no'},
                    {data: 'status', name: 'status' },
                    {data: 'noted', name: 'noted' },
                    {data: 'detail', name:'detail', orderable: false, searchable:false},
                    {data: 'print', name:'print', orderable: false, searchable:false},
                ],
            });
        });
        </script>

<!-- gsc -->

<script>
    function detail_pouser(id){
        $('#detail_barang').html('');
        $('#detail_id').val('');
        $('#detail_id').val(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/transaksi/arsip/detail',
            data: { id:id}, 
            success: function( result ) {
                if (result.res === 'berhasil') {
                  console.log(result.status)
                  if (result.status === 'Terkirim') {
                    $('#detail_edit').attr('disabled','');
                  } else {
                    $('#detail_edit').removeAttr('disabled','');
                  }
                    $.each(result.data, function (key, value) {
                        $('#detail_barang').append(
                            '<tr>' +
                                '<td>'+value.nama_barang+'</td>' +
                                '<td>'+value.spek+'</td>' +
                                '<td>'+value.quantity+'</td>' +
                                '<td>'+value.harga_barang_satuan+'</td>' +
                            '</tr>'
                        )
                    });
                    $('#modal_detail').modal('show');
                }
            }
          });
    }
</script>

<script>
    $(document).ready(function () {
        $('#detail_edit').click(function () {
           var id =  $('#detail_id').val();
           window.location.href = '/transaksi/po/detailMode/'+id;
        })
    })
</script>

<script>
  function print_invoice(id) {
    window.location.href = "/transaksi/po/print_invoice/"+id;
  }
</script>

<script>
  function print_dn(id) {
    window.location.href = "/transaksi/po/print_dn/"+id;
  }
</script>


<script>
 function edit_inv_button() {
      $('#inv_po').removeAttr('readonly','')
      $('#disc').removeAttr('readonly','')
      $('#inv_button').removeAttr('disabled','')
 }
</script>

<script>
  function lihat_paket(id) {
    $('#paket_body').html('');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '/transaksi/arsip/lihat_paket',
            data: { id:id}, 
            success: function( result ) {
                if (result.res === 'berhasil') {
                  $('#paket_body').html(result.data);
                $('#modal_paket').modal('show');
            }
            }
          });
  }
</script>

@endsection