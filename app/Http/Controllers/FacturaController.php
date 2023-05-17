<?php

namespace App\Http\Controllers;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use App\Producto; 
use App\Factura;
use App\Contrato;
use App\Plane;
use App\Empresa;
use App\Enlace;
use App\FacturaProducto;
use Carbon\Carbon;
use App\User;
use Cookie;
use DB;
use PDF;
//Mikrotik
use PEAR2\Net\RouterOS;
use PEAR2\Net\RouterOS\Client;
use JonnyW\PhantomJs\DependencyInjection\ServiceContainer;
use RouterosAPI;
//Sales
use App\Http\Requests\FacturaFormRequest;
use \Auth, \Redirect, \Validator, \Input, \Session;
use App\Http\Requests;

//use Illuminate\Support\Facades\Redirect;
//use Illuminate\Support\Facades\Input;

use Response;
use Illuminate\Support\Collection;

class FacturaController extends Controller
{
    //contructor
    public function __construct()
    {
        $this -> middleware('auth');
    }
    //index 
    public function index(Request $request)
    {
      if($request)
      {
        //almacenar la busqueda 
        $querry =  trim ($request -> get('searchText'));
        //obtener las categorias
        $facturas = DB::table('facturas as f') 
        -> join('users as u','f.cliente_id','=','u.id')
        -> join('factura_producto as fp','f.id','=','fp.factura_id')
        -> select('f.id', 'f.cliente_id','f.fecha_hora', 'u.nombres', 'u.apellidos', 'f.tipo_comprobante', 'f.factura_num', 'f.impuesto', 'f.esta_paga', 'f.total')
        -> where('f.factura_num','LIKE','%'.$querry.'%')
        -> where('f.esta_paga','=','SI')        
        -> orderBy('f.fecha_hora', 'DESC')
        -> groupBy('f.id', 'f.fecha_hora', 'u.nombres', 'u.apellidos', 'f.tipo_comprobante', 'f.factura_num', 'f.impuesto', 'f.esta_paga')
        -> paginate(7);
        
        return view('facturas.index', ["facturas" => $facturas, "searchText" => $querry]);
      }
    }

       //create (mostra la vista de crear)
       public function create()
       {
         $factura_num = time();
         $clientes = DB::table('contratos as c') 
         -> join('planes as p','c.plan_id','=','p.id')
         -> join('users as cli','c.user_id','=','cli.id')    
         -> select('cli.id', 'cli.nombres', 'cli.apellidos','cli.cedula','p.id as id_plan','p.nombre','p.capacidad','p.precio')
         -> get();
         
         $productos = DB::table('productos as pro')      
         -> select(DB::raw('CONCAT (pro.id, " - " ,pro.nombre) as  producto'), 'pro.id', 'pro.cantidad', 'pro.precio')
         -> where ('pro.condicion', '=', '1')
         -> where ('pro.cantidad' , '>', '0')
         -> get();


         return view('facturas.create', ['clientes' => $clientes, 'productos' => $productos,
         'factura_num' => $factura_num ]);
       }
   
       
   
