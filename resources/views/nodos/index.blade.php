@extends('layouts.app', ['activePage' => 'nodo-management', 'titlePage' => __('Nodo Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Nodos') }}</h4>
                <p class="card-category"> {{ __('Aqui puedes administrar los nodos') }}</p>
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
                    <a href="{{ route('nodos.create') }}" class="btn btn-sm btn-warning">{{ __('Agregar Nodo') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="card-header-warning">
                      <th>
                          {{ __('Nombre Nodo') }}
                      </th>
                      <th>
                          {{ __('Nombre Torre') }}
                      </th>
                      <th>
                        {{ __('Marca/Modelo Equipo') }}
                      </th>
                      <th>
                        {{ __('IP') }}
                      </th>
                      <th>
                        {{ __('MAC') }}
                      </th>
                      <th>
                        {{ __('Activo') }}
                      </th>
                      <th class="text-right">
                        {{ __('Acciones') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($nodos as $nodo)
                        <tr>
                          <td>
                            {{ $nodo->nombre }}
                          </td>
                          <td>
                            {{ $nodo->torre->nombre_torre }}
                          </td>
                          <td>                          
                            {{ $nodo->producto->marca }} / {{ $nodo->producto->modelo }}
                          </td>
                          <td>                          
                            {{ $nodo->ip }}
                          </td>
                          <td>
                            {{ $nodo->mac }}
                          </td>
                          <td>
                            {{ $nodo->activo }}
                          </td>
                          <td class="td-actions text-right">                       
                          
                              <form action="{{ route('nodos.destroy', $nodo) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('nodos.show', $nodo) }}" data-original-title="" title="">
                                    <i class="material-icons">face</i>
                                    <div class="ripple-container"></div>                               
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('nodos.edit', $nodo) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this nodo?") }}') ? this.parentElement.submit() : ''">
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