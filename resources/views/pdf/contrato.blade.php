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
        width: 55px; height: 100px;
        }
 
        #imagen{
        width: 200px; height: 120px;
        }
 
        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        text-align: justify;
        width: auto; height: 100px;
        }
 
        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 25%;
        font-size: 15px;
        }
 
        #fact{
        position: relative;
        float: left;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        width: auto; height: 100px;
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
        @foreach ($contrato as $v)
        @foreach($empresas as $emp)
        <header>
        @foreach($empresas as $empresa)
            <div  id="logo">
                <img src="{{ 'img/'.$empresa->logo }}" alt="{{ $empresa->nombre }}" id="imagen">
            </div>
        @endforeach
            <div id="datos">
                <p id="encabezado">
                   CONTRATO DE SERVICIO <br>
                   INTERNET
                </p>
            </div>
            <div id="fact">
                {{$v->contrato_num}}-{{$v->id}}
                {!! $code->getBarcodeHTML($v->contrato_num, "EAN13") !!}
                
            </div>

        </header>

        <section>
            <div>
            <table width="100%"  cellspacing="0" cellpadding="0">
        <tr>
          <td><div ><span class="titulo_contrato">CONTRATO</span><br /><br />
            <span class="subtitulo">Términos y condiciones </span></div></br></td>
        </tr>
      </table>
      <p align="justify">Mediante el presente documento, se celebra el siguiente CONTRATO, por una  parte 
      &ldquo;{{$emp->nombre}} &rdquo; Internet Service Provider, con número de RUC: {{$emp->ruc}}. y por otra parte el/la  SR/A: <span class="Resaltado">
      &ldquo; {{ $v->nombres }} {{ $v->apellidos }}&rdquo; </span> Identificado con cedula/RUC. <span class="Resaltado">
      &ldquo; {{$v->cedula}}&rdquo; </span>y Domiciliado/a en:<span class="Resaltado"> 
      &ldquo; {{$v->calle_p}} {{$v->calle_s}} {{$v->direccion}}&rdquo; </span>a quien en adelante  se le denominara  
      &ldquo;El Cliente&rdquo; , bajo los siguientes Terminos y Condiciones, que se detallan a continuación. </p>
     <table>    
      <tr>
        <td ><div align="center"><span class="titulo_contrato">CONDICIONES PARTICULARES </div></span>
        </td>
      </tr> 

 <tr>
  
    <td >
	<h4>CONTRATACIÓN DEL SERVICIO</h4>
	<p align="justify" class="MsoNormal">1: {{$emp->nombre}}, presta servicio de Internet Inalámbrico y por Fibra Óptica a domicilio en las zonas de cobertura del servidor. <br />
    </br>
   </p>
	<p align="justify" class="MsoNormal">2: El costo de instalación para la activación del servicio es de 30.00 dólares, los cuales sera pagada en fecha <span class="Resaltado">&quot; {{ \Jenssegers\Date\Date::parse($v->fecha_inicio)->format('j F, Y') }} &quot;</span>. En caso de requerir la instalación de un Router inalámbrico (wifi), tendrá un costo adicional de $ 20.00 dólares, los cuales se pagarán de contado, y el equipo pasa a ser propiedad del cliente. <br />
    </br>
	</p>
	<p align="justify" class="MsoNormal">3: Luego de la contratación pasarán máximo 2 días para que se proceda con la instalación del servicio. <br />
