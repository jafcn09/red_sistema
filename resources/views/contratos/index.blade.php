@extends('layouts.app', ['activePage' => 'contrato-management', 'titlePage' => __('Contrato Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Contratos') }}</h4>
                <p class="card-category"> {{ __('Aqui podemos administrar los contratos de nuestros clientes') }}</p>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-12 text-right">
                  @if(auth()->user()->isRole('ADMINISTRADOR') || auth()->user()->isRole('EMPLEADO'))
                    <a href="{{ route('contratos.create') }}" class="btn btn-sm btn-warning">{{ __('Agregar Contrato') }}</a>
                  @endif
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="card-header-warning">
                      <th>
                          {{ __('Cliente') }}
                      </th>
                      <th>
                          {{ __('Num contrtato') }}
                      </th>
                      <th>
                        {{ __('Fecha inicio') }}
                      </th>
                      <th>
                        {{ __('Fecha fin ') }}
                      </th>
                      <th>
                        {{ __('Plan de Internet') }}
                      </th>
                      <th class="text-right">
                        {{ __('Actions') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($contratos as $contrato)
                      @if(auth()->id() == $contrato->user_id && auth()->user()->isRole('CLIENTE'))
                        <tr>
                        <td>
                            @foreach($users as $user)
                              @if($contrato->user_id == $user->id)
                                {{$user->nombres}} {{$user->apellidos}}
                              @endif
                            @endforeach
                          </td>
                          <td>
                            {{ $contrato->contrato_num }}
                          </td>
                          <td>
                            {{ $contrato->fecha_inicio }}
                          </td>
                          <td>                          
                            {{ $contrato->fecha_fin }}
                          </td>
                          <td>
                            @foreach($planes as $plan)
                                @if($plan->id == $contrato->plan_id)                              
                                  {{ $plan->nombre }}
                                @endif
                            @endforeach
                          </td>
                          <td class="td-actions text-right">                       
                          
                              <form action="{{ route('contratos.destroy', $contrato) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  @if(auth()->user()->can('contratos.show'))  
                                  <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('contratos.show', $contrato) }}" data-original-title="" title="">
                                    <i class="material-icons">face</i>
                                    <div class="ripple-container"></div>   
                                  @endif
                                  @if(auth()->user()->can('contratos.edit'))                          
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('contratos.edit', $contrato) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  @endif
                                  @if(auth()->user()->can('contratos.delete')) 
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this contrato?") }}') ? this.parentElement.submit() : ''">
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button>
                                  @endif
                              </form>
                              
                          </td>
                        </tr>
                      @elseif(auth()->user()->isRole('ADMINISTRADOR') || auth()->user()->isRole('EMPLEADO'))
                      <tr>
                        <td>
                            @foreach($users as $user)
                              @if($contrato->user_id == $user->id)
                                {{$user->nombres}} {{$user->apellidos}}
                              @endif
                            @endforeach
                          </td>
                          <td>
                            {{ $contrato->contrato_num }}
                          </td>
                          <td>
                            {{ $contrato->fecha_inicio }}
                          </td>
                          <td>                          
                            {{ $contrato->fecha_fin }}
                          </td>
                          <td>
                            @foreach($planes as $plan)
                                @if($plan->id == $contrato->plan_id)                              
                                  {{ $plan->nombre }}
                                @endif
                            @endforeach
                          </td>
                          <td class="td-actions text-right">                       
                          
                              <form action="{{ route('contratos.destroy', $contrato) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  @if(auth()->user()->can('contratos.show'))  
                                  <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('contratos.show', $contrato) }}" data-original-title="" title="">
                                    <i class="material-icons">face</i>
                                    <div class="ripple-container"></div>   
                                  @endif
                                  @if(auth()->user()->can('contratos.edit'))                          
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('contratos.edit', $contrato) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  @endif
                                  @if(auth()->user()->can('contratos.delete')) 
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this contrato?") }}') ? this.parentElement.submit() : ''">
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button>
                                  @endif
                              </form>
                              
                          </td>
                        </tr>
                      @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection