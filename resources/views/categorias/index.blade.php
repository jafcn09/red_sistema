@extends('layouts.app', ['activePage' => 'categoria_management', 'titlePage' => __('Categoria Management')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Categorías') }}</h4>
                <p class="card-category"> {{ __('Aquí puedes administrar las categorías de productos y servicios') }}</p>
              </div>
                    <div class="right">
                    <div class="col-12 text-right">
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal" class="btn btn-warning btn-sm"><i class="fa fa-edit">Agregar</i></button>
                    </div>
                    </div>
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{session('success')}}
                            </div>
                        @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach            
                                </ul>
                            </div> 
                        @endif

                    <div class="col-md-12">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td>Categoría</td>
                                        <td>Descripción</td>
                                        <td>Estatus</td>
                                        <td>Acción</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($categorias as $categoria)
                                    <tr>
                                        <td>{{$categoria->nombre}}</td>
                                        <td>{{$categoria->descripcion}}</td>
                                        <td>
                                          @if($categoria->esta_activo == 1)
                                            ACTIVO
                                          @elseif($categoria->esta_activo == 0)
                                            INACTIVO
                                          @endif
 
                                          </td>
                                        <td>
                                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-original-title="" title="" onclick="confirm('{{ __("¿Esta seguro de eliminar la categoría?") }}') ? this.parentElement.submit() : ''">
                                                    <i class="material-icons">close</i>
                                                    <div class="ripple-container"></div>
                                                </button>                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No hay datos registrados</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @slot('footer')

                        @endslot
                    </div>
           
        </div>
      </div>
    </div>
  </div>
<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insertar Categoría</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('categorias.store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="nombre">Nombre Categoría</label>
                                <input onkeyup="mayus(this);" name="nombre" type="text" class="form-control" id="nombre" aria-describedby="emailHelp" value="{{ old('nombre')}}">
                            </div>

                            <div class="form-group">
                                <label for="descriprion">Descripción</label>
                                <input onkeyup="mayus(this);" type="text" name="descripcion" class="form-control" id="descripcion" rows="3">{{ old('descripcion')}}
                            </div>
                            <div class="form-group">
                                <label for="esta_activo">Estatus</label>
                                <select class="form-control" name="esta_activo" class="custom-select"> 
                                            <option selected value="1">--Activo por Defecto --</option>
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                             
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-warning">Enviar</button>
                        </form>
                    </div>
                </div>
    </div>
@push('js')
<script>
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>
@endpush
@endsection