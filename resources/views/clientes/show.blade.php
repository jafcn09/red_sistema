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
                <h4 class="card-title">{{ __('Ver Cliente') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <h3 class="tim-note">Datos del sistema</h3>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Cédula o Pasaporte') }}</label>
                  <div class="col-sm-8">
                        {{$cliente->cedula}}
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-1 col-form-label">{{ __('Nombres') }}</label>
                  <div class="col-sm-4">
                        {{$cliente->nombres}}
                  </div>
                  <label class="col-sm-1 col-form-label">{{ __('Apellidos') }}</label>
                  <div class="col-sm-4">
                        {{$cliente->apellidos}}
                  </div>
                </div>
                @if(auth()->user()->isRole('ADMIN') || auth()->user()->isRole('EMPLEADO'))
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Rol de usuario') }}</label>
                  <div class="col-sm-3">
                  @foreach($role_user as $rl) 
                    @foreach($roles as $role)
                        @if($rl->user_id == $cliente->id && $rl->role_id == $role->id)
                            {{$role->name}}
                        @endif
                    @endforeach
                  @endforeach

                  </div>
                  <label class="col-sm-3 col-form-label">{{ __('¿Cliente esta activo?') }}</label>
                  <div class="col-sm-2">
                  @if($cliente->esta_activo == 1)
                        SI
                  @else
                        NO
                  @endif
                  </div>
                </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-8">
                        {{$cliente->email}}
                  </div>
                </div>

                <hr><hr>
                <h3 class="tim-note">Datos del ubicación y contacto</h3>
                <div class="row">
                  <label class="col-sm-1 col-form-label">{{ __('Teléfono') }}</label>
                  <div class="col-sm-4">
                        {{$cliente->telefono}}
                  </div>

                  <label class="col-sm-1 col-form-label">{{ __('Celular') }}</label>
                  <div class="col-sm-4">
                        {{$cliente->celular}}
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Calle principal') }}</label>
                  <div class="col-sm-3">
                        {{$cliente->calle_p}}
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Calle secundaria') }}</label>
                  <div class="col-sm-3">
                        {{$cliente->calle_s}}
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Dirección de domicilio') }}</label>
                  <div class="col-sm-8">
                        {{$cliente->direccion}}
                  </div>
                </div>
                @if(auth()->user()->isRole('ADMIN') || auth()->user()->isRole('EMPLEADO'))
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Fotografia') }}</label>
                  <div class="col-sm-2">
                    @if (!empty($cliente->foto))
                        <img src="{{ asset('uploads/usuarios/' . $cliente->foto) }}" 
                        alt="{{ $cliente->nombres }}" width="200px" height="200px">
                    @else
                        <img src="{{ asset('uploads/usuarios/img-50x50.png') }}" alt="{{ $cliente->nombres }}">
                    @endif
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Cédula escaneada') }}</label>
                  <div class="col-sm-3">
                    @if (!empty($cliente->foto_cedula))
                        <img src="{{ asset('uploads/usuarios/' . $cliente->foto_cedula) }}" 
                        alt="{{ $cliente->nombres }}" width="200px" height="200px">
                    @else
                        <img src="{{ asset('uploads/usuarios/img-50x50.png') }}" alt="{{ $cliente->nombres }}">
                    @endif
                  </div>
                </div>
                @endif
                <hr><hr>
                @if(auth()->user()->isRole('ADMIN') || auth()->user()->isRole('EMPLEADO'))
                <h3 class="tim-note">Datos de cliente</h3>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('¿Cliente es VIP?') }}</label>
                  <div class="col-sm-2">
                  @if($cliente->es_vip == 1)
                        SI
                  @else
                        NO
                  @endif
                  </div>
                </div>
                
                <hr><hr>
                @endif

              </div>
            </div>
         
        </div>
      </div>
    </div>
  </div>
@endsection