<?php

namespace App\Http\Controllers;
use App\Nodo;
use App\Producto;
use App\Enlace;
use App\User;
use App\Planes;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\EnlaceRequest;
use PEAR2\Net\RouterOS;
use PEAR2\Net\RouterOS\Client;
use JonnyW\PhantomJs\DependencyInjection\ServiceContainer;
use RouterosAPI;


class EnlaceController extends Controller
{
//Constructor del Mikrotik para establecer coneccion
    function __construct() {
        $this->client = new RouterOS\Util(
            $client = new RouterOS\Client(env('ROSIPADDRESS'),env('ROSUSERNAME'), env('ROSPASSWORD'))
        );
    }
    
    /**
     * Display a listing of the enlaces
     *
     * @param  \App\Enlace  $model
     * @return \Illuminate\View\View
     */
    public function index(Enlace $model)
    {
        $enlaces = Enlace::get();
        $usuarios = User::get();
        $nodos = Nodo::get();
        $equipos = Producto::get();

        return view('enlaces.index', compact('enlaces','usuarios','nodos','equipos'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        //Clientes contratos
        $usuarios = DB::table('users as u') 
        -> join('contratos as c','c.user_id','=','u.id')
        ->select('u.id','u.nombres','u.apellidos','u.cedula')
        -> get();

        $nodos = Nodo::get();
        //Productos a listar para router
        $querry =  trim ('ROUTER');
        $equipos = Producto::where('cantidad','>','0')
        ->where('nombre','LIKE','%'.$querry.'%')
        ->where('categoria_id','<>','2')->get();
        //Productos a listar para antena
        $querry1 =  trim ('ANTENA');
        $equipos1 = Producto::where('cantidad','>','0')
        ->where('nombre','LIKE','%'.$querry1.'%')
        ->where('categoria_id','<>','2')->get();
        return view('enlaces.create', compact('usuarios','nodos','equipos','equipos1'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(EnlaceRequest $request)
    {
        try{
         DB::beginTransaction();
        //Registro de enlave y validaciones
        $enlace = Enlace::create([
            'user_id' => $request->user_id,
            'producto_id' => $request->producto_id,
            'router_id' => $request->router_id,
            'nodo_id' => $request->nodo_id,
            'ip' => $request->ip,
            'mac' => $request->mac,
            'coordenadas' => $request->coordenadas,
            'activo' => $request->activo,
            'imagen' => $request->imagen,
        ]);
        //Modificar tabla de productos para cambiar estatus de asignado
        if($request->producto_id || $request->router_id){
         //Cambiar estatus de producto_id
            $producto =  Producto::findOrFail($request->producto_id);
            $producto -> categoria_id = 3;
            $producto -> asignado = 1;
            $producto -> cantidad = $producto -> cantidad - 1;
            $producto -> update();
            //Cambiar estatus de producto_id
            $router =  Producto::findOrFail($request->router_id);
            $router -> categoria_id = 3;
            $producto -> asignado = 1;
            $router -> cantidad = $router -> cantidad - 1;
            $router -> update();  
        }
         //Guardar datos en el Mikrotik en IP ARP
         $cliente = DB::table('users')->where('id', $request->user_id)->first();

         $this->client->setMenu('/ip arp');
         $this->client->add(
             array(
                 'address' => $request->ip,
                 'mac-address' => $request->mac,
                 'interface' => 'bridge1',
                 'comment' => $cliente->cedula." ".$cliente->nombres." ".$cliente->apellidos
             )
         );
         //Consultar planes
         $planes = DB::table('planes as p')
         -> join('contratos as c','p.id','=','c.plan_id')
         -> select('p.id','p.nombre','p.capacidad')
         -> where ('c.user_id', '=', $request->user_id) -> first(); 
         $calcular=$planes->capacidad*1000000;
         $texto_largo=$cliente->cedula." ".$cliente->nombres." ".$cliente->apellidos;
         $texto_unir = str_replace(" ", "_", $texto_largo);
        //Guardar datos en el Mikrotik en QUEUE
        if( $request->ip !="" ){
            $this->client->setMenu('/queue/simple');
            $id = $this->client->add(array(
                'name' => $texto_unir,
                'max-limit' => $calcular.'/'.$calcular,
                'disabled' => 'no',
                'target' => $request->ip,
                'comment' => $texto_largo
            ));
        }
        //Hacer commit al try catch
        DB::commit();
         return redirect()->route('enlaces.index', $enlace->id)
         ->withStatus(__('Enlace guardado satisfactoriamene.'));
        }catch(Exception $e){
        return redirect()->back()->with(['Error' => $e->getMessage()]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Enlace  $enlace
     * @return \Illuminate\Http\Response
     */
    public function show(Enlace $enlace)
    {
        $productos = Producto::get();
        return view('enlaces.show', compact('enlace','productos'));
    }

    /**
     * Show the form for editing the specified user
     * @param  \App\Enlace  $model
     * @return \Illuminate\Http\Response
     * @return \Illuminate\View\View
     */
    public function edit(Enlace $enlace)
    {
        //Clientes contratos
        $usuarios = DB::table('users as u') 
        -> join('contratos as c','c.user_id','=','u.id')
        ->select('u.id','u.nombres','u.apellidos','u.cedula')
        -> get();
        //Obtener los nodos
        $nodos = Nodo::get();
        //Obtener los productos
        $equipos = Producto::where('asignado','=','0')->where('cantidad','>','0')
        ->where('categoria_id','<>','2')->get();
        //Obtener roter
        $router = Producto::where('id','=',$enlace->router_id)->first();
        return view('enlaces.edit', compact('enlace','usuarios','nodos','equipos','router'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enlace  $enlace
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EnlaceRequest $request, Enlace $enlace)
    {
        try{
            DB::beginTransaction();
            //Actualizar productos para modificar
            $enl = Enlace::findOrFail($enlace->id);
            if ($enl->producto_id != $request->producto_id) {
                //Consulta 1
                $producto =  Producto::findOrFail($request->producto_id);
                $producto -> asignado = 1;
                $producto -> cantidad = $producto -> cantidad - 1;
                $producto -> update();
                //Consulta 1
                $producto1 =  Producto::findOrFail($enl->producto_id);
                $producto1 -> asignado = 0;
                $producto1 -> cantidad = $producto1 -> cantidad + 1;
                $producto1 -> update();
            }
            //Actualizar productos para modificar router
            if ($enl->router_id != $request->router_id) {
                //Consulta 1
                $producto2 =  Producto::findOrFail($request->router_id);
                $producto2 -> asignado = 1;
                $producto2 -> cantidad = $producto2 -> cantidad - 1;
                $producto2 -> update();
                //Consulta 1
                $producto3 =  Producto::findOrFail($enl->router_id);
                $producto3 -> asignado = 0;
                $producto3 -> cantidad = $producto3 -> cantidad + 1;
                $producto3 -> update();
            }
           //Registro de enlave y validaciones
            $enlace = Enlace::find($enlace->id);
               $enlace->user_id = $request->user_id;
               $enlace->producto_id = $request->producto_id;
               $enlace->router_id = $request->router_id;
               $enlace->nodo_id = $request->nodo_id;
               $enlace->ip = $request->ip;
               $enlace->mac = $request->mac;
               $enlace->coordenadas = $request->coordenadas;
               $enlace->activo = $request->activo;
               $enlace->imagen = $request->imagen;
            $enlace->save(); 
            //Guardar datos en el Mikrotik
            $cliente = DB::table('users')->where('id', $request->user_id)->first();
            //Variable a consultar
            $response = $enlace->cedula." ".$enlace->nombres." ".$enlace->apellidos;
            //Consulta de IP a validar y actualizar  datos
            $this->client->setMenu('/ip arp');
            $this->client->set(
                $this->client->find(
                    0,
                    function ($response) {
                        //Matches any item with a comment that starts with two digits
                        return preg_match('/^\d\d/', $response->getProperty('comment'));
                    }
                ),
                array(
                    'address' => $request->ip,
                    'mac-address' => $request->mac,
                    'interface' => 'bridge1',
                    'comment' => $cliente->cedula." ".$cliente->nombres." ".$cliente->apellidos
                )
            );
           //Registro del enlace
           //$enlace = Enlace::create($request->all());
           DB::commit();
            return redirect()->route('enlaces.index', $enlace->id)
            ->withStatus(__('Enlace actualizado satisfactoriamene.'));
           }catch(Exception $e){
           return redirect()->back()->with(['Error' => $e->getMessage()]);
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enlace  $enlace
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Enlace $enlace)
    {
        try{
        DB::beginTransaction();
        //Eliminar del Mikrotik
        $this->client->setMenu('/ip arp');
        $this->client->remove(RouterOS\Query::where('address', $enlace->ip));
        $this->client->enable(1);
        //Eliminar datos en el Mikrotik del QUEUE
        //$a_string = (string)$enlace->cedula;
        $cliente = User::findOrFail($enlace->user_id);
        $texto_largo = $cliente->cedula.' '.$cliente->nombres.' '.$cliente->apellidos;
        $texto_unir = str_replace(" ", "_", $texto_largo);
        $this->client->setMenu('/queue simple')->remove($texto_unir);
        //Eliminar productos para modificar
        $producto =  Producto::findOrFail($enlace->producto_id);
        $producto -> asignado = 0;
        $producto -> cantidad = $producto -> cantidad + 1;
        $producto -> update();
        //Eliminar router para modificar
        $router =  Producto::findOrFail($enlace->router_id);
        $router -> asignado = 0;
        $router -> cantidad = $router -> cantidad + 1;
        $router -> update();
        //Eliminar enlace
        $enlace->delete();
        DB::commit();
        return redirect()->route('enlaces.index', $enlace->id)
        ->withStatus(__('Enlace eliminado satisfactoriamene.'));
       }catch(Exception $e){
       return redirect()->back()->with(['Error' => $e->getMessage()]);
       }
    }

//Activa o desactiva enlace de cliente
    public function activa_desactiva(Request $request, Enlace $enlace)
    {
        try{
            DB::beginTransaction();
        //Conexion al Mikrotik y habilitar o desabilitar clientes
        if($enlace->activo == "NO"){
            $this->client->setMenu('/ip arp');
            $this->client->enable(RouterOS\Query::where('address', $enlace->ip));
            $this->client->enable(1);
            //$this->client->disconnect();
        }elseif($enlace->activo == "SI"){
            $this->client->setMenu('/ip arp');
            $this->client->disable(RouterOS\Query::where('address', $enlace->ip));
            $this->client->enable(1);
            //$this->client->disconnect();
        }else{
            return redirect()->route('enlaces.index', $enlace->id)->withStatus(__('ERROR.'));
        }
                
        $enlace =  Enlace::findOrFail($enlace->id);
        if($enlace -> activo == "SI"){
            $enlace -> activo = "NO";
        }else{
            $enlace -> activo = "SI";
        }
        $enlace -> update();
        DB::commit();
        return redirect()->route('enlaces.index', $enlace->id)
        ->withStatus(__('Enlace actualizado satisfactoriamene.'));
       }catch(Exception $e){
       return redirect()->back()->with(['Error' => $e->getMessage()]);
       }    
    }

}
