@extends('layouts.app', ['activePage' => 'tarea-management', 'titlePage' => __('tarea Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('tareas.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Agregar tarea') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('tareas.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div class="row">
                      <label class="col-sm-2 col-form-label">{{ __('Cliente Asociado:') }}</label>
                      <div class="col-sm-8">
                        <div class="form-group{{ $errors->has('cliente_id') ? ' has-danger' : '' }}">
                        <select title="" name="cliente_id" id="cliente_id" class="form-control form-control-xm selectpicker" data-live-search="true"  value="{{ old('user_id')}}" >
                            <option value="">No es requerido</option>
                            @foreach($clientes as $cliente)
                                <option value="{{$cliente -> id}}">
                                {{$cliente -> nombres}} {{$cliente -> apellidos}}</option>
                            @endforeach
                        </select>                     
                        @if ($errors->has('cliente_id'))
                          <span id="cliente_id-error" class="error text-danger" for="input-cliente_id">{{ $errors->first('asignado_a') }}</span>
                        @endif
                      </div>
                     </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Tipo de Tarea') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('tipo_tarea') ? ' has-danger' : '' }}">
                    <select class="selectpicker" name="tipo_tarea" data-style="select-with-transition" data-size="2"  value="{{ old('tipo_tarea')}}" >                   
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
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('nombre_tarea') ? ' is-invalid' : '' }}"  value="{{ old('nombre_tarea')}}" name="nombre_tarea" id="input-nombre_tarea" type="text" placeholder="{{ __('Ingrese el nombre de tarea') }}" required="true" />
                      @if ($errors->has('nombre_tarea'))
                        <span id="nombre_tarea-error" class="error text-danger" for="input-nombre_tarea">{{ $errors->first('nombre_tarea') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                  <hr>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Descripción de Tarea') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"  value="{{ old('description')}}" name="description" id="input-description" type="text" placeholder="{{ __('Ingrese la descripción de la tarea') }}" required="true" aria-required="true"/>
                      @if ($errors->has('description'))
                        <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                  <hr>

                    <div class="row">
                      <label class="col-sm-2 col-form-label">{{ __('Dirigir la Tarea A:') }}</label>
                      <div class="col-sm-3">
                        <div class="form-group{{ $errors->has('asignado_a') ? ' has-danger' : '' }}">
                        <select title="" name="asignado_a" id="asignado_a" class="form-control form-control-xm selectpicker" data-live-search="true"  value="{{ old('user_id')}}" >
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
                     <label class="col-sm-2 col-form-label">{{ __('Fecha Máxima Solución') }}</label>
                      <div class="col-sm-3">
                        <div class="form-group{{ $errors->has('fecha_solucion') ? ' has-danger' : '' }}">
                          <input class="form-control{{ $errors->has('fecha_solucion') ? ' is-invalid' : '' }}" name="fecha_solucion" id="input-fecha_solucion" type="date" placeholder="{{ __('Ingrese su fecha de solución') }}" value="{{ old('fecha_solucion') }}" required />
                          @if ($errors->has('fecha_solucion'))
                            <span id="fecha_solucion-error" class="error text-danger" for="input-fecha_solucion">{{ $errors->first('fecha_solucion') }}</span>
                          @endif
                        </div>
                      </div>
                      </div>
                      <hr>
                      <input name="user_id" id="user_id" type="text" value="{{ auth()->user()->id }}" hidden/>
                      <input name="estatus" id="estatus" type="text" value="ASIGNADA" hidden/>

              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-warning">{{ __('Agregar') }}</button>
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