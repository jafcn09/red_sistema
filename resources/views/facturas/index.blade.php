@extends('layouts.app', ['activePage' => 'facturas', 'titlePage' => __('Factura Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Facturas') }}</h4>
                <p class="card-category"> {{ __('Aqui podemos administrar las facturas') }}</p>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-12 text-right">
                  @if(auth()->user()->can('facturas.create'))
                    <a href="{{ route('facturas.create') }}" class="btn btn-sm btn-warning">{{ __('Agregar factura') }}</a>
                  @endif
                  </div>
                </div>
                @include('facturas.search')
        <div class="table-responsive">
 
            <table class="table table-hover table-bordered results" id="id_facturas">
                <thead>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Tipo de comprobante</th>
                    <th>Numero del comprobante</th>
                    <th>Impuesto</th>
                    <th>Total</th> 
                    <th>Cancelado</th>                      
                    <th>Acción</th>
                </thead>
                @foreach($facturas as $ven)
                @if(auth()->id() == $ven->cliente_id && auth()->user()->isRole('CLIENTE'))
                <tr>
                    <td>{{$ven -> id}}</td>
                    <td>{{$ven -> fecha_hora}}</td>
                    <td>{{$ven -> nombres}} {{$ven -> apellidos}}</td>
                    <td>{{$ven -> tipo_comprobante}}</td>
                    <td>{{$ven -> factura_num}}</td>
                    
                    <td>{{$ven -> impuesto}} %</td>
                    <td>{{$ven -> total + ($ven->total * $ven->impuesto/100) }}</td>                    
                    <td>{{$ven -> esta_paga}}</td>                    
                    <td>
                    @if(auth()->user()->can('facturas.show'))
                        <a href="{{URL::action('FacturaController@show', $ven -> id)}}">
                            <button class="btn btn-info">Detalle</button>
                        </a>
                    @endif
                    @if(auth()->user()->can('facturas.destroy'))
                        <a href="" data-target="#modal-delete-{{$ven -> id}}" data-toggle="modal">
                            <button class="btn btn-danger"> Anular </button>
                        </a>
                    @endif
                    </td>
                </tr> 
                @include('facturas.modal')
                @elseif(auth()->user()->isRole('ADMINISTRADOR') || auth()->user()->isRole('EMPLEADO'))
                <tr>
                    <td>{{$ven -> id}}</td>
                    <td>{{$ven -> fecha_hora}}</td>
                    <td>{{$ven -> nombres}} {{$ven -> apellidos}}</td>
                    <td>{{$ven -> tipo_comprobante}}</td>
                    <td>{{$ven -> factura_num}}</td>
                    
                    <td>{{$ven -> impuesto}} %</td>
                    <td>{{$ven -> total }}</td>                    
                    <td>{{$ven -> esta_paga}}</td>                    
                    <td>
                    @if(auth()->user()->can('facturas.show'))
                        <a href="{{URL::action('FacturaController@show', $ven -> id)}}">
                            <button class="btn btn-info">Detalle</button>
                        </a>
                    @endif
                    @if(auth()->user()->can('facturas.destroy'))
                        <a href="" data-target="#modal-delete-{{$ven -> id}}" data-toggle="modal">
                            <button class="btn btn-danger"> Anular </button>
                        </a>
                    @endif
                    </td>
                </tr> 
                @include('facturas.modal')
                @endif
                @endforeach </table>
        </div>
         {{$facturas -> render()}}
    </div>
</div> 
@push('js')
<script>
$(document).ready(function () {
  $('#id_facturas').DataTable({
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
