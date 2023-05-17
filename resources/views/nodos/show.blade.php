@extends('layouts.app', ['activePage' => 'nodo-management', 'titlePage' => __('Nodo Management')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Ver Nodo') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('nodos.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div>
                    <p><strong>Nombre: &nbsp;</strong>{{ $nodo->nombre }}</p>
                    <p><strong>Descripción: &nbsp;</strong>{{ $nodo->descripcion }}</p>
                    <p><strong>Nombre de Torre: &nbsp;</strong>{{ $nodo->torre->nombre_torre }}</p>
                    <p><strong>Marca Equipo: &nbsp;</strong>{{ $nodo->producto->marca }}</p>
                    <p><strong>Modelo Equipo: &nbsp;</strong>{{ $nodo->producto->modelo }}</p>
                    <p><strong>IP: &nbsp;</strong>{{ $nodo->ip }}</p>
                    <p><strong>MAC: &nbsp;</strong>{{ $nodo->mac }}</p>
                    <p><strong>Activo: &nbsp;</strong>{{ $nodo->activo }}</p>
                    <p><strong>Imagen: &nbsp;</strong>{{ $nodo->imagen }}</p>
              </div>
              </div>
            </div>
         </div>
        </div>
      </div>
    </div>
  </div>
@endsection
