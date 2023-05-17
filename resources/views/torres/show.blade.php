@extends('layouts.app', ['activePage' => 'torre-management', 'titlePage' => __('Torre Management')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Ver Torre') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('torres.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div>
                    <p><strong>Nombre de la Torre: &nbsp;</strong>{{ $torre->nombre_torre }}</p>
                    <p><strong>Descripción de la Torre: &nbsp;</strong>{{ $torre->descripcion_torre }}</p>
                    <p><strong>Calle principal: &nbsp;</strong>{{ $torre->calle_p }}</p>
                    <p><strong>Calle secundaria: &nbsp;</strong>{{ $torre->calle_s }}</p>
                    <p><strong>Dirección: &nbsp;</strong>{{ $torre->direccion }}</p>
                    <p><strong>Coordenadas: &nbsp;</strong>{{ $torre->coordenadas }}</p>
                    <p><strong>Activo: &nbsp;</strong>{{ $torre->activo }}</p>
                    <p><strong>Imagen: &nbsp;</strong>{{ $torre->imagen }}</p>
              </div>
              </div>
            </div>
  
      </div>
    </div>
  </div>
@endsection
