@extends('layouts.app', ['activePage' => 'contrato-management', 'titlePage' => __('Contrato Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('contratos.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Agregar Contrato') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('contratos.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>

                <div class="row">              
                  <label class="col-sm-2 col-form-label">{{ __('Nombre del cliente') }}</label>
                  <div class="col-sm-8">
                    <select name="user_id" id="user_id" class="form-control form-control-xs selectpicker" data-live-search="true">
                        @foreach($clientes as $cliente)
                            <option value="{{$cliente -> id}}">
                            {{$cliente -> nombres}} {{$cliente -> apellidos}} - {{$cliente -> cedula}}</option>
                        @endforeach
                    </select>
                      @if ($errors->has('contrato'))
                        <span id="contrato-error" class="error text-danger" for="input-contrato">{{ $errors->first('contrato') }}</span>
                      @endif                   
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Número de  contrato') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('contrato_num') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('contrato_num') ? ' is-invalid' : '' }}" name="contrato_num" id="input-contrato_num" type="text" readonly="true" value="{{ $contrato_num }}" required="true" aria-required="true"/>
                      @if ($errors->has('contrato_num'))
                        <span id="contrato_num-error" class="error text-danger" for="input-contrato_num">{{ $errors->first('contrato_num') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Fecha inicio contrato') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('fecha_inicio') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('fecha_inicio') ? ' is-invalid' : '' }}" name="fecha_inicio" id="input-fecha_inicio" type="date" placeholder="{{ __('Ingrese su fecha_inicio') }}" value="{{ old('fecha_inicio') }}" required />
                      @if ($errors->has('fecha_inicio'))
                        <span id="fecha_inicio-error" class="error text-danger" for="input-fecha_inicio">{{ $errors->first('fecha_inicio') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Fecha fin contrato') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('fecha_fin') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('fecha_fin') ? ' is-invalid' : '' }}" name="fecha_fin" id="input-fecha_fin" type="date" placeholder="{{ __('Ingrese su fecha_fin') }}" value="{{ old('fecha_fin') }}" required="true" aria-required="true"/>
                      @if ($errors->has('fecha_fin'))
                        <span id="fecha_fin-error" class="error text-danger" for="input-fecha_fin">{{ $errors->first('fecha_fin') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                  <hr>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Descripción contrato') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" id="input-descripcion" type="text" placeholder="{{ __('Ingrese la descripcion del contrato') }}" value="{{ old('descripcion') }}" required />
                      @if ($errors->has('descripcion'))
                        <span id="descripcion-error" class="error text-danger" for="input-descripcion">{{ $errors->first('descripcion') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Plan del contrato') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('plan_id') ? ' has-danger' : '' }}">
                        <select class="form-control" name="plan_id" class="custom-select"> 
                        <option selected>-Selecione la opción-</option>                  
                          @foreach($planes as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->id }} {{ $plan->nombre }} {{ $plan->capacidad }} M {{ $plan->precio }} $</option>
                          @endforeach
                        </select>
                      @if ($errors->has('plan_id'))
                        <span id="plan_id-error" class="error text-danger" for="input-plan_id">{{ $errors->first('plan_id') }}</span>
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
<script src="{{ asset('js/buscador-bootstrap.js') }}"></script>
@endpush
@endsection