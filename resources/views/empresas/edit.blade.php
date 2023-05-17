@extends('layouts.app', ['activePage' => 'categoria-management', 'titlePage' => __('Categoria Management')])
@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('categorias.update', $categorias) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Categoria') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('categorias.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
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
                    <div class="modal-body">
                        <form action="{{ route('categorias.update', $categorias->id) }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="nombre">Categoria</label>
                                <input name="nombre" type="text" class="form-control" id="nombre" aria-describedby="emailHelp" placeholder="Enter nombre" value="{{$categorias->nombre}}">
                            </div>

                            <div class="form-group">
                                <label for="descriprion">Description</label>
                                <textarea name="descripcion" class="form-control" id="descripcion" rows="3">{{$categorias->descripcion}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="esta_activo">Estatus</label>
                                <select class="form-control" name="esta_activo" class="custom-select"> 
                                          @if($categorias->esta_activo == 1)
                                            <option selected value="1">Activo
                                          @elseif($categorias->esta_activo == 0)
                                            <option selected value="0">Inactivo
                                          @endif
                                            </option>
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>   
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <a href="/categorias/index" class="btn btn-secondary">Close</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
                @slot('footer')

                @endslot    
                </div>
                </div>
        </section>
    </div>
@endsection