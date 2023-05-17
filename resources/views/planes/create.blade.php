@extends('layouts.app', ['activePage' => 'plan-management', 'titlePage' => __('Plan Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" enctype="multipart/form-data" action="{{ route('planes.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Agregar Plan') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('planes.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nombre del plan') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                    <input onkeyup="mayus(this);" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" id="input-nombre" type="text" placeholder="{{ __('Ingrese nombre del plan') }}" value="{{ old('nombre') }}" required="true" aria-required="true"/>
                      @if ($errors->has('plan'))
                        <span id="nombre-error" class="error text-danger" for="input-nombre">{{ $errors->first('nombre') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Descripción del plan') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" id="input-descripcion" type="text" placeholder="{{ __('Ingrese descripción del plan') }}" value="{{ old('descripcion') }}" required="true" aria-required="true"/>
                      @if ($errors->has('descripcion'))
                        <span id="descripcion-error" class="error text-danger" for="input-descripcion">{{ $errors->first('descripcion') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Capacidad en megas') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('capacidad') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('capacidad') ? ' is-invalid' : '' }}" name="capacidad" id="input-capacidad" type="text" placeholder="{{ __('Ingrese su capacidad') }}" value="{{ old('capacidad') }}" required />
                      @if ($errors->has('capacidad'))
                        <span id="capacidad-error" class="error text-danger" for="input-capacidad">{{ $errors->first('capacidad') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Precio del plan') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('precio') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('precio') ? ' is-invalid' : '' }}" name="precio" id="input-precio" type="text" placeholder="{{ __('Ingrese el precio') }}" value="{{ old('precio') }}" required="true" aria-required="true"/>
                      @if ($errors->has('precio'))
                        <span id="precio-error" class="error text-danger" for="input-precio">{{ $errors->first('precio') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                  <hr>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Imagen del plan') }}</label>
                  <div class="col-sm-8">
                  <div>
                      <input type="file" name="imagen" class="form-control">
                          @if ($errors->has('imagen'))
                            <span id="imagen-error" class="error text-danger" for="input-imagen">{{ $errors->first('imagen') }}</span>
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