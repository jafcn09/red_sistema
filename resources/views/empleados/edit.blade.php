@extends('layouts.app', ['activePage' => 'cliente-management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('clientes.update', $cliente) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Edit Cliente') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-warning">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Cedula de ciuadanía') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('cedula') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('cedula') ? ' is-invalid' : '' }}" name="cedula" id="input-cedula" type="text" placeholder="{{ __('Ingrese su cedula') }}" value="{{ old('cedula', $cliente->cedula) }}" required="true" aria-required="true"/>
                      @if ($errors->has('cedula'))
                        <span id="cedula-error" class="error text-danger" for="input-cedula">{{ $errors->first('cedula') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Teléfono') }}</label>
                  <div class="col-sm-2">
                    <div class="form-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" id="input-telefono" type="text" placeholder="{{ __('Ingrese su telefono') }}" value="{{ old('email', $cliente->telefono) }}" required />
                      @if ($errors->has('telefono'))
                        <span id="telefono-error" class="error text-danger" for="input-telefono">{{ $errors->first('telefono') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Celular') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('celular') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" name="celular" id="input-celular" type="text" placeholder="{{ __('Ingrese su celular') }}" value="{{ old('celular', $cliente->celular) }}" required="true" aria-required="true"/>
                      @if ($errors->has('celular'))
                        <span id="celular-error" class="error text-danger" for="input-celular">{{ $errors->first('celular') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                  <hr>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Calle principal') }}</label>
                  <div class="col-sm-2">
                    <div class="form-group{{ $errors->has('calle_p') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('calle_p') ? ' is-invalid' : '' }}" name="calle_p" id="input-calle_p" type="text" placeholder="{{ __('Ingrese su calle principal') }}" value="{{ old('calle_p', $cliente->calle_p) }}" required />
                      @if ($errors->has('calle_p'))
                        <span id="calle_p-error" class="error text-danger" for="input-calle_p">{{ $errors->first('calle_p') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Calle secundaria') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('calle_s') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('calle_s') ? ' is-invalid' : '' }}" name="calle_s" id="input-calle_s" type="text" placeholder="{{ __('Ingrese su calle secundaria') }}" value="{{ old('calle_s', $cliente->calle_s) }}" required="true" aria-required="true"/>
                      @if ($errors->has('calle_s'))
                        <span id="calle_s-error" class="error text-danger" for="input-calle_s">{{ $errors->first('calle_s') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Dirección de domicilio') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('direccion') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" id="input-direccion" type="text" placeholder="{{ __('Ingrese su direccion') }}" value="{{ old('direccion', $cliente->direccion) }}" required />
                      @if ($errors->has('direccion'))
                        <span id="direccion-error" class="error text-danger" for="input-direccion">{{ $errors->first('direccion') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Fotografia') }}</label>
                  <div class="col-sm-2">
                    <div class="form-group{{ $errors->has('foto') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('foto') ? ' is-invalid' : '' }}" name="foto" id="input-foto" type="text" placeholder="{{ __('Ingrese su foto') }}" value="{{ old('foto', $cliente->foto) }}" required />
                      @if ($errors->has('foto'))
                        <span id="foto-error" class="error text-danger" for="input-foto">{{ $errors->first('foto') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Cedula escaneada') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('foto_cedula') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('foto_cedula') ? ' is-invalid' : '' }}" name="foto_cedula" id="input-foto_cedula" type="text" placeholder="{{ __('Ingrese el archivo de su cedula') }}" value="{{ old('foto_cedula', $cliente->foto_cedula) }}" required="false" aria-required="true"/>
                      @if ($errors->has('foto_cedula'))
                        <span id="foto_cedula-error" class="error text-danger" for="input-foto_cedula">{{ $errors->first('foto_cedula') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('¿Cliente es VIP?') }}</label>
                  <div class="col-sm-2">
                    <div class="form-group{{ $errors->has('es_vip') ? ' has-danger' : '' }}">
                      
                      @if($cliente->es_vip == true || $cliente->es_vip == false)
                          {{ Form::checkbox('es_vip', 1, old('es_vip',  $cliente->es_vip == 1 ? true:false )) }}
                      @else
                        <span id="es_vip-error" class="error text-danger" for="input-es_vip">{{ $errors->first('es_vip') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('¿Cliente esta activo?') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('esta_activo') ? ' has-danger' : '' }}">
                    @if($cliente->esta_activo == true || $cliente->esta_activo == false)
                          {{ Form::checkbox('esta_activo', 1, old('esta_activo',  $cliente->esta_activo == 1 ? true:false )) }}
                      @else
                        <span id="esta_activo-error" class="error text-danger" for="input-esta_activo">{{ $errors->first('esta_activo') }}</span>
                    @endif
                    </div>
                  </div>
                </div>

              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-warning">{{ __('Save') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection