@extends('layouts.app', ['activePage' => 'producto_management', 'titlePage' => __('Producto Administrar')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" enctype="multipart/form-data" action="{{ route('productos.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Agregar Producto') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('productos.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div class="row">     
                  <label class="col-sm-3 col-form-label">{{ __('Categoría del producto') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('categoria_id') ? ' has-danger' : '' }}">
                    
                    <select class="form-control" name="categoria_id" class="custom-select"> 
                        <option selected>-Selecione la opción-</option>                  
                          @foreach($categoria as $categori)
                            <option value="{{ $categori->id }}">{{ $categori->id }} {{ $categori->nombre }} </option>
                          @endforeach
                        </select>
                      @if ($errors->has('categoria_id'))
                        <span id="categoria_id-error" class="error text-danger" for="input-categoria_id">{{ $errors->first('categoria_id') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Serial o MAC del producto') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('codigo') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" name="codigo" id="input-codigo" type="text" placeholder="{{ __('Ingrese codigo') }}" value="{{ old('codigo') }}" required="true" aria-required="true"/>

                      @if ($errors->has('codigo'))
                        <span id="codigo-error" class="error text-danger" for="input-codigo">{{ $errors->first('codigo') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Nombre producto') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" id="input-nombre" type="text" placeholder="{{ __('Ingrese nombre') }}" value="{{ old('nombre') }}" required="true" aria-required="true"/>
                      @if ($errors->has('nombre'))
                        <span id="nombre-error" class="error text-danger" for="input-nombre">{{ $errors->first('nombre') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                  <hr>
                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Marca del producto') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('marca') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('modelo') ? ' is-invalid' : '' }}" name="marca" id="input-marca" type="text" placeholder="{{ __('Ingrese marca') }}" value="{{ old('modelo') }}" required="true" aria-required="true"/>
                      @if ($errors->has('marca'))
                        <span id="marca-error" class="error text-danger" for="input-marca">{{ $errors->first('marca') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Modelo del producto') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('modelo') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('modelo') ? ' is-invalid' : '' }}" name="modelo" id="input-modelo" type="text" placeholder="{{ __('Ingrese modelo') }}" value="{{ old('modelo') }}" required="true" aria-required="true"/>
                      @if ($errors->has('modelo'))
                        <span id="modelo-error" class="error text-danger" for="input-modelo">{{ $errors->first('modelo') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                  <hr>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Descripción del producto') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" id="input-descripcion" type="text" placeholder="{{ __('Ingrese la descripcion del producto') }}" value="{{ old('descripcion') }}" required />
                      @if ($errors->has('descripcion'))
                        <span id="descripcion-error" class="error text-danger" for="input-descripcion">{{ $errors->first('descripcion') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Cantidad producto') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('cantidad') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('cantidad') ? ' is-invalid' : '' }}" name="cantidad" id="input-cantidad" type="number" placeholder="{{ __('  1') }}" value="1" required readonly/>
                      @if ($errors->has('cantidad'))
                        <span id="cantidad-error" class="error text-danger" for="input-cantidad">{{ $errors->first('cantidad') }}</span>
                      @endif
                    </div>
                  </div>
                    <label class="col-sm-2 col-form-label">{{ __('Precio producto') }}</label>
                    <div class="col-sm-3">
                      <div class="form-group{{ $errors->has('precio') ? ' has-danger' : '' }}">
                        <input class="form-control" name="precio" id="input-precio" type="number" step="any" placeholder="{{ __('Ingrese el precio') }}" value="{{ old('precio') }}" required="true" aria-required="true"/>
                          @if ($errors->has('precio'))
                            <span id="precio-error" class="error text-danger" for="input-precio">{{ $errors->first('precio') }}</span>
                          @endif
                      </div>
                    </div>
                </div>
                <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Foto del producto') }}</label>
                    <div class="col-sm-8" class="row h-1">
                      <div>
                      <input type="file" name="imagen" class="form-control">
                          @if ($errors->has('imagen'))
                            <span id="imagen-error" class="error text-danger" for="input-imagen">{{ $errors->first('imagen') }}</span>
                          @endif
                      </div>
                    </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Estatus') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('condicion') ? ' has-danger' : '' }}">
                      <select class="form-control" name="condicion" class="custom-select"> 
                          <option selected value="1">--ACTIVO POR DEFECTO--</option>
                          <option value="1">ACTIVO</option>
                          <option value="0">INACTIVO</option>                   
                      </select>
                      @if ($errors->has('condicion'))
                        <span id="condicion-error" class="error text-danger" for="input-condicion">{{ $errors->first('condicion') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-warning">{{ __('Agregar') }}</button>
              </div>
            </div>
          </form>
        </div>
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