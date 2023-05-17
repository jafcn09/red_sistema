@extends('layouts.app', ['activePage' => 'categoria-management', 'titlePage' => __('Categoria Management')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Ver Categoria') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('productos.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3 text-right">
                    <p><strong>Categoria: &nbsp;</strong>
                    {{ $producto->categoria['nombre'] }}
                    </p>
                    <p><strong>Codigo producto: &nbsp;</strong>{{ $producto->codigo }}</p>
                    <p><strong>Nombre de producto: &nbsp;</strong>{{ $producto->nombre }}</p>
                    <p><strong>Descripción: &nbsp;</strong>{{ $producto->descripcion }}</p>
                    <p><strong>Cantidad: &nbsp;</strong>{{ $producto->cantidad }}</p>
                    <p><strong>Precio: &nbsp;</strong>{{ $producto->precio }}</p>
                    <p>Condición: </p>
                    <strong> 
                        @if($producto->condicion == 1)
                          <p class="material-icons text-success">check_circle 
                            ACTIVO
                           </p>
                        @elseif($producto->condicion == 0)
                        <p class="material-icons text-danger">not_interested 
                            INACTIVO
                           </p>
                        @endif                
                    </strong> 
                  </div>
                  <div class="col-sm-6">
                    <p><strong>Foto: &nbsp;</strong>
                    @if (!empty($producto->imagen))
                        <img src="{{ asset('uploads/productos/' . $producto->imagen) }}" 
                        alt="{{ $producto->nombre }}" width="200px" height="200px">
                    @else
                        <img src="uploads/productos/img-50x50.png" alt="{{ $producto->nombre }}">
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
