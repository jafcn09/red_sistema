@extends('layouts.app', ['activePage' => 'mikrotik-management', 'titlePage' => __('Mikrotik Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
              <h4 class="card-title ">{{ __('Mikrotik Router Admin') }}</h4>
                <p class="card-category"> {{ __('INTERFACES ESTADISTICAS') }}</p>
              </div>
              <div class="card-body">
              <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('mikrotik.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
              <div class="container" style="margin-top:90px;"> 
                <div class="row">

                <table id="table_id" class="table table-striped table-bordered dt-responsive" style="width:100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Last Link Up Time</th>
                        <th>Links Downs</th>
                        <th>Graph</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Last Link Up Time</th>
                        <th>Links Downs</th>
                        <th>Graph</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($interface as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['type'] }}</td>
                            <td>@isset($item['last-link-up-time']){{ $item['last-link-up-time'] }}@endisset</td>
                            <td>{{ $item['link-downs'] }}</td>
                            <td>
                                @php
                                    echo '<img src="data: image/gif;base64,' . base64_encode(file_get_contents("http://" . env('ROSIPADDRESS') . "/graphs/iface/" . $item['name'] . "/daily.gif")) .'">';
                                @endphp
                            </td>
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