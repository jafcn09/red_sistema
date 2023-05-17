@extends('layouts.app', ['activePage' => 'producto_management', 'titlePage' => __('Producto Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Productos') }}</h4>
                <p class="card-category"> {{ __('Aqui puedes administrar tus productos') }}</p>
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
                    <a href="{{ route('productos.create') }}" class="btn btn-sm btn-warning">{{ __('Agregar Producto') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="">
                      <th scope="col">
                        {{ __('Serial/MAC') }}
                      </th>
                      <th>
                        {{ __('Nombre producto ') }}
                      </th>

                      <th>
                        {{ __('Cantidad') }}
                      </th>
                      <th>
                        {{ __('Precio ') }}
                      </th>
                      <th>
                        {{ __('Estatus') }}
                      </th>
                      <th>
                        {{ __('Imágen') }}
                      </th>

                      <th class="text-right">
                        {{ __('Acción') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($productos as $producto)
                        <tr>
                          <td>
                            <div style="width: auto;">
                            {{ $producto->codigo }}
                            </div>
                          </td>
                          <td>                          
                            {{ $producto->nombre }}
                          </td>

                          <td>
                            {{ $producto->cantidad }}
                          </td>
                          <td>                          
                            {{ $producto->precio }}
                          </td>
                          <td>  
                          @if ($producto->condicion == 1)
                            <p class="material-icons text-success">check_circle
                          @else
                            <p class="material-icons text-danger">not_interested
                          @endif
                            </p>
                          
                          </td>
                          <td>
                            @if (!empty($producto->imagen))
                                <img class="rounded float-left" src="{{ asset('uploads/productos/' . $producto->imagen) }}" 
                                alt="{{ $producto->nombre }}" width="50px" height="50px">
                            @else
                                <img class="rounded float-left" src="{{ asset('uploads/productos/img-50x50.png') }}" alt="{{ $producto->nombre }}">
                            @endif

                          </td>

                          <td class="td-actions text-right">                       
                          
                              <form action="{{ route('productos.destroy', $producto) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('productos.show', $producto) }}" data-original-title="" title="">
                                    <i class="material-icons">face</i>
                                    <div class="ripple-container"></div>                               
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('productos.edit', $producto) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Estas seguro de eliminar el producto?") }}') ? this.parentElement.submit() : ''">
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