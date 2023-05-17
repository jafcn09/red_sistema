@extends('layouts.app', ['activePage' => 'servicio-management', 'titlePage' => __('Servicio Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" enctype="multipart/form-data" action="{{ route('servicios.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Agregar Servicio') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('servicios.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div class="row">     
                  <label class="col-sm-2 col-form-label">{{ __('Categoría del servicio') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('categoria_id') ? ' has-danger' : '' }}">
                 
                          @foreach($categoria as $categori)
                            @if($categori->id == 2)
                            <input name="categoria_id" id="input-codigo" type="hidden" value="{{ $categori->id }}" />
                            <input name="muestra_categoria_id" type="integer" value="{{ $categori->id }}-{{ $categori->nombre }}" disabled="true" /> 
                            @endif                           
                          @endforeach

                      @if ($errors->has('categoria_id'))
                        <span id="categoria_id-error" class="error text-danger" for="input-categoria_id">{{ $errors->first('categoria_id') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Código servicio') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('codigo') ? ' has-danger' : '' }}">
                      <input name="codigo" id="input-codigo" type="hidden" value="{{ $code }}" />
                      <input name="codigo_oculto" type="integer" value="{{ $code }}" disabled="true" />

                      @if ($errors->has('codigo'))
                        <span id="codigo-error" class="error text-danger" for="input-codigo">{{ $errors->first('codigo') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <hr><hr>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nombre servicio') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" id="input-nombre" type="text" placeholder="{{ __('Ingrese nombre') }}" value="{{ old('nombre') }}" required="true" aria-required="true"/>
                      @if ($errors->has('nombre'))
                        <span id="nombre-error" class="error text-danger" for="input-nombre">{{ $errors->first('nombre') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Descripción del servicio') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" id="input-descripcion" type="text" placeholder="{{ __('Ingrese la descripcion del servicio') }}" value="{{ old('descripcion') }}" required />
                      @if ($errors->has('descripcion'))
                        <span id="descripcion-error" class="error text-danger" for="input-descripcion">{{ $errors->first('descripcion') }}</span>
                      @endif
                    </div>
                  </div>
                </div><hr><hr>
                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Precio servicio') }}</label>
                    <div class="col-sm-3">
                      <div class="form-group{{ $errors->has('precio') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('precio') ? ' is-invalid' : '' }}" name="precio" id="input-precio" type="number" placeholder="{{ __('Ingrese el precio') }}"  required="true" aria-required="true"/>
                          @if ($errors->has('precio'))
                            <span id="precio-error" class="error text-danger" for="input-precio">{{ $errors->first('precio') }}</span>
                          @endif
                      </div>
                    </div>
                    <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('cantidad') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('cantidad') ? ' is-invalid' : '' }}" name="cantidad" id="input-cantidad" type="hidden"  value="1"  />
                      @if ($errors->has('cantidad'))
                        <span id="cantidad-error" class="error text-danger" for="input-cantidad">{{ $errors->first('cantidad') }}</span>
                      @endif
                    </div>
                  </div>

                </div>
                <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Imágen del servicio') }}</label>
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