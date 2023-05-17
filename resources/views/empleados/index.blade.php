@extends('layouts.app', ['activePage' => 'empleado-management', 'titlePage' => __('Lista Empleados')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-plain">
          <div class="card-header card-header-warning">
            <h4 class="card-title mt-0"> Listado de Empleados</h4>
            <p class="card-category"> Aqui podemos visualizar el listado de trabajadores de la empresa</p>
          </div>
          <div class="card-body">

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
                    Salario
                  </th>
                  <th>
                    Activo
                  </th>
                </thead>
                <tbody>
                @foreach($usuarios as $usuario)
                  <tr>
                    <td>
                      {{$usuario->id}}
                    </td>
                    <td>
                      {{$usuario->name}}
                    </td>
                    <td>
                      {{$usuario->nombres  }} {{$usuario->apellidos}}
                    </td>
                    <td>
                      {{$usuario->telefono}} {{$usuario->celular}}
                    </td>
                    <td>
                      {{$usuario->email}}
                    </td>
                    <td>
                      {{$usuario->total_salario}}
                    </td>
                    <td>
                      @if($usuario->esta_activo == 1)
                            SI
                      @else
                            NO
                      @endif
      
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