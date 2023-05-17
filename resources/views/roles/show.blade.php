@extends('layouts.app', ['activePage' => 'role-management', 'titlePage' => __('Role Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Mostrar Rol') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('roles.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div>
                    <p><strong>Nombre: &nbsp;</strong>{{ $role->name }}</p>
                    <p><strong>Slug: &nbsp;</strong>{{ $role->slug }}</p>
                    <p><strong>Descripcion: &nbsp;</strong>{{ $role->description }}</p>
                    <p><strong>Especial: &nbsp;</strong>{{ $role->special }}</p>
                    <p><strong>Fecha creacion: &nbsp;</strong>{{ $role->created_at->format('d-m-Y') }}</p>
                    <p><strong>Fecha modificacion: &nbsp;</strong>{{ $role->updated_at->format('d-m-Y') }}</p>
              </div>
              </div>
            </div>
         </div>
        </div>
      </div>
    </div>
  </div>
@endsection
