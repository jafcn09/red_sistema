@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Contratos</p>
              <h3 class="card-title">{{$contratos}}
                <small></small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">warning</i>
                <a href="#pablo">Pendientes por pago</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Clientes</p>
              <h3 class="card-title">{{$clientes_cont}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Ultimas 24 Horas
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">info_outline</i>
              </div>
              <p class="card-category">Total productos</p>
              <h3 class="card-title">{{$productos}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Ultimas 24 Horas
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fa fa-twitter"></i>
              </div>
              <p class="card-category">Total planes</p>
              <h3 class="card-title">{{$planes}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Ultimas 24 Horas
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Total Facturas Pagadas: <strong class="text-danger">{{$facturas}}</strong></h4>
              <p class="card-category">La última actualización fue</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
                @if($facturas > 0)
                    @if($fecha_fac == null)
                      Sin información
                    @else
                    {{ \Carbon\Carbon::parse($fecha_fac->updated_at)->format('d/m/Y H:i:s') }}</p>
                    @endif
                @else
                    Sin información
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Total Suscripciones por Correo: <strong class="text-danger">{{$suscriptores}}</strong></h4>
              <p class="card-category">La última actualización fue</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
                @if($suscriptores > 0)
                    @if($fecha_sus == null)
                      Sin información
                    @else
                    {{ \Carbon\Carbon::parse($fecha_sus->updated_at)->format('d/m/Y H:i:s') }}</p>
                    @endif
                @else
                    Sin información
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-danger">
              <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Total Tareas Completadas: <strong class="text-danger">{{$task}}</strong></h4>
              <p class="card-category">La última actualización fue</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i>
                @if($task > 0)
                    @if($fecha_tas == null)
                      Sin información
                    @else
                    {{ \Carbon\Carbon::parse($fecha_tas->updated_at)->format('d/m/Y H:i:s') }}</p>
                    @endif
                @else
                    Sin información
                @endif
                  
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-info">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Tareas:</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#profile" data-toggle="tab">
                        <i class="material-icons">bug_report</i> Fallas
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#messages" data-toggle="tab">
                        <i class="material-icons">code</i> Reclamos
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#settings" data-toggle="tab">
                        <i class="material-icons">cloud</i> Solicitudes
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                  <table class="table">
                  @if($cont_tareas > 0)
                  @foreach($tareas as $tarea)
                  @if($tarea->tipo_tarea == 'FALLA')
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                            @if($tarea->estatus == 'COMPLETADA')
                              <input class="form-check-input" type="checkbox" value="" checked>
                            @else
                              <input class="form-check-input" type="checkbox" value="">
                            @endif
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>{{$tarea->nombre_tarea}}</td>
                        <td class="td-actions text-right">
                          <button type="button"  data-toggle="modal" data-target="#loginModal{{$tarea->id}}">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" data-toggle="modal" data-target="#deleteModal{{$tarea->id}}">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                    @endif
                    @endforeach
                    @endif
                  </table>
                </div>
                <div class="tab-pane" id="messages">
                  <table class="table">
                  @if($cont_tareas > 0)
                  @foreach($tareas as $tarea)
                  @if($tarea->tipo_tarea == 'RECLAMO')
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              @if($tarea->estatus == 'COMPLETADA')
                                <input class="form-check-input" type="checkbox" value="" checked>
                              @else
                                <input class="form-check-input" type="checkbox" value="">
                              @endif
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>{{$tarea->nombre_tarea}}</td>
                        <td class="td-actions text-right">
                          <button type="button"  data-toggle="modal" data-target="#loginModal{{$tarea->id}}">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" data-toggle="modal" data-target="#deleteModal{{$tarea->id}}">
                            <i class="material-icons">close</i>
                          </button>
                        </td>

                    </tbody>
                    @endif
                    @endforeach
                    @endif
                  </table>
                </div>
                <div class="tab-pane" id="settings">
                  <table class="table">
                  @if($cont_tareas > 0)
                  @foreach($tareas as $tarea)
                  @if($tarea->tipo_tarea == 'SOLICITUD')
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              @if($tarea->estatus == 'COMPLETADA')
                                <input class="form-check-input" type="checkbox" value="" checked>
                              @else
                                <input class="form-check-input" type="checkbox" value="">
                              @endif
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>{{$tarea->nombre_tarea}}</td>
                        <td class="td-actions text-right">
                          <button type="button"  data-toggle="modal" data-target="#loginModal{{$tarea->id}}">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" data-toggle="modal" data-target="#deleteModal{{$tarea->id}}">
                            <i class="material-icons">close</i>
                          </button>

                        </td>
                      </tr>
                
                    </tbody>
                    @endif
                    @endforeach
                    @endif
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Estatus de Empleados</h4>
              <p class="card-category">Ultimo registro de empleado el: 
              @if($empleados_cont > 0)
                  {{ \Carbon\Carbon::parse($fecha->updated_at)->format('d/m/Y H:i:s') }}</p>
              @else
                  Sin información </p>
              @endif
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>Nro. Cédula</th>
                  <th>Nombres / Appelidos</th>
                  <th>Salario</th>
                  <th>Estatus</th>
                </thead>
                <tbody>
                @foreach($empleados as $empleado)
                  <tr>
                    <td>{{$empleado->cedula}}</td>
                    <td>{{$empleado->nombres}} {{$empleado->apellidos}}</td>
                    <td>{{$empleado->total_salario}}</td>
                    <td>
                        @if($empleado->esta_activo == 1)
                          <p class="material-icons text-success">check_circle
                        @else
                          <p class="material-icons text-danger">not_interested
                        @endif
                    </p>
                    </td>
                  </tr>
                @endforeach
                  <tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
    function mayus(e) {
    e.value = e.value.toUpperCase();
  }
  </script>
@endpush
<!-- Modal de tareas inicio -->
@if($cont_tareas > 0)
@foreach($tareas as $tarea)
<div class="modal fade" id="loginModal{{$tarea->id}}" tabindex="-1" role="">
    <div class="modal-dialog modal-login" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <div class="card-header card-header-warning text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                        <h4 class="card-title">Editar tarea</h4>
                        <div class="social-line">
 
                            <div class="ripple-container"></div></a>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="form" method="post" action="{{ route('tareas.actualizar', $tarea->id) }}">
                    @csrf
                    @method('put')
                        <p class="description text-center">Aquí puede editar los datos</p>
                        <div class="card-body">

                            <div class="form-group bmd-form-group">
                    @if($tarea->cliente_id)
                                    <div class="">
                                    <strong class="input-group-addon text-info">
                                        CLIENTE:
                                    </strong>
                                      @foreach($clientes as $cliente)
                                        @if($tarea->cliente_id == $cliente->id)
                                          {{$cliente->nombres}} {{$cliente->apellidos}}
                                        @endif
                                      @endforeach
                                    </div>
                    @endif
                                    <div class="">
                                    <strong class="input-group-addon text-info">
                                        TAREA:
                                    </strong>
                                      {{$tarea->nombre_tarea}}
                                    </div>

                                    <div class="">
                                    <strong class="input-group-addon text-info">
                                        DESCRIPCIÓN:
                                    </strong>
                                      {{$tarea->description}}
                                    </div>

                                    <div class="">
                                    <strong class="input-group-addon text-info">
                                        FECHA MÁXIMA DE SOLUCIÓN:
                                    </strong>
                                      {{$tarea->fecha_solucion}}
                                    </div>
                            </div> 
                            <div><label class="col-form-label">Solución</label></div>
                            <div class="form-group bmd-form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">done_all</i>
                                    </span>
                                    <textarea onkeyup="mayus(this);" name="solucion" placeholder="Ingrese la solución" rows="3" class="form-control">{{ $tarea->solucion }}</textarea>                                      </div>
                                </div>
                            </div>

                            <div class="form-group bmd-form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">done_all</i>
                                    </span>
                                    <select class="form-control" name="estatus" data-style="select-with-transition" data-size="2"> 
                                            @if($tarea->estatus == "ASIGNADA")
                                        <option selected value="ASIGNADA">ASIGNADA
                                            @elseif($tarea->estatus == "EN-PROCESO")
                                        <option selected value="EN-PROCESO">EN-PROCESO
                                            @elseif($tarea->estatus == "COMPLETADA")
                                        <option selected value="COMPLETADA">COMPLETADA
                                            @endif
                                        </option> 
                                        
                                        <option value="EN-PROCESO">EN-PROCESO</option>
                                        <option value="COMPLETADA">COMPLETADA</option>                 
                                    </select>   
                                </div>
                            </div>
                        </div>
                   
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-danger">Guardar Cambios</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
<!-- Modal de tareas fin -->
<!-- Modal delete -->
@if($cont_tareas > 0)
@foreach($tareas as $tarea)
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="deleteModal{{$tarea->id}}">
    {{Form::open(array('action' => array('TareaController@finalizar', $tarea -> id), 'method' => 'put'))}}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Eliminar Tarea</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Confirme si desea eliminar la tarea</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-warning">Confirmar</button>
                </div>
            </div>
        </div>
    {{Form::close()}}
</div>
@endforeach
@endif
<!-- Fin modal delete -->