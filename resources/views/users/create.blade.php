@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('users.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Agregar Usuario') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('users.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <h3 class="tim-note">Datos del sistema</h3>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Cédula o Pasaporte') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('cedula') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('cedula') ? ' is-invalid' : '' }}" name="cedula" id="input-cedula" type="text" placeholder="{{ __('Cédula o Pasaporte') }}" value="{{ old('cedula') }}" required="true" aria-required="true"/>
                      @if ($errors->has('cedula'))
                        <span id="cedula-error" class="error text-danger" for="input-cedula">{{ $errors->first('cedula') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-1 col-form-label">{{ __('Nombres') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('nombres') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('nombres') ? ' is-invalid' : '' }}" name="nombres" id="input-nombres" type="text" placeholder="{{ __('Ingrese los 2 nombres') }}" value="{{ old('nombres') }}" required="true" aria-required="true"/>
                      @if ($errors->has('nombres'))
                        <span id="nombres-error" class="error text-danger" for="input-nombres">{{ $errors->first('nombres') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-1 col-form-label">{{ __('Apellidos') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('apellidos') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" name="apellidos" id="input-apellidos" type="text" placeholder="{{ __('Ingrese los 2 apellidos') }}" value="{{ old('apellidos') }}" required="true" aria-required="true"/>
                      @if ($errors->has('apellidos'))
                        <span id="apellidos-error" class="error text-danger" for="input-apellidos">{{ $errors->first('apellidos') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Rol de usuario') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('rol_id') ? ' has-danger' : '' }}">

                      <select class="form-control{{ $errors->has('rol_id') ? ' is-invalid' : '' }}" name="rol_id" id="input-rol_id" placeholder="{{ __('Rol de usuario') }}" value="{{ old('rol_id') }}" required >
                        @foreach($roles as $role)
                            <option value="{{$role -> id}}">
                            {{$role -> id}} - {{$role -> name}} - {{$role -> slug}}</option>
                        @endforeach
                    </select>

                      @if ($errors->has('rol_id'))
                        <span id="rol_id-error" class="error text-danger" for="input-rol_id">{{ $errors->first('rol_id') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-3 col-form-label">{{ __('¿Cliente esta activo?') }}</label>
                  <div class="col-sm-2">
                    <div class="form-group{{ $errors->has('esta_activo') ? ' has-danger' : '' }}">
                        {{ Form::checkbox('esta_activo', 1, true) }}
                        <span id="esta_activo-error" class="error text-danger" for="input-esta_activo">{{ $errors->first('esta_activo') }}</span>
                     
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">{{ __(' Contraseña') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" input type="password" name="password" id="input-password" placeholder="{{ __('Password') }}" value="" required />
                      @if ($errors->has('password'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                  </div>

                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm Password') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm Password') }}" value="" required />
                    </div>
                  </div>
                </div>
                <hr><hr>
                <h3 class="tim-note">Datos del ubicación y contacto</h3>
                <div class="row">
                  <label class="col-sm-1 col-form-label">{{ __('Teléfono') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" id="input-telefono" type="text" placeholder="{{ __('Teléfono de contacto') }}" value="{{ old('telefono') }}" required="true" aria-required="true"/>
                      @if ($errors->has('telefono'))
                        <span id="telefono-error" class="error text-danger" for="input-telefono">{{ $errors->first('telefono') }}</span>
                      @endif
                    </div>
                  </div>

                  <label class="col-sm-1 col-form-label">{{ __('Celular') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('celular') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" name="celular" id="input-celular" type="text" placeholder="{{ __('Celular de contacto') }}" value="{{ old('celular') }}" required="true" aria-required="true"/>
                      @if ($errors->has('celular'))
                        <span id="celular-error" class="error text-danger" for="input-celular">{{ $errors->first('celular') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Calle principal') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('calle_p') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('calle_p') ? ' is-invalid' : '' }}" name="calle_p" id="input-calle_p" type="text" placeholder="{{ __('Ingrese su calle principal') }}" value="{{ old('calle_p') }}" required />
                      @if ($errors->has('calle_p'))
                        <span id="calle_p-error" class="error text-danger" for="input-calle_p">{{ $errors->first('calle_p') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Calle secundaria') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('calle_s') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('calle_s') ? ' is-invalid' : '' }}" name="calle_s" id="input-calle_s" type="text" placeholder="{{ __('Ingrese su calle secundaria') }}" value="{{ old('calle_s') }}" required="true" aria-required="true"/>
                      @if ($errors->has('calle_s'))
                        <span id="calle_s-error" class="error text-danger" for="input-calle_s">{{ $errors->first('calle_s') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Dirección de domicilio') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('direccion') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" id="input-direccion" type="text" placeholder="{{ __('Ingrese su direccion con punto de referencia') }}" value="{{ old('direccion') }}" required />
                      @if ($errors->has('direccion'))
                        <span id="direccion-error" class="error text-danger" for="input-direccion">{{ $errors->first('direccion') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-1 col-form-label">{{ __('Foto') }}</label>
                  <div class="col-sm-4">
                 
                      <input type="file" name="foto" class="form-control" value="{{ old('foto') }}">
                          @if ($errors->has('foto'))
                            <span id="foto-error" class="error text-danger" for="input-foto">{{ $errors->first('foto') }}</span>
                          @endif
    
                  </div>
                  <label class="col-sm-1 col-form-label">{{ __('Cédula foto') }}</label>
                  <div class="col-sm-4">
                      <input type="file" name="foto_cedula" class="form-control"  value="{{ old('foto_cedula') }}">
                          @if ($errors->has('foto_cedula'))
                            <span id="foto_cedula-error" class="error text-danger" for="input-foto_cedula">{{ $errors->first('foto_cedula') }}</span>
                          @endif
                  </div>
                  
                </div>
                <hr><hr>
                <h3 class="tim-note">Datos de cliente</h3>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('¿Cliente es VIP?') }}</label>
                  <div class="col-sm-2">
                    <div class="form-group{{ $errors->has('es_vip') ? ' has-danger' : '' }}">
                    <label class="form-check-label">
                    <select class="selectpicker" name="es_vip" data-style="select-with-transition" data-size="1">
                          <option value="0">NO</option>
                          <option value="1">SI</option>                   
                      </select> 
                        <span id="es_vip-error" class="error text-danger" for="input-es_vip">{{ $errors->first('es_vip') }}</span>
                      
                    </div>
                  </div>
                </div>
                <hr><hr>
                <h3 class="tim-note">Datos de empleado</h3>
                <div class="row">
                  <label class="col-sm-1 col-form-label">{{ __('Salario') }}</label>
                  <div class="col-sm-2">
                  <div class="form-group{{ $errors->has('salario') ? ' has-danger' : '' }}">
                      <input class="input-salario form-control{{ $errors->has('salario') ? ' is-invalid' : '' }}" value="0" name="salario" id="input-salario" type="decimal" required />
                      @if ($errors->has('salario'))
                        <span id="salario-error" class="error text-danger" for="input-salario">{{ $errors->first('salario') }}</span>
                      @endif
                  </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Descuento') }}</label>
                  <div class="col-sm-2">
                  <div class="form-group{{ $errors->has('descuento') ? ' has-danger' : '' }}">
                      <input class="input-salario form-control{{ $errors->has('descuento') ? ' is-invalid' : '' }}" value="0" name="descuento" id="input-descuento" type="decimal"  required />
                      @if ($errors->has('descuento'))
                        <span id="descuento-error" class="error text-danger" for="input-descuento">{{ $errors->first('descuento') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-1 col-form-label">{{ __('Total') }}</label>
                  <div class="col-sm-2">
                  <div class="form-group{{ $errors->has('total_salario') ? ' has-danger' : '' }}">
                      <input class="totalbox form-control{{ $errors->has('total_salario') ? ' is-invalid' : '' }}" name="total_salario" id="total_salario" type="text"  value="0.00" readonly />
                      @if ($errors->has('total_salario'))
                        <span id="total_salario-error" class="error text-danger" for="input-total_salario">{{ $errors->first('total_salario') }}</span>
                      @endif
                    </div>
                    
                    </div>
                  </div>

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

    $(function () {
    $('.input-salario').change(function () {
        var total = 0;
        $('.input-salario').each(function () {
          if(total >= parseFloat($(this).val())){
            total -= parseFloat($(this).val());
          }else{
            total = parseFloat($(this).val()) - total;
          }
        });
        $('#total_salario').val(total);
    });
});
</script>
<script>
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>
@endpush
@endsection