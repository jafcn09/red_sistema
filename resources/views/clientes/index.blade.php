@extends('layouts.app', ['activePage' => 'cliente-management', 'titlePage' => __('Cliente Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Clientes') }}</h4>
                <p class="card-category"> {{ __('Aqui puedes administrar clientes') }}</p>
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

                <div class="table-responsive">
                  <table class="table table-hover table-bordered results" id="id_clientes">
                    <thead class="card-header-warning">
                      <th>
                          {{ __('Nombres') }}
                      </th>
                      <th>
                          {{ __('Apellidos') }}
                      </th>
                      <th>
                          {{ __('Cedula') }}
                      </th>
                      <th>
                        {{ __('Teléfono') }}
                      </th>
                      <th>
                        {{ __('Celular') }}
                      </th>
                      <th>
                        {{ __('Correo') }}
                      </th>

                      <th>
                        {{ __('Código contrato') }}
                      </th>
                      <th class="text-right">
                        {{ __('Actions') }}
                      </th>
                    </thead>
                    <tbody>
                    @if($count > 0)
                      @foreach($usuarios as $cliente)                     
                      @if(auth()->id() == $cliente->id && auth()->user()->isRole('CLIENTE'))
                        <tr>
                          <td>
                            {{ $cliente->nombres }}
                          </td>
                          <td>
                            {{ $cliente->apellidos }}
                          </td>
                          <td>
                            {{ $cliente->cedula }}
                          </td>
                          <td>
                            {{ $cliente->telefono }}
                          </td>
                          <td>                          
                            {{ $cliente->celular }}
                          </td>
                          <td>                          
                            {{ $cliente->email }}
                          </td>

                          <td>                                    
                            @foreach($contratos as $contrato)
                             
                                @if($contrato->user_id == $cliente->id )
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal{{$contrato->id}}" class="btn btn-primary btn-sm">

                                  {{ $contrato->contrato_num }}
                                @endif                          
                                                       
                            @endforeach  
                            </button>

                          </td>
                          <td class="td-actions text-right">
                              
                                  @csrf
                                  @if(auth()->user()->can('clientes.show'))
                                  <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('clientes.show', $cliente->id) }}" data-original-title="" title="">
                                    <i class="material-icons">face</i>
                                    <div class="ripple-container"></div>
                                  @endif
                                  @if(auth()->user()->can('clientes.edit'))                             
                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('clientes.edit', $cliente->id) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  @endif
                                  @if(auth()->user()->can('clientes.edit_clave_cliente'))
                                  <a rel="tooltip" class="btn btn-danger btn-link" href="{{ route('clientes.edit_clave_cliente', $cliente->id) }}" data-original-title="" title="">
                                    <i class="material-icons">lock_open</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  @endif
                                  </a>
                              
                          </td>
                        </tr>
                        @elseif(auth()->user()->isRole('ADMINISTRADOR') || auth()->user()->isRole('EMPLEADO'))
                        <tr>
                          <td>
                            {{ $cliente->nombres }}
                          </td>
                          <td>
                            {{ $cliente->apellidos }}
                          </td>
                          <td>
                            {{ $cliente->cedula }}
                          </td>
                          <td>
                            {{ $cliente->telefono }}
                          </td>
                          <td>                          
                            {{ $cliente->celular }}
                          </td>
                          <td>                          
                            {{ $cliente->email }}
                          </td>

                          <td>                                    
                            @foreach($contratos as $contrato)
                             
                                @if($contrato->user_id == $cliente->id )
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal{{$contrato->id}}" class="btn btn-primary btn-sm">

                                  {{ $contrato->contrato_num }}
                                @endif                          
                                                       
                            @endforeach  
                            </button>

                          </td>
                          <td class="td-actions text-right">
                              
                                  @csrf
                                  @if(auth()->user()->can('clientes.show'))
                                  <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('clientes.show', $cliente->id) }}" data-original-title="" title="">
                                    <i class="material-icons">face</i>
                                    <div class="ripple-container"></div>
                                  @endif
                                  @if(auth()->user()->can('clientes.edit'))                             
                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('clientes.edit', $cliente->id) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  @endif
                                  @if(auth()->user()->can('clientes.edit_clave_cliente'))
                                  <a rel="tooltip" class="btn btn-danger btn-link" href="{{ route('clientes.edit_clave_cliente', $cliente->id) }}" data-original-title="" title="">
                                    <i class="material-icons">lock_open</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  @endif
                                  </a>
                              
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        @else
                          <tr>
                              <td colspan="4" class="text-center">No hay datos registrados</td>
                          </tr>
                        @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

<!-- Modal Ver-->
@if($count > 0)
@foreach($contratos as $contrato)
<div class="modal fade" id="exampleModal{{$contrato->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Contrato Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{csrf_field()}}
                        @foreach($usuarios as $cliente)
                       
                             
                             @if($contrato->user_id == $cliente->id )
                             <div class="form-group">
                                <label for="nombre">Cliente del Contrato</label>
                                <input name="nombre" type="text" class="form-control" id="nombre" value="{{ $cliente->nombres }} {{ $cliente->apellidos }}">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Número Contrato</label>
                                <input name="nombre" type="text" class="form-control" id="nombre" value="{{ $contrato->contrato_num }}">
                            </div>

                            <div class="form-group">
                                <label for="descriprion">Fecha Inicio Contrato</label>
                                <input name="nombre" type="text" class="form-control" id="nombre" value="{{ $contrato->fecha_inicio }}">                           
                            <div class="form-group">
                                <label for="descriprion">Fecha Fin Contrato</label>
                                <input name="nombre" type="text" class="form-control" id="nombre" value="{{ $contrato->fecha_fin }}">                            
                            </div>
                            <div class="form-group">
                                <label for="descriprion">Descripción del Contrato</label>
                                <input name="nombre" type="text" class="form-control" id="nombre" value="{{ $contrato->descripcion }}">
                            </div>
                            <div class="form-group">
                                <label for="descriprion">Plan Contrato</label>
                                @foreach($planes as $plan)
                             
                                  @if($contrato->plan_id == $plan->id )
                                  <input name="nombre" type="text" class="form-control" id="nombre" value="Nombre: {{ $plan->nombre }} Capacidad: {{ $plan->capacidad }} MB Al precio de: {{ $plan->precio }} $">
                                  @endif
                                @endforeach
                            </div>

                            @endif                                                          
               
                    @endforeach
                   

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
        </div>
    </div>
@endforeach
@endif
  @push('js')
<script>
$(document).ready(function () {
  $('#id_clientes').DataTable({
    "paging": true,
    "searching": false,
    "showing": false,
    "pagingType": "first_last_numbers" // "simple" option for 'Previous' and 'Next' buttons only
  });
  $('.dataTables_length').addClass('bs-select');
});
</script>
@endpush

@endsection