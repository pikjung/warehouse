@extends('layout.index')

@section('content')
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2> Inventory <small>Table</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                    <div class="count">Gudang</div>
            
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


@endsection