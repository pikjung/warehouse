@extends('layout.index')

@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2> Warehouse Report</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form action="/report/excel" method="post">
              {{csrf_field()}}
              <div class="row">
                  <div class="col-12">
                    <div class="card-box">
                      <div class="row">
                        <div class="col-4">
                          <div class="form-group">
                            <select class="form-control" name="report">
                              <option value="gsc">GSC</option>
                              <option value="toko">Toko</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <input type="month" id="month" name="month" class="form-control" placeholder="Month" required>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <button class="btn btn-primary" id="search">Download</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
            </div>
      </div>
    </div>
</div>
@endsection
