@extends('layouts.app', ['activePage' => 'tarea-management', 'titlePage' => __('Tarea Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('tareas.update', $tarea) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Editar Tarea') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('tareas.index') }}" class="btn btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
              @if($tarea->cliente_id)
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Cliente Asociado') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('cliente_id') ? ' has-danger' : '' }}">
                    <select title="" name="cliente_id" id="cliente_id" class="form-control form-control-xs selectpicker" data-live-search="true">
                            <option value="{{$user->id}}">{{$user->nombres}} {{$user->apellidos}}</option>
                        @foreach($usuarios as $cliente)
                            <option value="{{$cliente -> id}}">
                            {{$cliente -> nombres}} {{$cliente -> apellidos}}</option>
                        @endforeach
                    </select>                      
                      @if ($errors->has('cliente_id'))
                        <span id="cliente_id-error" class="error text-danger" for="input-cliente_id">{{ $errors->first('cliente_id') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
              @endif

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Tipo de Tarea') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('tipo_tarea') ? ' has-danger' : '' }}">
                    <select class="selectpicker" name="tipo_tarea" data-style="select-with-transition" data-size="2"> 
                              @if($tarea->tipo_tarea == "FALLA")
                           <option selected value="FALLA">FALLA
                              @elseif($tarea->tipo_tarea == "RECLAMO")
                           <option selected value="RECLAMO">RECLAMO
                              @elseif($tarea->tipo_tarea == "SOLICITUD")
                           <option selected value="SOLICITUD">SOLICITUD
                              @endif
                           </option> 
                          
                          <option value="FALLA">FALLA</option>
                          <option value="RECLAMO">RECLAMO</option>
                          <option value="SOLICITUD">SOLICITUD</option>                 
                      </select>                       
                      @if ($errors->has('tipo_tarea'))
                        <span id="tipo_tarea-error" class="error text-danger" for="input-tipo_tarea">{{ $errors->first('tipo_tarea') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Nombre de Tarea') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('nombre_tarea') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('nombre_tarea') ? ' is-invalid' : '' }}" name="nombre_tarea" id="input-nombre_tarea" type="text" placeholder="{{ __('Ingrese su nombre de la tarea') }}" value="{{ old('nombre_tarea', $tarea->nombre_tarea) }}" required="true" />
                      @if ($errors->has('nombre_tarea'))
                        <span id="nombre_tarea-error" class="error text-danger" for="input-nombre_tarea">{{ $errors->first('nombre_tarea') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                  <hr>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Descripción de la Tarea') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="input-description" type="text" placeholder="{{ __('Ingrese la descripción de la tarea') }}" value="{{ old('description', $tarea->description) }}" required="true" aria-required="true"/>
                      
                      @if ($errors->has('description'))
                        <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Asignada la Tarea A') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('tarea') ? ' has-danger' : '' }}">
                    <select title="" name="asignado_a" id="asignado_a" class="form-control form-control-xs selectpicker" data-live-search="true">
                            <option value="{{$user->id}}">{{$user->nombres}} {{$user->apellidos}}</option>
                        @foreach($usuarios as $empleado)
                            <option value="{{$empleado -> id}}">
                            {{$empleado -> nombres}} {{$empleado -> apellidos}}</option>
                        @endforeach
                    </select>                      
                      @if ($errors->has('asignado_a'))
                        <span id="asignado_a-error" class="error text-danger" for="input-asignado_a">{{ $errors->first('asignado_a') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Fecha Máxima de Solución') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('fecha_solucion') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('fecha_solucion') ? ' is-invalid' : '' }}" name="fecha_solucion" id="input-fecha_solucion" type="date" placeholder="{{ __('Ingrese su fecha_solucion') }}" value="{{ old('fecha_solucion', $tarea->fecha_solucion) }}" required />
                      @if ($errors->has('fecha_solucion'))
                        <span id="fecha_solucion-error" class="error text-danger" for="input-fecha_solucion">{{ $errors->first('fecha_solucion') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                  <hr>
                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Estatus') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('estatus') ? ' has-danger' : '' }}">

                    <select class="selectpicker" name="estatus" data-style="select-with-transition" data-size="2"> 
                              @if($tarea->estatus == "ASIGNADA")
                           <option selected value="ASIGNADA">ASIGNADA
                              @elseif($tarea->estatus == "EN-PROCESO")
                           <option selected value="EN-PROCESO">EN-PROCESO
                              @elseif($tarea->estatus == "COMPLETADA")
                           <option selected value="COMPLETADA">COMPLETADA
                              @endif
                           </option> 
                          
                          <option value="ASIGNADA">ASIGNADA</option>
                          <option value="EN-PROCESO">EN-PROCESO</option>
                          <option value="COMPLETADA">COMPLETADA</option>                 
                      </select>   
                      @if ($errors->has('estatus'))
                        <span id="estatus-error" class="error text-danger" for="input-estatus">{{ $errors->first('estatus') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('¿Esta Activo?') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('esta_activo') ? ' has-danger' : '' }}">

                    <select class="selectpicker" name="esta_activo" data-style="select-with-transition" data-size="2"> 
                              @if($tarea->esta_activo == "SI")
                           <option selected value="SI">SI
                              @elseif($tarea->esta_activo == "NO")
                           <option selected value="NO">NO
                              @endif
                           </option> 
                          
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>               
                      </select>   
                      @if ($errors->has('esta_activo'))
                        <span id="esta_activo-error" class="error text-danger" for="input-esta_activo">{{ $errors->first('esta_activo') }}</span>
                      @endif
                    </div>
                  </div>

                  </div>
                  <input name="user_id" id="user_id" type="text" value="{{ auth()->user()->id }}" hidden/>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-warning">{{ __('Guardar') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @push('js')
<script>
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>
<script src="{{ asset('js/buscador-bootstrap.js') }}"></script>
@endpush
@endsection