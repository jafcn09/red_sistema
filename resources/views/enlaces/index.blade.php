@extends('layouts.app', ['activePage' => 'enlace-management', 'titlePage' => __('Enlace Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card" style="bg-color:black">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Enlaces') }}</h4>
                <p class="card-category"> {{ __('Aqui puedes administrar los enlaces') }}</p>
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
                    <a href="{{ route('enlaces.create') }}" class="btn btn-warning">{{ __('Agregar Enlace') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table id="table_id" class="results table table-striped table-bordered dt-responsive">
                    <thead class="card-header-warning">
                      <th>
                          {{ __('Cliente') }}
                      </th>
                      <th>
                        {{ __('Router Asociado') }}
                      </th>
                      <th>
                        {{ __('Nodo') }}
                      </th>
                      <th>
                        {{ __('Marca') }}
                      </th>
                      <th>
                        {{ __('IP') }}
                      </th>
                      <th>
                        {{ __('MAC') }}
                      </th>
                      <th>
                        {{ __('¿Esta activo?') }}
                      </th>
                      <th class="text-right">
                        {{ __('Acciones') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($enlaces as $enlace)
                        <tr>
                          <td> 
                          @foreach($usuarios as $usuario)
                            @if($enlace->user_id == $usuario->id )                       
                              {{ $usuario->nombres  }} {{ $usuario->apellidos  }}
                            @endif
                          @endforeach
                          </td>
                          <td>
                          @foreach($equipos as $router)
                            @if($enlace->router_id == $router->id )                       
                              {{ $router->marca }} {{ $router->modelo }}
                            @endif
                          @endforeach
                          </td>
                          <td>   
                          @foreach($nodos as $nodo)
                            @if($enlace->nodo_id == $nodo->id )                       
                              {{ $nodo->nombre }}
                            @endif
                          @endforeach                       
                          </td>
                          <td>                          
                          @foreach($equipos as $equipo)
                            @if($enlace->producto_id == $equipo->id )                       
                              {{ $equipo->marca }}
                            @endif
                          @endforeach
                          </td>
                          <td>                          
                          {{ $enlace->ip  }}
                          </td>
                          <td>
                          {{ $enlace->mac  }} 
                          </td>
                          <td>
                          @if($enlace->activo == "SI")
                            <a rel="tooltip" class="btn btn-info btn-link" href="{{ route('enlaces.activa_desactiva', $enlace) }}" data-original-title="" title="">
                              <input value="{{ $enlace->activo  }}" name="activa_desactiva" id="activa_desactiva" type="text" hidden>
                              {{ $enlace->activo  }} 
                            </a>
                          @else
                            <a rel="tooltip" class="btn btn-danger btn-link" href="{{ route('enlaces.activa_desactiva', $enlace) }}" data-original-title="" title="">
                              <input value="{{ $enlace->activo  }}" name="activa_desactiva" id="activa_desactiva" type="text" hidden>
                              {{ $enlace->activo  }} 
                            </a>
                          @endif
                          </td>
                          <td class="td-actions text-right">                       
                          
                              <form action="{{ route('enlaces.destroy', $enlace) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('enlaces.show', $enlace) }}" data-original-title="" title="">
                                    <i class="material-icons">face</i>
                                    <div class="ripple-container"></div>                               
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('enlaces.edit', $enlace) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estas seguro de querer eliminar este enlace?") }}') ? this.parentElement.submit() : ''">
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