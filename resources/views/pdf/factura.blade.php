<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de venta</title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }
 
        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
        width: 100px; height: 100px;
        }
 
        #imagen{
        width: 200px; height: 120px;
        }
 
        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }
 
        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }
 
        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }
 
        section{
        clear: left;
        }
 
        #cliente{
        text-align: left;
        }
 
        #facliente{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        }
 
        #facliente thead{
        padding: 20px;
        background: #2183E3;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facvendedor thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #facarticulo{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facarticulo thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #gracias{
        text-align: center; 
        }
    </style>
    <body>
        @foreach ($factura as $v)
        <header>
        @foreach($vendedor as $empresa)
            <div id="logo">
                <img src="{{ 'img/'.$empresa->logo }}" alt="{{ $empresa->nombre }}" id="imagen">
            </div>
            <div id="datos">
                <p id="encabezado">
                    <b>{{ $empresa->nombre }}</b><br>   {{ $empresa->direccion }}<br>Teléfono: {{ $empresa->telefono }}<br>Celular: {{ $empresa->celular }}
                </p>
            </div>
            <div id="fact">
                <p>{{$v->tipo_comprobante}}<br>
                {{$v->id}}-{{$v->factura_num}}</p>
            </div>
        @endforeach
        </header>
        <br>
        <section>
            <div>
                <table id="facliente">
                    <thead>                        
                        <tr>
                            <td id="fac">CLIENTE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="cliente">Sr(a). {{$v->nombres}} {{$v->apellidos}}</td>
                        </tr>
                        <tr>
                            <td>Nro. Cédula: {{$v->cedula}}</td>
                        </tr>
                        <tr>
                            <td>Dirección: {{$v->calle_p}} CON {{$v->calle_s}}</td>
                        </tr>
                        <tr>
                            <td>Teléfono: {{$v->telefono}} Celular: {{$v->celular}}</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </section>
        @endforeach
        <br>
        <section>
            <div>
                <table id="facvendedor">
                    <thead>
                        <tr id="fv">
                            <th>VENDEDOR</th>
                            <th>FECHA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        @foreach($vendedor as $vend)
                            <td>{{$vend->cedula}} {{$vend->nombres}} {{$vend->apellidos}}</td>
                            <td>{{$vend->fecha_hora}}</td>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <section>
            <div>
                <table id="facarticulo">
                    <thead>
                        <tr id="fa">
                            <th>CANT</th>
                            <th>DESCRIPCION</th>
                            <th>PRECIO UNIT</th>
                            <th>DESC.</th>
                            <th>PRECIO TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $det)
                        <tr>
                            <td>{{$det->cantidad}}</td>
                            <td>{{$det->producto}}</td>
                            <td>{{$det->precio}}</td>
                            <td>{{$det->descuento}}</td>
                            <td>{{$det->cantidad*$det->precio-$det->descuento}}</td>
                        </tr>
                        @endforeach
                        @foreach ($planes as $plan)
                        <tr>
                            <td>{{$plan->cantidad}}</td>
                            <td>{{$plan->plan}}</td>
                            <td>{{$plan->precio}}</td>
                            <td>{{$plan->descuento}}</td>
                            <td>{{$plan->precio-$plan->descuento}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        @foreach ($factura as $v)
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>SUBTOTAL</th>
                            <td>$ {{ round($v->total - ($v->total - ($v->total*$v->impuesto/100)) * ($v->impuesto/100),2) }}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Impuesto</th>
                            <td>$ {{ round (($v->total - ($v->total*$v->impuesto/100)) * ($v->impuesto/100),2) }}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>TOTAL</th>
                            <td>$ {{$v->total}}</td>
                        </tr>
                        @endforeach
                    </tfoot>
                </table>
            </div>
        </section>
        <br>
        <br>
        <footer>
            <div id="gracias">
                <p><b>Gracias por su confianza...</b></p>
            </div>
        </footer>
    </body>
</html>