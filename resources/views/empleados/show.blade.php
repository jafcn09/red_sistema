@extends('layouts.app', ['activePage' => 'cliente-management', 'titlePage' => __('Cliente Management')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Ver Cliente') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-primary">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div>
                    <p><strong>Cedula: &nbsp;</strong>{{ $cliente->cedula }}</p>
                    <p><strong>Telefono: &nbsp;</strong>{{ $cliente->telefono }}</p>
                    <p><strong>Celular: &nbsp;</strong>{{ $cliente->celular }}</p>
                    <p><strong>Estado: &nbsp;</strong>{{ $cliente->estado }}</p>
                    <p><strong>Municipio: &nbsp;</strong>{{ $cliente->municipio }}</p>
                    <p><strong>Direccion: &nbsp;</strong>{{ $cliente->direccion }}</p>
                    <p><strong>Foto: &nbsp;</strong>{{ $cliente->foto }}</p>
                    <p><strong>Estatus: &nbsp;</strong>
                        @if($cliente->esta_activo == 1)
                            Cliente activo
                        @else
                            Cliente inactivo
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
@endsection