       //store(insertar un registro)
       public function store(FacturaFormRequest $request)
       {     
        try {

          DB::beginTransaction();  

           $factura = new Factura; 
           $factura -> cliente_id = $request -> get('mcliente_id');//este valor es el que se encuentra en el el sub-formulario oculto en javascript
           $factura -> user_id = '1';
           $factura -> empresa_id = '1';
           $factura -> factura_num = $request -> get('factura_num');
           $factura -> tipo_comprobante = $request -> get('tipo_comprobante');
           $mytime = Carbon::now('America/Guayaquil');
           $factura -> fecha_hora = $mytime -> toDateTimeString();
           $factura -> impuesto = 12;
           $factura -> total = $request -> get('total_venta');
           $factura -> esta_paga = 'SI';   
           $factura -> save();
   
           $producto_id  = $request -> get('producto_id');
           $cantidad = $request -> get('asignar');
           $descuento = $request -> get('descuento');
           $precio = $request -> get('precio');
   
           $cont=0;
           if($producto_id){
           while($cont < count ($producto_id)){
            //Debitar stock de productos
               $producto =  Producto::findOrFail($producto_id[$cont]);
               $producto -> cantidad = $producto->cantidad - $cantidad[$cont];
               $producto -> update();  
            //Agregar relacion a factura_productos
               $detalle = new FacturaProducto();
               $detalle -> producto_id = $producto_id[$cont];
               $detalle -> factura_id = $factura -> id;
               $detalle -> descuento = $descuento[$cont];
               $detalle -> cantidad = $cantidad[$cont];
               $detalle -> precio = $precio[$cont];
               $detalle -> save(); 

               $cont = $cont+1;
           }
          }
//Insertar la relacion con planes
               $plan_id  = $request -> get('plan_id');
               $cantidad1 = $request -> get('asignar1');
               $descuento1 = $request -> get('descuento1');
               $precio1 = $request -> get('precio1');
       
               $cont=0;
               if($plan_id){
                  while($cont < count ($plan_id)){
          
                      $detalle = new FacturaProducto();
                      $detalle -> plan_id = $plan_id[$cont];
                      $detalle -> factura_id = $factura -> id;
                      $detalle -> descuento = $descuento1[$cont];
                      $detalle -> cantidad = $cantidad1[$cont];
                      $detalle -> precio = $precio1[$cont];
                      $detalle -> save();
                      
                      $cont = $cont+1;
                  }
               }
          //Conexion al Mikrotik y habilitar o desabilitar clientes
          //Guardar datos en el Mikrotik
          $enlace = DB::table('enlaces')->where('user_id',$request->mcliente_id)->first();
          //Cambiar estado a SI (activado)
          if($enlace->activo == "NO"){
              $util = new RouterOS\Util(
              $client = new RouterOS\Client(env('ROSIPADDRESS'),env('ROSUSERNAME'), env('ROSPASSWORD'))
              );
              $util->setMenu('/ip arp');
              $util->enable(RouterOS\Query::where('address', $enlace->ip));
              $util->enable(1);
          }
          $enl =  Enlace::findOrFail($enlace->id);
              $enl -> activo = "SI";
          $enl -> update();

           DB::commit();
           return Redirect::to('facturas/index');
          } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('facturas.create')->withStatus(__('ERROR al registrar en sistema.'));

          }
          //return redirect()->route('facturas.index')->withStatus(__('danger', 'Factura ' . $factura->factura_num . ' Agregada'));
       }
    //show
    public function show ($id){

    	$factura = DB::table('facturas as f') 
        -> join('users as u','f.cliente_id','=','u.id')
        -> join('factura_producto as fp','f.id','=','fp.factura_id')
        -> select('f.id', 'f.fecha_hora', 'u.nombres', 'u.apellidos', 'f.tipo_comprobante', 'f.factura_num', 'f.impuesto', 'f.esta_paga', 'f.total')
        -> where ('f.id','=', $id)
        -> first();
      
        $detalles = DB::table('factura_producto as d') 
         -> join('productos as a','d.producto_id','=','a.id')
         -> select('a.nombre as producto', 'd.cantidad', 'd.descuento', 'd.precio')
         -> where ('d.factura_id', '=', $id) -> get();

        $detalles_plan = DB::table('factura_producto as d') 
         -> join('planes as a','d.plan_id','=','a.id')
         -> select('a.nombre as plan', 'd.cantidad', 'd.descuento', 'd.precio')
         -> where ('d.factura_id', '=', $id)
         -> get();

        $planes = DB::table('factura_producto as d') 
         -> join('planes as a','d.plan_id','=','a.id')
         -> select('a.nombre as plan', 'd.cantidad', 'd.descuento', 'd.precio')
         -> where ('d.factura_id', '=', $id) -> get();


         return view('facturas.show', ['factura' => $factura, 'detalles' => $detalles, 'detalles_plan' => $detalles_plan, 'planes' => $planes]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pdf(Request $request,$id){
      $factura = Factura::join('users','facturas.cliente_id','=','users.id')
      ->select('facturas.id','facturas.tipo_comprobante',
      'facturas.factura_num','facturas.created_at','facturas.impuesto','facturas.total',
      'facturas.esta_paga','users.nombres','users.apellidos','users.cedula',
      'users.calle_p','users.calle_s','users.celular',
      'users.telefono','users.email')
      ->where('facturas.id','=',$id)
      ->orderBy('facturas.id','desc')->take(1)->get();

      //CONSULTA DE VENDEDOR
      $vendedor = Factura::join('users','facturas.user_id','=','users.id')
      ->join('empresas as e','facturas.empresa_id','=','e.id')
      ->select('users.nombres','users.apellidos','users.cedula','facturas.fecha_hora','e.nombre','e.ruc','e.telefono',
      'e.celular','e.direccion','e.descripcion','e.logo')
      ->where('facturas.id','=',$id)
      ->orderBy('facturas.id','desc')->take(1)->get();

      $detalles = FacturaProducto::join('productos','factura_producto.producto_id','=','productos.id')
      ->select('factura_producto.cantidad','factura_producto.precio','factura_producto.descuento',
      'productos.nombre as producto')
      ->where('factura_producto.factura_id','=',$id)
      ->orderBy('factura_producto.id','desc')->get();

      $planes = FacturaProducto::join('planes','factura_producto.plan_id','=','planes.id')
      ->select('factura_producto.cantidad','factura_producto.precio','factura_producto.descuento',
      'planes.nombre as plan')
      ->where('factura_producto.factura_id','=',$id)
      ->orderBy('factura_producto.id','desc')->get();


      $numventa=Factura::select('factura_num')->where('id',$id)->get();

      $pdf = \PDF::loadView('/pdf/factura',['factura'=>$factura,'vendedor'=>$vendedor,'detalles'=>$detalles, 'planes'=>$planes]);
      return $pdf->download('factura-'.$numventa[0]->factura_num.'.pdf');
      //return view('/pdf.factura', ['factura' => $factura, 'detalles' => $detalles]);

  }

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      try {
        DB::beginTransaction(); 
          //Conexion al Mikrotik y habilitar o desabilitar clientes
          //Guardar datos en el Mikrotik
          $factura =  Factura::findOrFail($id);
          $enlace = DB::table('enlaces')->where('user_id',$factura->cliente_id)->first();
          //Cambiar estado a SI (activado)
          if($enlace->activo == "SI"){
              $util = new RouterOS\Util(
              $client = new RouterOS\Client(env('ROSIPADDRESS'),env('ROSUSERNAME'), env('ROSPASSWORD'))
              );
              $util->setMenu('/ip arp');
              $util->disable(RouterOS\Query::where('address', $enlace->ip));
              $util->enable(1);
          }
          //Actualizar tabla de enlaces
          $enl =  Enlace::findOrFail($enlace->id);
          $enl -> activo = "NO";
          $enl -> update();

        $factura =  Factura::findOrFail($id);
        $factura -> esta_paga = "NO";
        $factura -> total = 0; 
        $factura -> update();

        //Contamos los indices de facturas asociados a productos
        $contar = DB::table('facturas as f') 
          -> join('factura_producto as fp','f.id','=','fp.factura_id')
          -> select('f.id', 'fp.cantidad')
          -> where ('f.id','=', $id)
          -> count();
        //Recibimos la cantidad de productos asociada a la factura
        $productos = DB::table('factura_producto as d') 
        -> join('productos as a','d.producto_id','=','a.id')
        -> select('a.id','d.cantidad','a.cantidad as cant')
        -> where ('d.factura_id', '=', $id) -> get();

        foreach($productos as $product) {
              $asignar = (int)$product->cant + (int)$product->cantidad;
              $producto =  Producto::findOrFail($product->id);
              $producto -> cantidad = $asignar; 
              $producto -> update();     
        }

        DB::commit();

      } catch (\Exception $e) {
        return redirect()->route('facturas.index')->withStatus(__('ERROR al registrar en sistema.'));
        DB::rollback();
      }
      return Redirect::to('facturas/index');      


    }


}
