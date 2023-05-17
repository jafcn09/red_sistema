@extends('layouts.app', ['activePage' => 'producto_management', 'titlePage' => __('Producto Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" enctype="multipart/form-data" action="{{ route('productos.update', $producto->id) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Editar Producto') }}</h4>
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

                    <div readonly>{{ $producto->categoria['id'] }} {{ $producto->categoria['nombre'] }}  </div>                
 
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
                      <input onkeyup="mayus(this);" value="{{ old('codigo', $producto->codigo) }}" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" name="codigo" id="input-codigo" type="text" placeholder="{{ __('Ingrese su codigo') }}" readonly />

                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Nombre producto') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" value="{{ old('nombre', $producto->nombre) }}" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" id="input-nombre" type="text" placeholder="{{ __('Ingrese nombre') }}" required="true" aria-required="true"/>
                      @if ($errors->has('nombre'))
                        <span id="nombre-error" class="error text-danger" for="input-nombre">{{ $errors->first('nombre') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                  <hr>
                <div class="row">
                  <label class="col-sm-3 col-form-label">{{ __('Descripción del producto') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" value="{{ old('descripcion', $producto->descripcion) }}" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" id="input-descripcion" type="text" placeholder="{{ __('Ingrese la descripcion del producto') }}" required />
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
                    <input value="{{ old('cantidad', $producto->cantidad) }}" class="form-control{{ $errors->has('cantidad') ? ' is-invalid' : '' }}" name="cantidad" id="input-cantidad" type="number" placeholder="{{ __('Cantidad del producto') }}" required />
                      @if ($errors->has('cantidad'))
                        <span id="cantidad-error" class="error text-danger" for="input-cantidad">{{ $errors->first('cantidad') }}</span>
                      @endif
                    </div>
                  </div>
                    <label class="col-sm-2 col-form-label">{{ __('Precio producto') }}</label>
                    <div class="col-sm-3">
                      <div class="form-group{{ $errors->has('precio') ? ' has-danger' : '' }}">
                        <input value="{{ old('precio', $producto->precio) }}" class="form-control{{ $errors->has('precio') ? ' is-invalid' : '' }}" name="precio" id="input-precio" type="decimal" placeholder="{{ __('Ingrese el precio') }}" required="true" aria-required="true"/>
                          @if ($errors->has('precio'))
                            <span id="precio-error" class="error text-danger" for="input-precio">{{ $errors->first('precio') }}</span>
                          @endif
                      </div>
                    </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Estatus') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('condicion') ? ' has-danger' : '' }}">
                    <select class="form-control" name="condicion" class="custom-select"> 
                        @if($producto->condicion == 1)
                           <option selected value="1">ACTIVO
                        @elseif($producto->condicion == 0)
                           <option selected value="0">INACTIVO
                        @endif
                           </option>
                        <option value="1">ACTIVO</option>
                        <option value="0">INACTIVO</option>   
                      </select>
                      @if ($errors->has('condicion'))
                        <span id="condicion-error" class="error text-danger" for="input-condicion">{{ $errors->first('condicion') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Imágen del producto') }}</label>
                    <div class="col-sm-8" class="row h-1">
                      <div>
                      <input value="{{ old('imagen') }}" class="form-control" name="imagen" id="input-imagen" type="file"  />
                      @if (!empty($producto->imagen))
                        <img src="{{ asset('uploads/productos/' . $producto->imagen) }}" 
                        alt="{{ $producto->nombre }}" width="200px" height="200px">
                      @else
                          <img src="{{ asset('uploads/productos/' . 'img-50x50.png') }}" alt="{{ $producto->nombre }}">
                      @endif

                          @if ($errors->has('imagen'))
                            <span id="imagen-error" class="error text-danger" for="input-imagen">{{ $errors->first('imagen') }}</span>
                          @endif
                      </div>
                    </div>
                </div>


              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-warning">{{ __('Guardar') }}</button>
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