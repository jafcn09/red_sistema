@extends('layouts.app', ['activePage' => 'contrato-management', 'titlePage' => __('Contrato Management')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Ver Contrato') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('contratos.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div class="col-md-6 text-left">

                    <p><strong>Cliente asociado al contrato: &nbsp;</strong>
                      @foreach($users as $user)
                        @if($contrato->user_id == $user->id)
                          {{$user->nombres}} {{$user->apellidos}}
                        @endif
                      @endforeach
                    </p>
                    <p><strong>Número de contrato: &nbsp;</strong>{{ $contrato->contrato_num }}</p>
                    <p><strong>Fecha inicio del contrato: &nbsp;</strong>{{ $contrato->fecha_inicio }}</p>
                    <p><strong>Fecha termino del contrato: &nbsp;</strong>{{ $contrato->fecha_fin }}</p>
                    <p><strong>Descripción del contrato: &nbsp;</strong>{{ $contrato->descripcion }}</p>
                    <p><strong>Características del plan asociado al contrato: &nbsp;</strong><br>
                    @foreach($planes as $plan)
                        @if($plan->id == $contrato->plan_id)                              
                           Nombre del plan: {{ $plan->nombre }}<br>
                           Capacidad del plan: {{ $plan->capacidad }} MB<br>
                           Precio del plan: {{ $plan->precio }} $
                        @endif
                    @endforeach
                    </p>
                    </div>
                    <div class="col-md-6 text-right">
            <div class="info-icons">            
           
               <a href="{{URL::action('ContratoController@pdf', $contrato -> id)}}">
                            <i class="fa fa-print fa-6" aria-hidden="true">DESCARGAR CONTRATO</i>
                        </a>
                <p></p>            
            </div>
        </div>
              

      </div>
    </div>
  </div>
@endsection
