@extends('layouts.app', ['activePage' => 'plane-management', 'titlePage' => __('Plane Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Planes de Internet') }}</h4>
                <p class="card-category"> {{ __('Aqui puedes administrar los planes') }}</p>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('planes.create') }}" class="btn btn-sm btn-warning">{{ __('Agregar plan') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="card-header-warning">
                      <th>
                          {{ __('Nombre') }}
                      </th>
                      <th style="width:350px">
                        {{ __('Descripción') }}
                      </th>
                      <th>
                        {{ __('Capacidad') }}
                      </th>
                      <th>
                        {{ __('Precio') }}
                      </th>
                      <th>
                        {{ __('Imagen') }}
                      </th>
                      <th class="text-right">
                        {{ __('Actions') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($planes as $plane)
                        <tr>
                          <td>
                            {{ $plane->nombre }}
                          </td>
                          <td>
                            {{ $plane->descripcion }}
                          </td>
                          <td>                          
                            {{ $plane->capacidad }} Megas
                          </td>
                          <td>                          
                            {{ $plane->precio }} $
                          </td>
                          <td>
                          @if (!empty($plane->imagen))
                                <img class="rounded float-left" src="{{ asset('uploads/planes/' . $plane->imagen) }}" 
                                alt="{{ $plane->nombre }}" width="50px" height="50px">
                            @else
                                <img class="rounded float-left" src="{{ asset('uploads/planes/img-50x50.png') }}" alt="{{ $plane->nombre }}">
                            @endif

                          </td>
                          <td class="td-actions text-right">                       
                          
                              <form action="{{ route('planes.destroy', $plane) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('planes.show', $plane) }}" data-original-title="" title="">
                                    <i class="material-icons">face</i>
                                    <div class="ripple-container"></div>                               
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('planes.edit', $plane) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estas seguro de eliminar este plan?") }}') ? this.parentElement.submit() : ''">
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button>
                              </form>
                              
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection