@extends('layouts.app', ['activePage' => 'torre-management', 'titlePage' => __('Torre Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('torres.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Agregar Torre') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('torres.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nombre de la Torre') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('nombre_torre') ? ' has-danger' : '' }}">
                    <input onkeyup="mayus(this);" class="form-control{{ $errors->has('nombre_torre') ? ' is-invalid' : '' }}" name="nombre_torre" id="input-nombre_torre" type="text" placeholder="{{ __('Ingrese el nombre de la torre') }}" value="{{ old('nombre_torre') }}" required="true" aria-required="true"/>

                      @if ($errors->has('nombre_torre'))
                        <span id="nombre_torre-error" class="error text-danger" for="input-nombre_torre">{{ $errors->first('nombre_torre') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Descripción de la Torre') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('descripcion_torre') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('descripcion_torre') ? ' is-invalid' : '' }}" name="descripcion_torre" id="input-descripcion_torre" type="text" placeholder="{{ __('Ingrese su descripcion de la torre') }}" value="{{ old('descripcion_torre') }}" required="true" aria-required="true"/>
                      
                      @if ($errors->has('descripcion_torre'))
                        <span id="descripcion_torre-error" class="error text-danger" for="input-descripcion_torre">{{ $errors->first('descripcion_torre') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                  <hr>
                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Calle Principal') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('calle_p') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('calle_p') ? ' is-invalid' : '' }}" name="calle_p" id="input-calle_p" type="text" placeholder="{{ __('Ingrese la calle principal') }}" value="{{ old('calle_p') }}" required="true" />
                      @if ($errors->has('calle_p'))
                        <span id="calle_p-error" class="error text-danger" for="input-calle_p">{{ $errors->first('calle_p') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Calle Secundaria') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('calle_s') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('calle_s') ? ' is-invalid' : '' }}" name="calle_s" id="input-calle_s" type="text" placeholder="{{ __('Ingrese la calle secundaria') }}" value="{{ old('calle_s') }}" required="true" aria-required="true"/>
                      
                      @if ($errors->has('calle_s'))
                        <span id="calle_s-error" class="error text-danger" for="input-calle_s">{{ $errors->first('calle_s') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Ingrese la Direccción') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('direccion') ? ' has-danger' : '' }}">
                    <input onkeyup="mayus(this);" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" id="input-direccion" type="text" placeholder="{{ __('Ingrese la direccion de la torre') }}" value="{{ old('direccion') }}" required />
                      @if ($errors->has('direccion'))
                        <span id="direccion-error" class="error text-danger" for="input-direccion">{{ $errors->first('direccion') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Coordenadas de Ubicación') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('coordenadas') ? ' has-danger' : '' }}">
                    <input onkeyup="mayus(this);" class="form-control{{ $errors->has('coordenadas') ? ' is-invalid' : '' }}" name="coordenadas" id="input-coordenadas" type="text" placeholder="{{ __('Ingrese las coordenadas de la torre') }}" value="{{ old('coordenadas') }}" required />
                      @if ($errors->has('coordenadas'))
                        <span id="coordenadas-error" class="error text-danger" for="input-coordenadas">{{ $errors->first('coordenadas') }}</span>
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
                      </select>                      @if ($errors->has('activo'))
                        <span id="activo-error" class="error text-danger" for="input-activo">{{ $errors->first('activo') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Imagen del torre') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('imagen') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('imagen') ? ' is-invalid' : '' }}" name="imagen" id="input-imagen" type="text" placeholder="{{ __('Ingrese la imagen del torre') }}" value="{{ old('imagen') }}" />
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