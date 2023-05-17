@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-plain">
          <div class="card-header card-header-primary">
            <h4 class="card-title mt-0"> Listado de Empleados</h4>
            <p class="card-category"> Aqui podemos visualizar el listado de trabajadores de la empresa</p>
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
                    <a href="{{ route('clientes.create') }}" class="btn btn-sm btn-primary">{{ __('Agregar') }}</a>
                  </div>
                </div>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="">
                  <th>
                    ID
                  </th>
                  <th>
                    Rol de usuario
                  </th>
                  <th>
                    Nombres / Apellidos
                  </th>
                  <th>
                    Teléfono / Celular
                  </th>
                  <th>
                    Correo
                  </th>
                  <th>
                    Cargo
                  </th>
                  <th>
                    Salario
                  </th>
                </thead>
                <tbody>
                @foreach($empleados as $empleado)
                  <tr>
                    <td>
                      {{$empleado->id}}
                    </td>
                    <td>
                      {{$empleado->name}}
                    </td>
                    <td>
                      {{$empleado->nombres}} {{$empleado->apellidos}}
                    </td>
                    <td>
                      {{$empleado->telefono}} {{$empleado->celular}}
                    </td>
                    <td>
                      {{$empleado->email}}
                    </td>
                    <td>
                      {{$empleado->cargo}}
                    </td>
                    <td>
                      {{$empleado->total_salario}}
                    </td>
                  </tr>
                @endforeach
                 </tbody>
              </table>
            </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection