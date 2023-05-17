<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Redirect;
use App\Planes;
use App\Producto;
use App\Contacto;
use DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Planes comunitarios
        $querry = "BASIC";
        $planes_com = DB::table('planes')->where('nombre','LIKE','%'.$querry.'%')->get();
        //Todos los planes
        $planes = Planes::get();
        $servicios = DB::table('productos')->where('categoria_id','=','2')->get();
        $productos = DB::table('productos')->where('categoria_id','=','1')->get();
        return view('welcome',compact('planes', 'planes_com','servicios','productos'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sobre_nosotros()
    {
        //
        $planes = Planes::get();
        $servicios = DB::table('productos')->where('categoria_id','=','2')->get();
        $productos = DB::table('productos')->where('categoria_id','=','1')->get();
        return view('sobre_nosotros',compact('planes','servicios','productos'));
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function planes()
    {
        //Planes comunitarios
        $querry = "BASIC";
        $planes_com = DB::table('planes')->where('nombre','LIKE','%'.$querry.'%')->get();
        //Todos los planes
        $planes = Planes::get();
        $servicios = DB::table('productos')->where('categoria_id','=','2')->get();
        $productos = DB::table('productos')->where('categoria_id','=','1')->get();
        return view('planes',compact('planes','planes_com','servicios','productos'));
    }
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function servicios()
    {
        //Planes en la vista
        $planes = Planes::get();
        //Servicios en la vista
        $services = DB::table('productos as p') 
        -> join('categorias as c','p.categoria_id','=','c.id')
        -> select('p.id','p.nombre','p.descripcion', 'p.precio','p.imagen')
        -> where ('c.nombre', '=', 'SERVICIOS') -> get();
        $servicios = DB::table('productos')->where('categoria_id','=','2')->get();
        $productos = DB::table('productos')->where('categoria_id','=','1')->get();
        return view('/servicios',compact('planes', 'services','servicios','productos'));
    }
                /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productos()
    {
        //Planes en la vista
        $planes = Planes::get();
        //Servicios en la vista
        $products = DB::table('productos as p') 
        -> join('categorias as c','p.categoria_id','=','c.id')
        -> select('p.id','p.nombre','p.descripcion', 'p.precio','p.imagen')
        -> where ('c.nombre', '=', 'PRODUCTOS') -> get();
        $servicios = DB::table('productos')->where('categoria_id','=','2')->get();
        $productos = DB::table('productos')->where('categoria_id','=','1')->get();
        return view('/productos',compact('planes', 'products','servicios','productos'));
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function promociones()
    {
        //Planes comunitarios
        $querry = "BASIC";
        $planes_com = DB::table('planes')->where('nombre','LIKE','%'.$querry.'%')->get();
        //Todos los planes
        $planes = Planes::get();
        $servicios = DB::table('productos')->where('categoria_id','=','2')->get();
        $productos = DB::table('productos')->where('categoria_id','=','1')->get();
        return view('promociones',compact('planes', 'planes_com','servicios','productos'));
    }
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contacto()
    {
        //Todos los planes
        $planes = Planes::get();
        $servicios = DB::table('productos')->where('categoria_id','=','2')->get();
        $productos = DB::table('productos')->where('categoria_id','=','1')->get();
        return view('contacto',compact('planes','servicios','productos'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contacto_create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contacto_store(Request $request)
    {
        //Establecer la funcion de guardar segun sea el caso
        if($request->has('es_suscripcion')){
            $consulta = Contacto::where('email',$request->email)->first();
            if (!$consulta) {

                $mytime = Carbon::now('America/Guayaquil');
                $updated_at = $mytime -> toDateTimeString();
                $contacto = Contacto::create([
                    'email' => $request->email,
                    'es_suscripcion' => $request->es_suscripcion,
                    'updated_at' => $updated_at
                ]);
                return back()->with('status', '¡Suscripción agregada satisfactoriamene.!');
            }else{
                return back()->with('status', '¡YA ESTA SUSCRITO!');
            }
        }elseif($request->has('es_contacto')){
        $contacto = Contacto::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'celular' => $request->celular,
            'titulo_mensaje' => $request->titulo_mensaje,
            'mensaje' => $request->mensaje,
            'email' => $request->email,
            'es_contacto' => $request->es_contacto
        ]);
        return back()->with('status', '¡Se ha registrado la información satisfactoriamene.!');                    
        }elseif($request->has('es_producto')){
            $contacto = Contacto::create([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'celular' => $request->celular,
                'email' => $request->email,
                'producto_id' => $request->producto_id,
                'es_producto' => $request->es_producto
            ]);
            return back()->with('status', '¡Solicitud enviada satisfactoriamene, en breve le estaremos llamando.!');
        }elseif ($request->has('es_servicio')) {
            # code...
            $contacto = Contacto::create([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'celular' => $request->celular,
                'email' => $request->email,
                'servicio_id' => $request->servicio_id,
                'es_servicio' => $request->es_servicio
            ]);
            return back()->with('status', '¡Solicitud enviada satisfactoriamene, en breve le estaremos llamando.!');
        }
        elseif ($request->has('es_internet')) {
            # code...
            $contacto = Contacto::create([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'celular' => $request->celular,
                'email' => $request->email,
                'plan_id' => $request->plan_id,
                'es_internet' => $request->es_internet
            ]);
            return back()->with('status', '¡Solicitud enviada satisfactoriamene, en breve le estaremos llamando.!');
        }elseif($request->has('es_ayuda')){
            $contacto = Contacto::create([
                'mensaje' => $request->mensaje,
                'celular' => $request->celular,
                'es_ayuda' => $request->es_ayuda
            ]);
            return back()->with('status', '¡Se ha enviado el mensaje satisfactoriamene.!');                    
            }else{
            return back()->with('status', '¡ERROR.!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
