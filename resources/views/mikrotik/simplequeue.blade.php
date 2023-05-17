@extends('layouts.app', ['activePage' => 'mikrotik-management', 'titlePage' => __('Mikrotik Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Mikrotik Router Admin') }}</h4>
                <p class="card-category"> {{ __('QUEUE SIMPLE') }}</p>
              </div>
              <div class="card-body">
              <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('mikrotik.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
            <div class="container" style="margin-top:90px;"> 
              <div class="row">
                  <table id="table_id" class="results table table-striped table-bordered dt-responsive" style="width:100%">
                      <thead>
                      <tr>
                          <th style="width:10px">Nombre</th>
                          <th>Gráfica de consumo diario</th>
                          <th>IP/Rango</th>
                          <th>Depende</th>
                          <th>Prioridad</th>
                          <th>Max Limit KBPS</th>
                      </tr>
                      </thead>
                      <tfoot>
                      <tr>
                      <th>Nombre</th>
                          <th>Gráfica de consumo diario</th>
                          <th>IP/Rango</th>
                          <th>Depende</th>
                          <th>Prioridad</th>
                          <th>Max Limit KBPS</th>
                      </tr>
                      </tfoot>
                      <tbody>
                      @foreach($queue as $item)
                          <tr>
                              <td style="width:10px">{{ $item['name'] }}</td>
                              <td>
                              @php
                                      echo '<img style="width:400px" src="data: image/gif;base64,' . base64_encode(file_get_contents("http://" . env('ROSIPADDRESS') . "/graphs/queue/" . $item['name'] . "/daily.gif")) .'">';
                                  @endphp

                              <td>@isset($item['target']){{ $item['target'] }}@endisset</td>
                              <td>@isset($item['parent']){{ $item['parent'] }}@endisset</td>
                              <td>@isset($item['priority']){{ $item['priority'] }}@endisset</td>
                              <td>@isset($item['max-limit']){{ $item['max-limit'] }}@endisset</td>
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
@push('js')
<script>
$(document).ready(function () {
  $('#table_id').DataTable({
    "paging": true,
    "searching": false,
    "showing": false,
    "orderBy": asc,
    "pagingType": "first_last_numbers" // "simple" option for 'Previous' and 'Next' buttons only
  });
  $('.dataTables_length').addClass('bs-select');
});
</script>
@endpush
@endsection