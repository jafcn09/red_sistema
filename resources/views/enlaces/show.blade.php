@extends('layouts.app', ['activePage' => 'enlace-management', 'titlePage' => __('Enlace Management')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Ver Enlace') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('enlaces.index') }}" class="btn btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div>
                    <p><strong>Nombre Cliente: &nbsp;</strong>{{ $enlace->user->nombres }} {{ $enlace->user->apellidos }}</p>
                    <p><strong>Antena Asociada Marca: &nbsp;</strong>{{ $enlace->producto->marca }} <strong>Modelo:</strong> {{ $enlace->producto->modelo }} <strong>MAC:</strong> {{ $enlace->producto->codigo }}</p>
                    <p><strong>Nombre de la Torre: &nbsp;</strong>{{ $enlace->nodo->torre->nombre_torre }} </p>
                    <p><strong>Nombre de Nodo: &nbsp;</strong>{{ $enlace->nodo->nombre }}</p>
                    <p><strong>IP del ENLACE/CPE: &nbsp;</strong>{{ $enlace->ip }}</p>
                    <p><strong>MAC del ENLACE/CPE: &nbsp;</strong>{{ $enlace->mac }}</p>
                    <p><strong>Coordenadas del ENLACE/CPE: &nbsp;</strong>{{ $enlace->coordenadas }}</p>
                    <p><strong>ENLACE/CPE esta ACTIVO: &nbsp;</strong>{{ $enlace->activo }}</p>
                    <p><strong>Imagen del ENLACE/CPE: &nbsp;</strong>{{ $enlace->imagen }}</p>
                    <hr>
                    <p>Datos de Router asociado</p>
                    @foreach($productos as $producto)
                      @if($enlace->router_id == $producto->id)
                        <p><strong>Marca: &nbsp;</strong>{{ $producto->marca }} <strong>Modelo:</strong> {{ $producto->modelo }} <strong>MAC:</strong> {{ $producto->codigo }}</p>
                      @endif
                    @endforeach
              </div>
              </div>
            </div>
         </div>
    
    </div>
  </div>
@endsection
