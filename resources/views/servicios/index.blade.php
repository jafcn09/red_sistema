@extends('layouts.app', ['activePage' => 'servicio_management', 'titlePage' => __('Servicio Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Servicios') }}</h4>
                <p class="card-category"> {{ __('Aqui podemos administrar servicios') }}</p>
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
                    <a href="{{ route('servicios.create') }}" class="btn btn-sm btn-warning">{{ __('Agregar servicio') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="card-header-warning">
                    <th>
                        {{ __('Tipo Servicio ') }}
                      </th>
                      <th scope="col">
                        {{ __('Codigo servicio') }}
                      </th>
                      <th>
                        {{ __('Nombre servicio ') }}
                      </th>

                      <th>
                        {{ __('Precio ') }}
                      </th>
                      <th>
                        {{ __('Estatus') }}
                      </th>
                      <th>
                        {{ __('Imagen') }}
                      </th>

                      <th class="text-right">
                        {{ __('Acción') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($servicios as $servicio)
                        <tr>
                        <td>                        
                            {{ $servicio->categoria['nombre'] }}
                          </td>

                          <td>
                            <div style="width: auto;">
                              {!! $code->getBarcodeHTML($servicio->codigo, "EAN13") !!}
                            </div>
                          </td>
                          <td>                          
                            {{ $servicio->nombre }}
                          </td>

                          <td>                          
                            {{ $servicio->precio }}
                          </td>
                          <td>  
                          @if ($servicio->condicion == 1)
                            <p class="material-icons text-success">check_circle
                          @else
                            <p class="material-icons text-danger">not_interested
                          @endif
                            </p>
                          
                          </td>
                          <td>
                            @if (!empty($servicio->imagen))
                                <img class="rounded float-left" src="{{ asset('uploads/servicios/' . $servicio->imagen) }}" 
                                alt="{{ $servicio->nombre }}" width="50px" height="50px">
                            @else
                                <img class="rounded float-left" src="{{ asset('uploads/servicios/img-50x50.png') }}" alt="{{ $servicio->nombre }}">
                            @endif

                          </td>

                          <td class="td-actions text-right">                       
                          
                              <form action="{{ route('servicios.destroy', $servicio) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('servicios.show', $servicio) }}" data-original-title="" title="">
                                    <i class="material-icons">face</i>
                                    <div class="ripple-container"></div>                               
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('servicios.edit', $servicio) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estas seguro de eliminar el servicio ?") }}') ? this.parentElement.submit() : ''">
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