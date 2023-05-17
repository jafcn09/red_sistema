@extends('layouts.app', ['activePage' => 'tarea-management', 'titlePage' => __('Tarea Management')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

            @csrf
            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Ver Tarea') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('tareas.index') }}" class="btn btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div>
                    <p><strong>Tipo de Tarea: &nbsp;</strong>{{ $tarea->tipo_tarea }}
                    <p><strong>Nombre de la Tarea: &nbsp;</strong>{{ $tarea->nombre_tarea }}</p>
                    <p><strong>Descripción: &nbsp;</strong>{{ $tarea->description }}</p>
                    @foreach($usuarios as $cliente)
                      @if($tarea->cliente_id == $cliente->id)
                        <p><strong>Cliente Asociado: &nbsp;</strong>{{ $cliente->nombres }} {{ $cliente->apellidos }}</p>
                      @endif
                    @endforeach
                    @foreach($tarea->users as $usuario)
                        <p><strong>Emitido por: &nbsp;</strong>{{ $usuario->nombres }} {{ $usuario->apellidos }}</p>
                    @endforeach
                    @foreach($usuarios as $empleado)
                      @if($tarea->asignado_a == $empleado->id)
                        <p><strong>Asignado a: &nbsp;</strong>{{ $empleado->nombres }} {{ $empleado->apellidos }}</p>
                      @endif
                    @endforeach
                    <p><strong>Fecha Solución: &nbsp;</strong>{{ $tarea->fecha_solucion }}</p>
                    <p><strong>Estatus: &nbsp;</strong>{{ $tarea->estatus }}</p>
                    <p><strong>¿Esta Activo?: &nbsp;</strong>{{ $tarea->esta_activo }}</p>
                    <p><strong>Fecha Ultima Modificación: &nbsp;</strong>{{ $tarea->updated_at }}</p>
                    <p><strong>Fecha Creación: &nbsp;</strong>{{ $tarea->created_at }}</p>
              </div>
              </div>
            </div>
         </div>
    
    </div>
  </div>
@endsection
