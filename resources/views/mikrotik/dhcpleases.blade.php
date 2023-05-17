@extends('layouts.app', ['activePage' => 'mikrotik-management', 'titlePage' => __('Mikrotik Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
              <h4 class="card-title ">{{ __('Mikrotik Router Admin') }}</h4>
                <p class="card-category"> {{ __('DHCP LEASES') }}</p>
              </div>
              <div class="card-body">
              <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('mikrotik.index') }}" class="btn btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div class="container" style="margin-top:90px;"> 
                  <div class="row">

                  <table id="table_id" class="table table-striped table-bordered dt-responsive" style="width:100%">
                      <thead>
                      <tr>
                          <th>IP</th>
                          <th>MAC Address</th>
                          <th>Status</th>
                          <th>Last Seen</th>
                          <th>Hostname</th>
                          <th>Comment</th>
                      </tr>
                      </thead>
                      <tfoot>
                      <tr>
                          <th>IP</th>
                          <th>MAC Address</th>
                          <th>Status</th>
                          <th>Last Seen</th>
                          <th>Hostname</th>
                          <th>Comment</th>
                      </tr>
                      </tfoot>
                      <tbody>
                      @foreach($leases as $lease)
                          <tr>
                              <td>{{ $lease['address'] }}</td>
                              <td>{{ $lease['mac-address'] }}</td>
                              <td>{{ $lease['status'] }}</td>
                              <td>{{ $lease['last-seen'] }}</td>
                              <td>@isset($lease['host-name']) {{ $lease['host-name'] }}@endisset</td>
                              <td>@isset($lease['comment']) {{ $lease['comment'] }}@endisset</td>
                          </tr>
                      @endforeach
                      </tbody>
                  </table>
                </div>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>

@endsection