</br>   
    </p>
    @foreach($equipos as $equipo)
        @if($v->producto_id == $equipo->id)
	        <p align="justify" class="MsoNormal">4: {{$emp->nombre}}, instalara un POE y una ANTENA (<span class="Resaltado">&quot; Marca: {{$equipo->marca}} Modelo: {{$equipo->modelo}} MAC: {{$equipo->codigo}} &quot;</span>), de propiedad de {{$emp->nombre}}, con señal y velocidad contratada, realizando pruebas técnicas en presencia del cliente. <br />
        @endif
    @endforeach
    </br>
	</p>
	<p align="justify" class="MsoNormal">5: Al momento de la instalación el cliente debe prestar corriente eléctrica y un computador o celular inteligente para realizar las pruebas necesarias.<br />
    </br>
	</p>
	<h4>PRESTACIÓN DEL SERVICIO</h4></br>
	<p align="justify" class="MsoNormal">1: &ldquo;{{$emp->nombre}}&rdquo; Internet Service  Provider, pone a disposición sus servicios  siempre  y cuando se respeten las normas  de uso de los servicios que en este contrato rigen.<br />
        <br />
      </p>
	<p align="justify" class="MsoNormal">2: {{$emp->nombre}}, presta servicio de Internet Inalámbrico o por Fibra Óptica según su contrato  <span class="Resaltado">&quot; </span> y este tiene un costo de <span class="Resaltado">&ldquo; {{$v->precio}} $ 
	

 Dólares + IVA &rdquo;</span> los cuales se deberá pagar mensualmente hasta el <span class="Resaltado">&quot;dia {{ \Jenssegers\Date\Date::parse($v->fecha_inicio)->format('j') }}&quot;</span>.<br />
      <br />
    </p>
      
      <p align="justify" class="MsoNormal">3: El servicio es válido para una serie de dispositivos según su capacidad en megas y según las estadísticas de navegación lo recomendado es de 1 (un) Mega por dispositivo para un óptimo funcionamiento<br />
        <br />
      </p>
      <p align="justify" class="MsoNormal">4: En este Documento se da a conocer que el servicio cuenta  con una velocidad máxima de {{$v->capacidad}} Megas con compartición 6:1 también es necesario dar a conocer que la  velocidad del servicio puede variar dependiendo de la cantidad de trafico  existente  en un determinado momento  dentro y fuera de nuestras instalaciones.<br />
        <br />
      </p>
      </td>
      </tr>
      <tr>
      <td>
      <p align="justify" class="MsoNormal">5: En caso de tener inconvenientes con el servicio llamar a los números  {{$emp->telefono}} {{$emp->celular}}, mismos que están en funcionamiento de 8:00 AM a 21:00 PM de lunes a viernes y los sábados de 8:00 AM a 13:00 PM.<br />
        <br />
      </p>
	  <p align="justify" class="MsoNormal">6: {{$emp->nombre}}, no se responzabiliza por virus y programas descargados mediante Internet.<br />
      <br />
	  </p>
	  <p align="justify" class="MsoNormal">7: {{$emp->nombre}}, no se responzabiliza del mal uso de los equipos instalados y el cliente deberá cancelar el valor de las reparaciones esto sin afectar el servicio prestado por {{$emp->nombre}}.<br />
      <br />
	  </p>
	  <p align="justify" class="MsoNormal">8: El pago de servicio se realizará en nuestros locales, con depósito o transferencia en la cuenta de Ahorro del <span class="Resaltado"> Banco Pichincha 2204087023 </span> a nombre de <span class="Resaltado">Franklin Santiago Martínez</span> y llamar a confirmar el número de comprobante a los números {{$emp->telefono}} {{$emp->celular}}.<br />
      <br />
	  </p>
	   <p align="justify" class="MsoNormal">9: En caso de impago y suspensión del servicio el cliente tiene 15 días más para cancelar sin recargos, apartir de esta fecha tendrá un costo adicional por reactivación del servicio.<br />
      <br />
	  </p>
	  <p align="justify" class="MsoNormal">10: <span class="Resaltado">{{$emp->nombre}}  no se responsabiliza por los días de suspensión del servicio por impago de los valores pactados.</span><br />
      <br />
	  </p>
	  <h4>CANCELACIÓN Y TERMINO DE SERVICIO</h4></br>
      <p align="justify" class="MsoNormal">1: Para la cancelación del servicio debe de ser solicitada con un  mes de anticipación, no será valida una solicitud al momento,  la solicitud podrá ser  presentada vía telefónica o de forma personal, y no tener valores pendientes por servicios.<br />
        <br />
      </p>
	  <p align="justify" class="MsoNormal">2: {{$emp->nombre}} podra dar por terminado la prestación del servicio en caso de recurrencia en daños de equipos por mala manipulación o mal uso.<br />
        <br />
		 </p>
	  <p align="justify" class="MsoNormal">{{$emp->nombre}} podra modificar con o sin previo aviso los terminos que se detallarón en el presente contrato.<br />
        <br />
      </p>
      <p align="justify" class="MsoNormal">La firma del cliente en este documento, indica la aceptación de los términos y condiciones que rigen en el momento del contrato.<br /> <br /></p></td>
 </tr>

 <tr>
    <td height="93" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><span class="MsoNormal">Muchas gracias por preferir nuestros servicios {{$emp->nombre}} – Internet Inalámbrico y por Fibra Óptica</span></td>
      </tr>
      </table></td>
  </tr>

  </table>   
            
            </div>
        </section>
        <br>

        <footer>
            <div id="gracias">
            <table>
            <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td  align="center" valign="top">____________________________________</td>
        <td align="center" valign="top">&nbsp;</td>
        <td  align="center" valign="top">____________________________________</td>
      </tr>
      <tr>
      <td height="47" align="center" valign="top"><div align="center" class="fecha">{{$v->nombres}} {{$v->apellidos}}<br />
      C.C/RUC. {{$v->cedula}} <span class="Resaltado"><br />
          </span></div></td>
        <td align="center" valign="bottom">&nbsp;</td>
        <td align="center" valign="top">FRANKLIN SANTIAGO MARTÍNEZ <br />C.C/RUC. 1712627213</td>
      </tr>

      <tr>
        <td align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top"><div align="center" class="fecha">
        </div>
          <span class="fecha"> En fecha: {{ \Jenssegers\Date\Date::parse($hoy)->format('j F, Y') }}</span></td>
        <td align="center" valign="top">&nbsp;</td>
      </tr>
      </table>
            </div>
        </footer>
        @endforeach
        @endforeach
    </body>
</html>