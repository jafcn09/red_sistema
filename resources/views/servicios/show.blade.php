@extends('layouts.app', ['activePage' => 'servicio-management', 'titlePage' => __('Servicio Management')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Ver Servicio') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('servicios.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3 text-right">
                    <p><strong>Servicio: &nbsp;</strong>
                    {{ $servicio->categoria['nombre'] }}
                    </p>
                    <p><strong>Codigo servicio: &nbsp;</strong>{{ $servicio->codigo }}</p>
                    <p><strong>Nombre de servicio: &nbsp;</strong>{{ $servicio->nombre }}</p>
                    <p><strong>Descripción: &nbsp;</strong>{{ $servicio->descripcion }}</p>
                    <p><strong>Cantidad: &nbsp;</strong>{{ $servicio->cantidad }}</p>
                    <p><strong>Precio: &nbsp;</strong>{{ $servicio->precio }}</p>
                    <p>Condición: </p>
                    <strong> 
                        @if($servicio->condicion == 1)
                          <p class="material-icons text-success">check_circle 
                            ACTIVO
                           </p>
                        @elseif($servicio->condicion == 0)
                        <p class="material-icons text-danger">not_interested 
                            INACTIVO
                           </p>
                        @endif                
                    </strong> 
                  </div>
                  <div class="col-sm-6">
                    <p><strong>Foto: &nbsp;</strong>
                    @if (!empty($servicio->imagen))
                        <img src="{{ asset('uploads/servicios/' . $servicio->imagen) }}" 
                        alt="{{ $servicio->nombre }}" width="200px" height="200px">
                    @else
                        <img src="uploads/servicios/img-50x50.png" alt="{{ $servicio->nombre }}">
                    @endif
                    </p>
                  </div>
              </div>
        
              </div>
            </div>
         </div>
        </div>
      </div>
    </div>
  </div>
@endsection
