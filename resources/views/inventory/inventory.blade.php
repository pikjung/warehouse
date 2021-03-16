@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Inventory <small></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li>
                    <button type="button" class="btn btn-sm btn-info" id="button_transfer">Transfer Barang</button>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                    <div class="col-md-12">
                      <div class="">
                        <div class="x_content">
                          <div class="row">
                            @foreach ($gudang as $item)
                                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                                    <div class="tile-stats">
                                    <div class="icon">
                                    </div>
                                    <h3>{{$item->nama_gudang}}</h3>
                                    <p><a href="/inventory/barang_masuk/{{$item->gudang_id}}"><i class="fa fa-arrow-right"></i>Show</a></p>
                                    </div>
                                </div>
                            @endforeach
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
      </div>

      <div id="modal_transfer" class="modal fade bs-example-modal-md" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Transfer Barang</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Source</label>
                    <div class="row">
                        <div class="col-10">
                            <select class="form-control" id="gudang_data" style="width: 100%">
                                @foreach($gudang as $data)
                                    <option value="{{$data->gudang_id}}">{{$data->nama_gudang}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-success" id="gudang_cari">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                        <div id="barang_body" hidden>
                            <div class="row">
                                <div class="col-10">
                                    <select id="barang_data" multiple="multiple" style="width:100%">
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-success" id="barang_cari">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="form-group">
                    <div id="serial_body" hidden>
                        <div class="row">
                            <div class="col-10">
                                <select id="serial_data" multiple="multiple" style="width:100%">
                                </select>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-success" id="serial_cari">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                    </div>
            </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" form="form_serial" id="form_serial_button" class="btn btn-primary">Save changes</button>
            </div>

          </div>
        </div>
      </div>


      <script>
          $(document).ready(function(){
              $('#button_transfer').on('click', function(){
                  $('#modal_transfer').modal('show');
              })
          })
      </script>

      <script>
        $(document).ready(function(){
              $('#gudang_cari').on('click', function(){
                  var gudang = $('#gudang_data').val();
                $('#barang_data').html('');
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    type: "POST",
                    url: '/inventory/gudang/gudang',
                    data: { gudang:gudang}, 
                    success: function( result ) {
                        if (result.res === 'berhasil') {
                            $.each(result.data, function (key,value) {
                                $('#barang_data').append($("<option></option>").attr("value", value.inventory_id).text(value.nama_barang)); 
                            })
                            $('#barang_data').select2({
                                theme :'bootstrap',
                                maximumSelectionLength: result.max_qty,
                                formatSelectionTooBig: function (limit) {

                                    // Callback

                                    return 'Too many selected items';
                                }
                            });
                            $('#barang_body').removeAttr('hidden');
                        }
                    }
                });
              })
          })
      </script>

<script>
    $(document).ready(function(){
          $('#barang_cari').on('click', function(){
              var gudang = $('#barang_data').val();
            $('#barang_data').html('');
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: "POST",
                url: '/inventory/gudang/barang',
                data: { gudang:gudang}, 
                success: function( result ) {
                    if (result.res === 'berhasil') {
                        $.each(result.data, function (key,value) {
                            $('#barang_data').append($("<option></option>").attr("value", value.sn_id).text(value.no_serial)); 
                        })
                        $('#barang_data').select2({
                            theme :'bootstrap',
                            maximumSelectionLength: result.max_qty,
                            formatSelectionTooBig: function (limit) {

                                // Callback

                                return 'Too many selected items';
                            }
                        });
                        $('#barang_body').removeAttr('hidden');
                    }
                }
            });
          })
      })
  </script>


@endsection