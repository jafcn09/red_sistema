@extends('layouts.app', ['activePage' => 'torre-management', 'titlePage' => __('Torre Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Torres asociados a los nodos') }}</h4>
                <p class="card-category"> {{ __('Aqui puedes administrar las torres') }}</p>
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
                    <a href="{{ route('torres.create') }}" class="btn btn-sm btn-warning">{{ __('Agregar torre') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="card-header-warning">
                      <th>
                          {{ __('Nombre Torre') }}
                      </th>
                      <th>
                        {{ __('Descripción') }}
                      </th>
                      <th>
                        {{ __('Dirección') }}
                      </th>
                      <th>
                        {{ __('Coordenadas') }}
                      </th>
                      <th>
                        {{ __('Activo') }}
                      </th>
                      <th class="text-right">
                        {{ __('Acciones') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($torres as $torre)
                        <tr>
                          <td>
                            {{ $torre->nombre_torre }}
                          </td>
                          <td>
                            {{ $torre->descripcion_torre }}
                          </td>
                          <td>                          
                            {{ $torre->direccion }}
                          </td>
                          <td>
                            {{ $torre->coordenadas }}
                          </td>
                          <td>
                            {{ $torre->activo }}
                          </td>
                          <td class="td-actions text-right">                       
                          
                              <form action="{{ route('torres.destroy', $torre) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('torres.show', $torre) }}" data-original-title="" title="">
                                    <i class="material-icons">face</i>
                                    <div class="ripple-container"></div>                               
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('torres.edit', $torre) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estas seguro del eliminar el torre?") }}') ? this.parentElement.submit() : ''">
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