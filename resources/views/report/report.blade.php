@extends('layout.index')

@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2> Warehouse Reports</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-12">
                  <div class="card-box">
                    <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <select name="report" id="report" class="form-control" placeholder="Report Name">
                            <option value="pogsc">PO GSC</option>
                            <option value="pouser">PO User</option>
                            <option value="delivery">Delivery</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <input type="month" id="month" class="form-control" placeholder="Month">
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <button class="btn btn-primary" id="search"><i class="glyphicon glyphicon-search"></i>Search</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-box table-responsive">
                    <div id="tableDiv">

                    </div>
                  </div>
                </div>
              </div>
            </div>
      </div>
    </div>
</div>

<script>
  $(document).ready(function(){
    $('#search').click(function(){
      var report = $('#report').val();
      var month = $('#month').val();
      $('#tableDiv').html('');
      $('#tableDiv').append('<table class="table table-striped" id="tableReport"></table>');
      if(report === '' || month === '') {
        new PNotify({
            title: 'Error!!',
            text: 'Field tidak boleh kosong!',
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
        type:'POST',
        url: '/report/download',
        data: {report:report , month:month},
        success: function( result ) {
         if( result.res === 'berhasil') {
          if (report === 'pogsc') {
            $('#tableReport').append(
              '<thead>'+
                '<th>PO GSC ID</th>'+
                '<th>DISTI</th>'+
                '<th>Attn</th>'+
                '<th>No Telp</th>'+
                '<th>Fax</th>'+
                '<th>Alamat Disti</th>'+
                '<th>PO NO GSC</th>'+
                '<th>Tanggal PO</th>'+
                '<th>TGL Terima</th>'+
                '<th>Status</th>'+
                '<th>Note</th>'+
                '<th>Payment Terms</th>'+
              '</thead>'+
              '<tbody id="table_body">'+
              '</tbody>'
              )

              $.each(result.data, function (key, value) {
                $('#table_body').append(
                    '<tr>' +
                      '<td>'+ result.data[key].data_barang_id+'</td>'+
                      '<td>'+ result.data[key].nama_disti+'</td>'+
                      '<td>'+ result.data[key].name+'</td>'+
                      '<td>'+ result.data[key].no_telp+'</td>'+
                      '<td>'+ result.data[key].fax+'</td>'+
                      '<td>'+ result.data[key].alamat+'</td>'+
                      '<td>'+ result.data[key].no_po_gsc+'</td>'+
                      '<td>'+ result.data[key].tanggal+'</td>'+
                      '<td>'+ result.data[key].tgl_terima+'</td>'+
                      '<td>'+ result.data[key].status+'</td>'+
                      '<td>'+ result.data[key].noted+'</td>'+
                      '<td>'+ result.data[key].payment_terms+'</td>'+
                    '</tr>'
                )
              });

              $('#tableReport').DataTable({
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'PO GSC - '+month},
                    {extend: 'excel', title: ' PO GSC - '+ month},
                    {extend:'print',title: 'PO GSC - '+ month},
                ],
              });
          } else if (report === 'pouser') {
            $('#tableReport').append(
              '<thead>'+
                '<th>PO USER ID</th>'+
                '<th>po_customer</th>'+
                '<th>dn_no</th>'+
                '<th>tanggal</th>'+
                '<th>status</th>'+
                '<th>customer</th>'+
                '<th>penerima</th>'+
                '<th>no_telp</th>'+
                '<th>payment_terms</th>'+
                '<th>alamat</th>'+
                '<th>no_invoice</th>'+
                '<th>no_resi</th>'+
                '<th>paket_id</th>'+
                '<th>tgl_inv</th>'+
                '<th>tgl_resi</th>'+
                '<th>tgl_payment</th>'+
                '<th>noted</th>'+
              '</thead>'+
              '<tbody id="table_body">'+
              '</tbody>'
              )

              $.each(result.data, function (key, value) {
                $('#table_body').append(
                    '<tr>' +
                      '<td>'+result.data[key].userReq_id+'</td>'+
                      '<td>'+result.data[key].po_customer+'</td>'+
                      '<td>'+result.data[key].dn_no+'</td>'+
                      '<td>'+result.data[key].tanggal+'</td>'+
                      '<td>'+result.data[key].status+'</td>'+
                      '<td>'+result.data[key].customer+'</td>'+
                      '<td>'+result.data[key].penerima+'</td>'+
                      '<td>'+result.data[key].no_telp+'</td>'+
                      '<td>'+result.data[key].payment_terms+'</td>'+
                      '<td>'+result.data[key].alamat+'</td>'+
                      '<td>'+result.data[key].no_invoice+'</td>'+
                      '<td>'+result.data[key].no_resi+'</td>'+
                      '<td>'+result.data[key].paket_id+'</td>'+
                      '<td>'+result.data[key].tgl_inv+'</td>'+
                      '<td>'+result.data[key].tgl_resi+'</td>'+
                      '<td>'+result.data[key].tgl_payment+'</td>'+
                      '<td>'+result.data[key].noted+'</td>'+
                    '</tr>'
                )
              });

              $('#tableReport').DataTable({
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'PO USER - '+month},
                    {extend: 'excel', title: 'PO USER - '+month},
                    {extend:'print',title: 'PO USER - '+month},
                ],
              });
          } else if (report === 'delivery') {
            $('#tableReport').append(
              '<thead>'+
                '<th>Nama Paket</th>'+
                '<th>Expedisi</th>'+
                '<th>Tanggal Kirim</th>'+
                '<th>PO User</th>'+
                '<th>No Resi</th>'+
              '</thead>'+
              '<tbody id="table_body">'+
              '</tbody>'
              );
                console.log(result.data)
              $('#table_body').html(result.data);

              $('#tableReport').DataTable({
                dom: '<"html5buttons">BlTfrtip',
                buttons : [
                    {extend:'csv'},
                    {extend: 'pdf', title:'Delivery - '+month},
                    {extend: 'excel', title: 'Delivery - '+month},
                    {extend:'print',title: 'Delivery - '+month},
                ],
              });
          }



         }
        }
      });
      }

      
    })
  })
</script>
@endsection