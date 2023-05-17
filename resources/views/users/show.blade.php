@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
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
                        {{$user->cedula}}
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-1 col-form-label">{{ __('Nombres') }}</label>
                  <div class="col-sm-4">
                        {{$user->nombres}}
                  </div>
                  <label class="col-sm-1 col-form-label">{{ __('Apellidos') }}</label>
                  <div class="col-sm-4">
                        {{$user->apellidos}}
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Rol de usuario') }}</label>
                  <div class="col-sm-3">
                  @foreach($role_user as $rl) 
                    @foreach($roles as $role)
                        @if($rl->user_id == $user->id && $rl->role_id == $role->id)
                            {{$role->name}}
                        @endif
                    @endforeach
                  @endforeach

                  </div>
                  <label class="col-sm-3 col-form-label">{{ __('¿Cliente esta activo?') }}</label>
                  <div class="col-sm-2">
                  @if($user->esta_activo == 1)
                        SI
                  @else
                        NO
                  @endif
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-8">
                        {{$user->email}}
                  </div>
                </div>

                <hr><hr>
                <h3 class="tim-note">Datos del ubicación y contacto</h3>
                <div class="row">
                  <label class="col-sm-1 col-form-label">{{ __('Teléfono') }}</label>
                  <div class="col-sm-4">
                        {{$user->telefono}}
                  </div>

                  <label class="col-sm-1 col-form-label">{{ __('Celular') }}</label>
                  <div class="col-sm-4">
                        {{$user->celular}}
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Calle principal') }}</label>
                  <div class="col-sm-3">
                        {{$user->calle_p}}
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Calle secundaria') }}</label>
                  <div class="col-sm-3">
                        {{$user->calle_s}}
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Dirección de domicilio') }}</label>
                  <div class="col-sm-8">
                        {{$user->direccion}}
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Fotografia') }}</label>
                  <div class="col-sm-2">
                    @if (!empty($user->foto))
                        <img src="{{ asset('uploads/usuarios/' . $user->foto) }}" 
                        alt="{{ $user->nombres }}" width="200px" height="200px">
                    @else
                        <img src="{{ asset('uploads/usuarios/img-50x50.png') }}" alt="{{ $user->nombres }}">
                    @endif
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Cédula escaneada') }}</label>
                  <div class="col-sm-3">
                    @if (!empty($user->foto_cedula))
                        <img src="{{ asset('uploads/usuarios/' . $user->foto_cedula) }}" 
                        alt="{{ $user->nombres }}" width="200px" height="200px">
                    @else
                        <img src="{{ asset('uploads/usuarios/img-50x50.png') }}" alt="{{ $user->nombres }}">
                    @endif
                  </div>
                </div>
                <hr><hr>
                <h3 class="tim-note">Datos de cliente</h3>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('¿Cliente es VIP?') }}</label>
                  <div class="col-sm-2">
                  @if($user->es_vip == 1)
                        SI
                  @else
                        NO
                  @endif
                  </div>
                </div>
                <hr><hr>
                <h3 class="tim-note">Datos de empleado</h3>
                <div class="row">
                  <label class="col-sm-1 col-form-label">{{ __('Salario') }}</label>
                  <div class="col-sm-2">
                        {{$user->salario}}
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Descuento') }}</label>
                  <div class="col-sm-2">
                        {{$user->descuento}}
                  </div>
                  <label class="col-sm-1 col-form-label">{{ __('Total') }}</label>
                  <div class="col-sm-2">
                        {{$user->total_salario}}
                  </div>
                </div>


              </div>
            </div>
         
        </div>
      </div>
    </div>
  </div>
@endsection