@extends('layouts.app', ['activePage' => 'factura-management', 'titlePage' => __('Factura Management')])

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('facturas.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Agregar Pago') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
              @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif

                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('facturas.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <h3>Nueva factura número: {{$factura_num}}</h3>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors -> all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
        
                {{Form::open(array('url' => 'facturas/factura', 'method' => 'POST', 'autocomplete' => 'off'))}}
                {{Form::token()}}
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">            
                    <label for="nombre">Cliente:</label>
                    <select name="pcliente_id" id="pcliente_id" class="form-control form-control-xs selectpicker" data-live-search="true">
                        @foreach($clientes as $cliente)
                            <option value="{{$cliente -> id}}_{{$cliente -> id_plan}}_{{$cliente -> nombre}}_{{$cliente -> capacidad}}_{{$cliente -> precio}}">
                            {{$cliente -> nombres}} {{$cliente -> apellidos}} - {{$cliente -> cedula}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
<!-- Inicio del calculo de contrato asociado al cliente -->

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">            
                                <label for="cantidad">Nombre del plan:</label>
                                <input type="text" class="form-control" name="pplan" id="pplan" readonly>            
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">            
                            <label for="cantidad">Capacidad:</label>
                                <input type="number" class="form-control" value= "0" name="pcapacidad" readonly id="pcapacidad" >            
                            </div>
                        </div>                
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">            
                            <label for="cantidad">Precio:</label>
                                <input type="number" class="form-control" name="pplan_precio" id="pplan_precio" readonly>            
                            </div>
                        </div> 
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">            
                            <label for="cantidad">Descuento:</label>
                                <input type="number" class="form-control" value= "0" name="pdescuento1" id="pdescuento1" placeholder="Descuento...">            
                            </div>
                        </div>  
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">  
                                <label for="cantidad">Monto a Pagar:</label>
                                <input type="text" class="form-control" name="pmonto" id="pmonto" >            
                            </div>
                        </div>                

        </div>
            <div class="row">
            
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="">Producto</label>
                                <select class="form-control selectpicker" name="pproducto_id" id="pproducto_id" data-Live-search="true">
                                    @foreach($productos as $producto)
                                        <option value="{{$producto -> id}}_{{$producto -> cantidad}}_{{$producto -> precio}}">{{$producto -> producto}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       <br>
                       <input type="text" hidden="true" name="factura_num" id="factura_num" value="{{$factura_num}}">
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">  
                                <label for="cantidad">Stock:</label>
                                <input type="number" class="form-control" name="pcantidad" id="pcantidad" readonly>            
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">            
                                <label for="cantidad">Precio de factura:</label>
                                <input type="number" class="form-control" name="pprecio" id="pprecio" readonly>            
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">            
                            <label for="cantidad">Descuento:</label>
                                <input type="number" class="form-control" value= "0" name="pdescuento" id="pdescuento" placeholder="Descuento...">            
                            </div>
                        </div>                
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">            
                            <label for="cantidad">Cantidad:</label>
                                <input type="number" class="form-control" name="pasignar" id="pasignar" value="1" placeholder="cantidad">            
                            </div>
                        </div> 

                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group">            
                            <label for="nombre">Tipo de comprobante:</label>
                            <select name="tipo_comprobante" id="" class="form-control selectpicker">                  
                                <option value="RECIBO">RECIBO</option> 
                                <option value="FACTURA">FACTURA</option>
                                
                            </select>
                        </div>
               
                </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">            
                            <button type="button" id="bt_add1" class="btn btn-info">Agregar Plan</button>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">            
                            <button type="button" id="bt_add" class="btn btn-success">Agregar Producto</button>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #A9D0F5">
                                    <th>Opciones</th>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Precio factura</th>
                                    <th>Descuento</th>
                                    <th>Subtotal</th>
                                </thead>
                                <tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">S/. 0.00</h4> <input type="text" name="total_venta" id="total_venta"></th>
                                </tfoot>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
    
                <div class="form-group">
                    <input name="_token" value="{{csrf_token()}}" type="hidden">
                    <button class="btn btn-warning" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Borrar</button>
                </div>  
               
            </div>
            </div>                
            {{Form::close()}}
            </div>  
        </div>  
       </div>  
    </div>  
 
@push('js')

<script>
    $(document).ready(function(){
         //Asignar productos
        $('#bt_add').click(function(){
            agregar();
        })
        //Asignar plan cliente
        $('#bt_add1').click(function(){
            agregarCli();
        })

        mostrarValoresPro();
        mostrarValoresCli();
        
    });
    
    //variables
    var cont =0;
    total = 0;
    subtotal=[];
    $('#guardar').hide();
    
    //cada vez que se cambie el producto se ejecuta
    $('#pproducto_id').change(mostrarValoresPro);
    $('#pcliente_id').change(mostrarValoresCli);
    
    function mostrarValoresPro(){
        datosProducto = document.getElementById('pproducto_id').value.split('_');
        $('#pprecio').val(datosProducto[2]);
        $('#pcantidad').val(datosProducto[1]);
    }
    function mostrarValoresCli(){
        datosContrato = document.getElementById('pcliente_id').value.split('_');
        $('#pplan_precio').val(datosContrato[4]);
        $('#pcapacidad').val(datosContrato[3]);
        $('#pplan').val(datosContrato[2]);
        $('#pmonto').val(datosContrato[4]);
    }
    
    function agregar(){
        //Obtener datos de productos   
        datosProducto = document.getElementById('pproducto_id').value.split('_');
        id = datosProducto[0];
        //Obtener ID cliente
        datosContrato = document.getElementById('pcliente_id').value.split('_');
        idCli = datosContrato[0];
        //Datos de productos
        producto = $('#pproducto_id option:selected').text();
        asignar = $('#pasignar').val();
        precio = $('#pprecio').val();
        descuento = $('#pdescuento').val();
        cantidad = $('#pcantidad').val();
        
        if(id != "" && asignar != "" && asignar > 0 && precio != "" && descuento != "" )
        {
            
            if(parseInt(cantidad) > 0 && parseInt(cantidad) >= parseInt(asignar))
            {
              //alert(""+ cantidad +">"+ asignar);
            subtotal[cont] = ((asignar * precio) + (asignar * precio * 12 / 100) - descuento);
            subtotal[cont] = ConvertToDecimal(subtotal[cont]);
            total = total + subtotal[cont];
            
            var fila = '<tr class="selected" id="fila'+cont+'"><td><button class"btn btn-danger" type"button" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="mcliente_id" value="'+idCli+'"><input type="hidden" name="producto_id[]" value="'+id+'">'+producto+'</td><td><input type="number" name="asignar[]" value="'+asignar+'"></td><td><input type="number" name="precio[]" value="'+precio+'" readonly></td><td><input type="number" name="descuento[]" value="'+descuento+'"></td><td>'+subtotal[cont]+'</td></tr>';
            
            //aumentar el contador
            cont++;
            
            //limpiar los controles
            limpiar(precio);
                                 
            //indicar el subtotal
            $('#total').html('s/. '+total);
            $('#total_venta').val(total);
            //mostrar los botones de guardar y cancelar
            evaluar();
            
            //agregar la fila a la tabla
            $('#detalles').append(fila);
                
            asignar=0;
            cantidad=0;
            precio=0;
                
            }
            else
            {
                alert('La cantidad de ' + cantidad + ' supera el valor de: ' + asignar );
            }
        }
        else
        {
            alert('Error al ingresar la factura, revise los datos del producto');    
        }
        
    }

    function agregarCli(){   
        datosContrato = document.getElementById('pcliente_id').value.split('_');     
        id = datosContrato[1];
        idCli = datosContrato[0];
        contrato = $('#pplan').val();
        capacidad = $('#pcapacidad').val();
        plan_precio = $('#pplan_precio').val();
        descuento1 = $('#pdescuento1').val();
        monto = $('#pmonto').val();
        
        if(id != "" && contrato != "" && monto > 0 && plan_precio != "" && descuento1 != "" )
        {
            
            if(parseInt(monto) > 0 && parseInt(plan_precio) > 0)
            {
              //alert(""+ cantidad +">"+ asignar);
            monto = Number(monto);
            subtotal[cont] = (monto + (monto * 12 / 100) - descuento1);
            subtotal[cont] = ConvertToDecimal(subtotal[cont]);
            total = total + subtotal[cont];
            
            var fila = '<tr class="selected" id="fila'+cont+'"><td><button class"btn btn-danger" type"button" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="mcliente_id" value="'+idCli+'"><input type="hidden" name="plan_id[]" value="'+id+'">'+contrato+'</td><td><input type="number" name="asignar1[]" value="1"></td><td><input type="number" name="precio1[]" value="'+monto+'" readonly></td><td><input type="number" name="descuento1[]" value="'+descuento1+'"></td><td>'+subtotal[cont]+'</td></tr>';
            //aumentar el contador
            cont++;
            
            //limpiar los controles
            limpiarCli(plan_precio);
                                 
            //indicar el subtotal
            $('#total').html('s/. '+total);
            $('#total_venta').val(total);
            //mostrar los botones de guardar y cancelar
            evaluar();
            
            //agregar la fila a la tabla
            $('#detalles').append(fila);
                
            //asignar=0;
            monto=0;
            plan_precio=0;
                
            }
            else
            {
                alert('La monto de ' + monto + ' supera el valor de: ' + plan_precio );
            }
        }
        else
        {
            alert('Error al ingresar la factura, revise los datos del cliente');    
        }
        
    }

    function limpiar(precio){

        $('#pprecio').val(precio);
        $('#pdescuento').val('0');

    }
    
    function limpiarCli(plan_precio){

        $('#pplan_precio').val(plan_precio);
        $('#pdescuento1').val('0');
        
    }
    
    function evaluar(){
        if (total > 0)
        {
            $('#guardar').show();
        }
        else
        {
            $('#guardar').hide();
        }
    }
    
    function eliminar(index){
        total = total- subtotal[index];
        total = ConvertToDecimal(total);
        $('#total').html('s/. '+total);
        $('#total_venta').val(total);
        $('#fila' + index).remove();
        evaluar();
        mostrarValores();
        $('#pdescuento').val('0');

    }
    function ConvertToDecimal(num) {
        num = num.toString(); //If it's not already a String
        num = num.slice(0, (num.indexOf(".")) + 3); //With 3 exposing the hundredths place
        //num = parseFloat(num);
        num = Number(num); //If you need it back as a Number
        return num;    
    }
</script>
<script src="{{ asset('js/buscador-bootstrap.js') }}"></script>
@endpush
@endsection