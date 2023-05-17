@extends('layouts.app', ['activePage' => 'nodo-management', 'titlePage' => __('Nodo Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('nodos.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Agregar Nodo') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('nodos.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nombre del nodo') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                    <input onkeyup="mayus(this);" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" id="input-nombre" type="text" placeholder="{{ __('Ingrese su nombre') }}" value="{{ old('nombre')}}" required="true" aria-required="true"/>
                      @if ($errors->has('nombre'))
                        <span id="nodo-error" class="error text-danger" for="input-nombre">{{ $errors->first('nombre') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Descripción del nodo') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
                    <input onkeyup="mayus(this);" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" id="input-descripcion" type="text" placeholder="{{ __('Ingrese su descripción del nodo') }}" value="{{ old('descripcion') }}" required="true" aria-required="true"/>
                      @if ($errors->has('descripcion'))
                        <span id="descripcion-error" class="error text-danger" for="input-descripcion">{{ $errors->first('descripcion') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Torre a conectar') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('torre_id') ? ' has-danger' : '' }}">
                    <select class="selectpicker" name="torre_id" data-style="select-with-transition" data-size="10">> 
                        @foreach($torres as $torre)
                          <option value="{{$torre->id}}">{{$torre->nombre_torre}} {{$torre->descripcion_torre}}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('torre_id'))
                        <span id="torre_id-error" class="error text-danger" for="input-torre_id">{{ $errors->first('torre_id') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Equipo asociado') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('producto_id') ? ' has-danger' : '' }}">
                    <select class="selectpicker" name="producto_id" data-style="select-with-transition" data-size="6">> 
                        @foreach($productos as $producto)
                          <option value="{{$producto->id}}">{{$producto->codigo}} {{$producto->marca}} {{$producto->modelo}}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('producto_id'))
                        <span id="producto_id-error" class="error text-danger" for="input-producto_id">{{ $errors->first('producto_id') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('IP del Dispositivo') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('ip') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('ip') ? ' is-invalid' : '' }}" name="ip" id="input-ip" type="text" placeholder="{{ __('Ingrese la IP del dispositivo') }}" value="{{ old('ip') }}" required="true" aria-required="true"/>
                      
                      @if ($errors->has('ip'))
                        <span id="ip-error" class="error text-danger" for="input-ip">{{ $errors->first('ip') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('MAC del Dispositivo') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('mac') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('mac') ? ' is-invalid' : '' }}" name="mac" id="input-mac" type="text" placeholder="{{ __('Ingrese la MAC del dispositivo') }}" value="{{ old('mac') }}" required="true" />
                      @if ($errors->has('mac'))
                        <span id="mac-error" class="error text-danger" for="input-mac">{{ $errors->first('mac') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Esta Activo') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('activo') ? ' has-danger' : '' }}">
                    <select class="selectpicker" name="activo" data-style="select-with-transition" data-size="4">
                          <option value="SI">ACTIVO</option>
                          <option value="NO">INACTIVO</option>                   
                      </select>                      
                      @if ($errors->has('activo'))
                        <span id="activo-error" class="error text-danger" for="input-activo">{{ $errors->first('activo') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Imagen del nodo') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('imagen') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('imagen') ? ' is-invalid' : '' }}" name="imagen" id="input-imagen" type="text" placeholder="{{ __('Ingrese la imagen del nodo') }}" value="{{ old('imagen') }}" required />
                      @if ($errors->has('imagen'))
                        <span id="imagen-error" class="error text-danger" for="input-imagen">{{ $errors->first('imagen') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

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
@endpush
@endsection