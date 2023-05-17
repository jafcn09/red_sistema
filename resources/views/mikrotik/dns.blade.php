@extends('layouts.app', ['activePage' => 'mikrotik-management', 'titlePage' => __('Mikrotik Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
              <h4 class="card-title ">{{ __('Mikrotik Router Admin') }}</h4>
                <p class="card-category"> {{ __('DNS STATIC Y CACHE') }}</p>
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
                        <th>Name</th>
                        <th>Address</th>
                        <th>TTL</th>
                        <th>Comment</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>TTL</th>
                        <th>Comment</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($dns as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['address'] }}</td>
                            <td>{{ $item['ttl'] }}</td>
                            <td>@isset($item['comment']) {{ $item['comment'] }}@endisset</td>
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