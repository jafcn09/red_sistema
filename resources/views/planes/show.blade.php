@extends('layouts.app', ['activePage' => 'plane-management', 'titlePage' => __('Plan Management')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Ver Plan') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('planes.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div>
                    <p><strong>Nombre: &nbsp;</strong>{{ $plane->nombre }}</p>
                    <p><strong>Descripción: &nbsp;</strong>{{ $plane->descripcion }}</p>
                    <p><strong>Capacidad: &nbsp;</strong>{{ $plane->capacidad }} Megas</p>
                    <p><strong>Precio: &nbsp;</strong>{{ $plane->precio }} $$</p>
                    <p><strong>Imagen: &nbsp;
                    @if (!empty($plane->imagen))
                        <img src="{{ asset('uploads/planes/' . $plane->imagen) }}" 
                        alt="{{ $plane->nombre }}" width="200px" height="200px">
                    @else
                        <img src="{{ asset('uploads/planes/img-50x50.png') }}" alt="{{ $plane->nombre }}">
                    @endif</p>
              </div>
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
