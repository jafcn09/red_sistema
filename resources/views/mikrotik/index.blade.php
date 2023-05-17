@extends('layouts.app', ['activePage' => 'mikrotik_management', 'titlePage' => __('Mikrotik Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Mikrotik Router Admin') }}</h4>
                <p class="card-category"> {{ __('Aqui puedes administrar los router borad') }}</p>
              </div>
              <div class="card-body">
              <div class="container" style="margin-top:90px;"> 
                <div class="row">
                  <hr>
                    <a href="/mikrotik/dhcpleases" class="btn btn-warning">DHCP Leases</a>
                    <a href="/mikrotik/dnscache" class="btn btn-warning">DNS Cache</a>
                    <a href="/mikrotik/dnsstatic" class="btn btn-warning">DNS Static</a>
                    <a href="/mikrotik/interface" class="btn btn-warning">Interface</a>
                    <a href="/mikrotik/queue" class="btn btn-warning">Simple Queue</a>
                  <hr>
                </div>

                <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Uso del CPU') }}</label>
                  <div class="col-sm-8">
                    @php
                      echo '<img src="data: image/gif;base64,' . base64_encode(file_get_contents("http://" . env('ROSIPADDRESS') . "/graphs/cpu/daily.gif")) .'">';
                    @endphp
                  </div>
                </div><br>
                <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Uso de la Memoria RAM') }}</label>
                  <div class="col-sm-8">
                    @php
                      echo '<img src="data: image/gif;base64,' . base64_encode(file_get_contents("http://" . env('ROSIPADDRESS') . "/graphs/ram/daily.gif")) .'">';
                    @endphp
                  </div>
                </div><br>
                <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Uso del Disco Duro') }}</label>
                  <div class="col-sm-8">
                    @php
                      echo '<img src="data: image/gif;base64,' . base64_encode(file_get_contents("http://" . env('ROSIPADDRESS') . "/graphs/hdd/daily.gif")) .'">';
                    @endphp
                  </div>
                </div>

              </div>
          </div>
        </div>
      </div>


@endsection