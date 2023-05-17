@extends('layouts.app', ['activePage' => 'inventario', 'titlePage' => __('Lista Inventario')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-plain">
          <div class="card-header card-header-warning">
            <h4 class="card-title mt-0"> Listado de Inventario de la Empresa</h4>
            <p class="card-category"> Aqui podemos visualizar el listado de productos de la empresa</p>
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="">
                  <th>
                    MAC/Serial
                  </th>
                  <th>
                    Nombre
                  </th>
                  <th>
                    Descripción
                  </th>
                  <th>
                    Marca / Modelo
                  </th>
                  <th>
                    Precio
                  </th>
                  <th>
                    ¿En uso?
                  </th>
                </thead>
                <tbody>
                <p hidden>{!! $total = 0 !!}</p>
                @foreach($inventario as $inven)
                  <tr>
                    <td>
                      {{$inven->codigo}}
                    </td>
                    <td>
                      {{$inven->nombre}}
                    </td>
                    <td>
                      {{$inven->descripcion}}
                    </td>
                    <td>
                      {{$inven->modelo}}
                    </td>
                    <td>
                      {{$inven->precio}}
                      <p hidden>{!! $total = $total+$inven->precio !!}</p>
                    </td>
                    <td>
                      @if($inven->asignado == 1)
                            SI
                      @else
                            NO
                      @endif
      
                    </td>

                  </tr>
                @endforeach
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong class="text-danger">Inversión:</strong></td>
                    <td><strong class="text-danger">{!! $total !!}</strong></td>
                    <td></td>
                  </tr>
                 </tbody>
              </table>
            </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection