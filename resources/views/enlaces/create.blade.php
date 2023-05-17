@extends('layouts.app', ['activePage' => 'enlace-management', 'titlePage' => __('Enlace Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('enlaces.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Agregar Enlace') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('enlaces.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Cliente asociado') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('enlace') ? ' has-danger' : '' }}">
                    <select title="" name="user_id" id="user_id" class="form-control form-control-xm selectpicker" data-live-search="true"  value="{{ old('user_id')}}" >
                        @foreach($usuarios as $cliente)
                            <option value="{{$cliente -> id}}">
                            {{$cliente -> nombres}} {{$cliente -> apellidos}} - {{$cliente -> cedula}}</option>
                        @endforeach
                    </select>                      @if ($errors->has('enlace'))
                        <span id="enlace-error" class="error text-danger" for="input-enlace">{{ $errors->first('enlace') }}</span>
                      @endif
                    </div>
                  </div>
              </div>
              <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Router asociado') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('router_id') ? ' has-danger' : '' }}">
                    <select title="" name="router_id" id="router_id" class="form-control form-control-xs selectpicker" data-live-search="true"  value="{{ old('router_id')}}" >
                        @foreach($equipos as $equipo)
                            <option value="{{$equipo -> id}}">
                            {{$equipo -> codigo}} {{$equipo -> marca}} {{$equipo -> modelo}}</option>
                        @endforeach
                    </select>  
                      @if ($errors->has('router_id'))
                        <span id="router_id-error" class="error text-danger" for="input-router_id">{{ $errors->first('router_id') }}</span>
                      @endif
                    </div>
                  </div>

                  <label class="col-sm-2 col-form-label">{{ __('Nodo asociado') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('nodo_id') ? ' has-danger' : '' }}">
                    <select title="" name="nodo_id" id="nodo_id" class="form-control form-control-xs selectpicker" data-live-search="true"  value="{{ old('nodo_id')}}" >
                        @foreach($nodos as $nodo)
                            <option value="{{$nodo -> id}}">
                            {{$nodo -> nombre}} {{$nodo -> ip}}</option>
                        @endforeach
                    </select> 
                      @if ($errors->has('marnodo_idca'))
                        <span id="nodo_id-error" class="error text-danger" for="input-nodo_id">{{ $errors->first('nodo_id') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Antena asociada') }}</label>
                  <div class="col-sm-8">
                    <div class="form-group{{ $errors->has('producto_id') ? ' has-danger' : '' }}">
                    <select title="" name="producto_id" id="producto_id" class="form-control form-control-xs selectpicker" data-live-search="true"  value="{{ old('producto_id')}}" >
                        @foreach($equipos1 as $equipo)
                            <option value="{{$equipo -> id}}">
                            {{$equipo -> codigo}} {{$equipo -> marca}} {{$equipo -> modelo}} {{$equipo -> descripcion}} </option>
                        @endforeach
                    </select>  
                      @if ($errors->has('producto_id'))
                        <span id="producto_id-error" class="error text-danger" for="input-producto_id">{{ $errors->first('producto_id') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                  <hr>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('IP del ENLACE/CPE') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('ip') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('ip') ? ' is-invalid' : '' }}"  value="{{ old('ip')}}" name="ip" id="input-ip" type="text" placeholder="{{ __('Ingrese su ip') }}" required="true" aria-required="true"/>
                      
                      @if ($errors->has('ip'))
                        <span id="ip-error" class="error text-danger" for="input-ip">{{ $errors->first('ip') }}</span>
                      @endif
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('MAC del ENLACE/CPE') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('mac') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('mac') ? ' is-invalid' : '' }}"  value="{{ old('mac')}}" name="mac" id="input-mac" type="text" placeholder="{{ __('Ingrese la mac') }}" required="true" />
                      @if ($errors->has('mac'))
                        <span id="mac-error" class="error text-danger" for="input-mac">{{ $errors->first('mac') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                  <hr>
                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Coordenadas del ENLACE/CPE') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('coordenadas') ? ' has-danger' : '' }}">
                      <input onkeyup="mayus(this);" class="form-control{{ $errors->has('coordenadas') ? ' is-invalid' : '' }}" value="{{ old('coordenadas')}}" name="coordenadas" id="input-coordenadas" type="text" placeholder="{{ __('Ingrese coordenadas') }}" />
                      @if ($errors->has('coordenadas'))
                        <span id="coordenadas-error" class="error text-danger" for="input-coordenadas">{{ $errors->first('coordenadas') }}</span>
                      @endif
                    </div>
                  </div>

                  <label class="col-sm-2 col-form-label">{{ __('Esta Activo') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('activo') ? ' has-danger' : '' }}">
                    <select class="selectpicker" name="activo" data-style="select-with-transition" data-size="4"  value="{{ old('activo')}}" >
                          <option value="SI">ACTIVO</option>
                          <option value="NO">INACTIVO</option>                   
                      </select>                      
                      @if ($errors->has('activo'))
                        <span id="activo-error" class="error text-danger" for="input-activo">{{ $errors->first('activo') }}</span>
                      @endif
                    </div>
                  </div>
                  </div>
                  <hr>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Imagen del enlace') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('imagen') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('imagen') ? ' is-invalid' : '' }}" name="imagen" id="input-imagen" type="text" placeholder="{{ __('Ingrese la imagen del enlace') }}"  value="{{ old('imagen')}}" />
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
<script src="{{ asset('js/buscador-bootstrap.js') }}"></script>
@endpush
@endsection