@extends('layouts.app', ['activePage' => 'tarea-management', 'titlePage' => __('Tarea Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card" style="bg-color:black">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Tareas') }}</h4>
                <p class="card-category"> {{ __('Aqui puedes administrar las tareas') }}</p>
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
                    <a href="{{ route('tareas.create') }}" class="btn btn-warning">{{ __('Agregar Tarea') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table id="table_id" class="results table table-striped table-bordered dt-responsive">
                    <thead class="card-header-warning">
                      <th>
                        {{ __('Tipo de Tarea') }}
                      </th>
                      <th>
                        {{ __('Nombre') }}
                      </th>
                      <th>
                        {{ __('Asignado a') }}
                      </th>
                      <th>
                        {{ __('Fecha Solución') }}
                      </th>
                      <th>
                        {{ __('Estatus') }}
                      </th>
                      <th>
                        {{ __('¿Activo?') }}
                      </th>
                      <th class="text-right">
                        {{ __('Acciones') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($tareas as $tarea)
                        <tr>
                          <td> 
                          {{$tarea->tipo_tarea}}
                          </td>
                          <td>
                          {{$tarea->nombre_tarea}}
                          </td>
                          <td>   
                          @foreach($usuarios as $usuario)
                            @if($tarea->asignado_a == $usuario->id )                       
                              {{ $usuario->nombres  }} {{ $usuario->apellidos  }}
                            @endif
                          @endforeach                   
                          </td>
                          <td>                          
                          {{ $tarea->fecha_solucion }}
                          </td>
                          <td>                          
                          {{ $tarea->estatus  }}
                          </td>
                          <td>                          
                          {{ $tarea->esta_activo  }}
                          </td>
                          <td class="td-actions text-right">                       
                          
                              <form action="{{ route('tareas.destroy', $tarea) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('tareas.show', $tarea) }}" data-original-title="" title="">
                                    <i class="material-icons">face</i>
                                    <div class="ripple-container"></div>                               
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('tareas.edit', $tarea) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estas seguro de querer eliminar este tarea?") }}') ? this.parentElement.submit() : ''">
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