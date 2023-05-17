@extends('layouts.app', ['activePage' => 'empleado-management', 'titlePage' => __('Empleado Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('empleados.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add empleado') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('empleados.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">            
                    <label for="nombre">Usuario relacionado:</label>
                    <select name="user_id" id="user_id" class="form-control form-control-xs selectpicker" data-live-search="true">
                        @foreach($users as $user)
                            <option value="{{$user -> id}}">
                            {{$user -> id}} - {{$user -> name}} - {{$user -> email}} ------------------>
                             Empleados - {{$user -> slug}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nombres') }}</label>
                  <div class="col-sm-2">
                    <div class="form-group{{ $errors->has('nombres') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('nombres') ? ' is-invalid' : '' }}" name="nombres" id="input-nombres" type="text" placeholder="{{ __('Ingrese su nombres') }}" value="{{ old('nombres') }}" required />
                      @if ($errors->has('nombres'))
                        <span id="nombres-error" class="error text-danger" for="input-nombres">{{ $errors->first('nombres') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Apellidos') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('apellidos') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" name="apellidos" id="input-apellidos" type="text" placeholder="{{ __('Ingrese su apellidos') }}" value="{{ old('apellidos') }}" required="true" aria-required="true"/>
                      @if ($errors->has('apellidos'))
                        <span id="apellidos-error" class="error text-danger" for="input-apellidos">{{ $errors->first('apellidos') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                  <hr>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Cedula de ciuadanía') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('cedula') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('cedula') ? ' is-invalid' : '' }}" name="cedula" id="input-cedula" type="text" placeholder="{{ __('Ingrese su cedula') }}" value="{{ old('cedula') }}" required="true" aria-required="true"/>
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
                      <input class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" id="input-telefono" type="text" placeholder="{{ __('Ingrese su telefono') }}" value="{{ old('telefono') }}" required />
                      @if ($errors->has('telefono'))
                        <span id="telefono-error" class="error text-danger" for="input-telefono">{{ $errors->first('telefono') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Celular') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('celular') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" name="celular" id="input-celular" type="text" placeholder="{{ __('Ingrese su celular') }}" value="{{ old('celular') }}" required="true" aria-required="true"/>
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
                      <input class="form-control{{ $errors->has('calle_p') ? ' is-invalid' : '' }}" name="calle_p" id="input-calle_p" type="text" placeholder="{{ __('Ingrese su calle principal') }}" value="{{ old('calle_p') }}" required />
                      @if ($errors->has('calle_p'))
                        <span id="calle_p-error" class="error text-danger" for="input-calle_p">{{ $errors->first('calle_p') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Calle secundaria') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('calle_s') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('calle_s') ? ' is-invalid' : '' }}" name="calle_s" id="input-calle_s" type="text" placeholder="{{ __('Ingrese su calle secundaria') }}" value="{{ old('calle_s') }}" required="true" aria-required="true"/>
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
                      <input class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" id="input-direccion" type="text" placeholder="{{ __('Ingrese su direccion') }}" value="{{ old('direccion') }}" required />
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
                      <input class="form-control{{ $errors->has('foto') ? ' is-invalid' : '' }}" name="foto" id="input-foto" type="text" placeholder="{{ __('Ingrese su foto') }}" value="{{ old('foto') }}" required />
                      @if ($errors->has('foto'))
                        <span id="foto-error" class="error text-danger" for="input-foto">{{ $errors->first('foto') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Cedula escaneada') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('foto_cedula') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('foto_cedula') ? ' is-invalid' : '' }}" name="foto_cedula" id="input-foto_cedula" type="text" placeholder="{{ __('Ingrese el archivo de su cedula') }}" value="{{ old('foto_cedula') }}" required="false" aria-required="true"/>
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
                      
                        
                    {{ Form::checkbox('es_vip', 0, false) }}
                        
                          
                        
                        <span id="es_vip-error" class="error text-danger" for="input-es_vip">{{ $errors->first('es_vip') }}</span>
                      
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('¿Cliente esta activo?') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('esta_activo') ? ' has-danger' : '' }}">
                    
                      
                    
                        {{ Form::checkbox('esta_activo', 1, true) }}
                    
                        <span id="esta_activo-error" class="error text-danger" for="input-esta_activo">{{ $errors->first('esta_activo') }}</span>
                     
                    </div>
                  </div>

              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Add empleado') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@push('js')
  <script src="{{ asset('js/buscador-bootstrap.js') }}"></script>
@endpush
@endsection