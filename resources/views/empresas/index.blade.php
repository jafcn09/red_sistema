@extends('layouts.app', ['activePage' => 'empresa-management', 'titlePage' => __('Empresa Management')])

@section('content')
<section class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Administrar Datos de Empresa') }}</h4>
                <p class="card-category"> {{ __('Aquí puedes administrar los datos mas importantes de la empresa') }}</p>
              </div>
                    <div class="right">
                    @if (!$empresas->count())
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal" class="btn btn-warning btn-sm"><i class="fa fa-edit">Agregar</i></button>
                    @endif
                    </div>
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{session('success')}}
                            </div>
                        @elseif(session('danger'))
                        <div class="alert alert-danger" role="alert">
                                {{session('danger')}}
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
                                <thead class="bg-orange">
                                    <tr>
                                        <td>Nombre empresa</td>
                                        <td>RUC</td>
                                        <td>Teléfono</td>
                                        <td>Celular</td>
                                        <td>Dirección</td>
                                        <td>Descripción</td>
                                        <td>Logo</td>
                                        <td>Acciones</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($empresas as $empresa)
                                    <tr>
                                        <td>{{$empresa->nombre}}</td>
                                        <td>{{$empresa->ruc}}</td>
                                        <td>{{$empresa->telefono}}</td>
                                        <td>{{$empresa->celular}}</td>
                                        <td>{{$empresa->direccion}}</td>
                                        <td>{{$empresa->descripcion}}</td>
                                        <td>
                                        @if (!empty($empresa->logo))
                                            <img class="rounded float-left" src="{{ asset('img/' . $empresa->logo) }}" 
                                            alt="{{ $empresa->logo }}" width="50px" height="50px">
                                        @else
                                            <img class="rounded float-left" src="{{ asset('img/img-50x50.png') }}" alt="{{ $empresa->nombre }}">
                                        @endif
                                        
                                        </td>
                                        
                                        <td>
                                            <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                                <input type="hidden" name="_method" value="DELETE">
                                                
                                                <a href="#exampleModalEdit" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalEdit{{$empresa->id}}" data-id="exampleModalEdit" title="Editar"><i class="fa fa-edit"></i></a>
 
                                                <button type="button" class="btn btn-danger btn-sm" data-original-title="" title="" onclick="confirm('{{ __("¿Estas seguro de eliminar la Empresa?") }}') ? this.parentElement.submit() : ''">
                                                    <i class="material-icons">close</i>
                                                    <div class="ripple-container"></div>
                                                </button>                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No se encontraron datos...</td>
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
        </section>
<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insertar Empresa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('empresas.store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="nombre">Nombre Empresa</label>
                                <input name="nombre" type="text" class="form-control" id="nombre" aria-describedby="emailHelp" value="{{ old('nombre')}}">
                            </div>

                            <div class="form-group">
                                <label for="ruc">RUC Empresa</label>
                                <input type="text" name="ruc" class="form-control" id="ruc" rows="3">{{ old('ruc')}}
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono Empresa</label>
                                <input type="text" name="telefono" class="form-control" id="telefono" rows="3">{{ old('telefono')}}
                            </div>
                            <div class="form-group">
                                <label for="celular">Celular Empresa</label>
                                <input type="text" name="celular" class="form-control" id="celular" rows="3">{{ old('celular')}}
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección Empresa</label>
                                <input type="text" name="direccion" class="form-control" id="direccion" rows="3">{{ old('direccion')}}
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción Empresa</label>
                                <input type="text" name="descripcion" class="form-control" id="descripcion" rows="3">{{ old('descripcion')}}
                            </div>
                            <div class="">
                                <label for="logo">Logo Empresa</label>
                            
                                <input class="form-control" name="logo" id="input-logo" type="file"  />

                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Enviar</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
@if(count($empresas))
<!-- Modal EDITAR-->
<div class="modal fade" id="exampleModalEdit{{$empresa->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalEditLabel">Insertar Empresa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('empresas.update',$empresa->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="nombre">Nombre Empresa</label>
                                <input name="nombre" type="text" class="form-control" id="nombre" aria-describedby="emailHelp" value="{{ $empresa->nombre }}">
                            </div>

                            <div class="form-group">
                                <label for="ruc">RUC Empresa</label>
                                <input type="text" name="ruc" class="form-control" id="ruc" rows="3" value="{{ $empresa->ruc }}">{{ old('ruc')}}
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono Empresa</label>
                                <input type="text" name="telefono" class="form-control" id="telefono" rows="3" value="{{ $empresa->telefono }}">{{ old('telefono')}}
                            </div>
                            <div class="form-group">
                                <label for="celular">Celular Empresa</label>
                                <input type="text" name="celular" class="form-control" id="celular" rows="3" value="{{ $empresa->celular }}">{{ old('celular')}}
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección Empresa</label>
                                <input type="text" name="direccion" class="form-control" id="direccion" rows="3" value="{{ $empresa->direccion }}">{{ old('direccion')}}
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción Empresa</label>
                                <input type="text" name="descripcion" class="form-control" id="descripcion" rows="3" value="{{ $empresa->descripcion }}">{{ old('descripcion')}}
                            </div>
                            <div class="">
                                <label for="logo">Logo Empresa</label>

                                <input value="{{ old('logo') }}" class="form-control" name="logo" id="input-logo" type="file"  />
                                    @if (!empty($empresa->logo))
                                        <img src="{{ asset('img/' . $empresa->logo) }}" 
                                        alt="{{ $empresa->nombre }}" width="200px" height="200px">
                                    @else
                                        <img src="{{ asset('img/' . 'img-50x50.png') }}" alt="{{ $empresa->nombre }}">
                                    @endif

                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endif
@push('js')
<script>
/*     $(document).ready(function (e) {
    $('#exampleModalEdit').on('show.bs.modal', function(e) {    
        var id = $(e.relatedTarget).data().id;
        $(e.currentTarget).find('#nombre').val(id);
    });
    }); */
</script>

@endpush
@endsection