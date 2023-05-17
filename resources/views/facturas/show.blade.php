@extends('layouts.app', ['activePage' => 'factura-management', 'titlePage' => __('Factura Management')])

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
                <h4 class="card-title">{{ __('Ver factura') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('facturas.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
             <div class="form-group">            
               <label for="nombre">Cliente:</label>
               <p>{{$factura -> nombres}} {{$factura -> apellidos}}</p>
            </div>
        </div>
          
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
             <div class="form-group">            
               <label for="nombre">Tipo de comprobante:</label>
                <p>{{$factura -> tipo_comprobante}}</p>
        </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="codigo">Serie del comprobante:</label>
               <p>{{$factura -> factura_num }}</p>         
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="info-icons">            
           
               <a href="{{URL::action('FacturaController@pdf', $factura -> id)}}">
                            <i class="fa fa-print fa-6" aria-hidden="true">Imprimir</i>
                        </a>
                <p></p>            
            </div>
        </div>
</div>
    <div class="row">
       
       <div class="panel panel-warning">
           <div class="panel-body">               
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #A9D0F5">                            
                            <th>Artículo</th>
                            <th>Cantidad</th>
                            <th>Precio factura</th> 
                            <th>Descuento</th>                            
                            <th>Subtotal</th>
                        </thead>
                        <tfoot>                            
                            <th></th>
                            <th></th>
                            <th></th> 
                            <th></th>                           
                            <th><h4 id="total">{{$factura -> total }}</h4></th>
                        </tfoot>
                        <tbody>
                        @if($detalles->count() > 0)
                            @foreach($detalles as  $det)
                                <tr>
                                    <td>{{$det -> producto}}</td>
                                    <td>{{$det -> cantidad}}</td>
                                    <td>{{$det -> precio}}</td>                               
                                    <td>{{$det -> descuento}}</td>                               
                                    <td>{{$det -> cantidad * $det -> precio - $det -> descuento}}</td>
                                </tr>
                            
                            @endforeach
                        @endif
                        @if($detalles_plan->count() > 0)
                            @foreach($detalles_plan as  $det)
                                @if($detalles_plan->count() < $det->cantidad  )
                                <tr>
                                     <td>{{$det -> plan}}</td>
                                     <td>{{$det -> cantidad}}</td>
                                     <td>{{$det -> precio}}</td>                               
                                     <td>{{$det -> descuento}}</td>                               
                                     <td>{{$det -> cantidad * $det -> precio - $det -> descuento}}</td>
                                </tr>
                                @endif
                            @endforeach
                        @else
                      
                        @endif
                        
                            @foreach($planes as  $plan)
                                <tr>
                                    <td>{{$plan -> plan}}</td>
                                    <td>{{$plan -> cantidad}}</td>
                                    <td>{{$plan -> precio}}</td>                               
                                    <td>{{$plan -> descuento}}</td>                               
                                    <td>{{$plan -> precio - $det -> descuento}}</td>
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