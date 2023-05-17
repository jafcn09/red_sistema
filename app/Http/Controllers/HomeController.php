<?php

namespace App\Http\Controllers;
use App\User;
use App\RoleUser;
use App\Producto;
use App\Planes;
use App\Contrato;
use App\Contacto;
use Carbon\Carbon;
use App\Tarea;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //Consulta cantidad de clientes
        $clientes_cont = DB::table('users as u') 
        -> join('role_user as ru','ru.user_id','=','u.id')
        -> join('roles as r','ru.role_id','=','r.id')
        -> where ('r.name','=', 'CLIENTE')
        -> count();
        //Clientes datos
        $clientes = DB::table('users as u') 
        -> join('role_user as ru','ru.user_id','=','u.id')
        -> join('roles as r','ru.role_id','=','r.id')
        ->select('u.id','u.nombres','u.apellidos')
        -> where ('r.name','=', 'CLIENTE')
        -> get();
        //Otras consultas
        $planes = DB::table('planes')->count();
        $productos = DB::table('productos')->count();
        $contratos = DB::table('contratos')->count();
        //Facturas cantidad
        $facturas = DB::table('facturas as f') 
        -> where ('f.esta_paga','=', 'SI')
        -> count();
        //Facturas fecha
        if($facturas > 0){
            $fecha_fac = DB::table('facturas as f') 
            -> select('f.updated_at')
            -> where ('f.esta_paga','=', 'SI')
            -> orderBy('f.updated_at', 'DESC')
            -> first();
        }else{
            $fecha_fac=null;
        }
        // Listado de empleados de la empresa
        $empleados = DB::table('users as u') 
        -> join('role_user as ru','ru.user_id','=','u.id')
        -> join('roles as r','ru.role_id','=','r.id')
        -> select('u.cedula', 'u.nombres','u.apellidos','u.total_salario','u.esta_activo')
        -> where ('r.name','=', 'Empleado')
        -> get();
        //Contar empleados
        $empleados_cont = DB::table('users as u') 
        -> join('role_user as ru','ru.user_id','=','u.id')
        -> join('roles as r','ru.role_id','=','r.id')
        -> where ('r.name','=', 'Empleado')
        -> count();
        //Consulta de ultima fecha de  registro
        $fecha = DB::table('users as u') 
        -> join('role_user as ru','ru.user_id','=','u.id')
        -> join('roles as r','ru.role_id','=','r.id')
        -> select('u.updated_at')
        -> where ('r.name','=', 'EMPLEADO')
        -> orderBy('u.updated_at', 'ASC')
        -> first();
       //Consulta cantidad de suscriptores
       $suscriptores = DB::table('contacto as c') 
       -> where ('c.es_suscripcion','=', '1')
       -> count();
       //Consulta de suscriptores
       if($suscriptores > 0){
            $fecha_sus = DB::table('contacto as c') 
            -> select('c.updated_at')
            -> where ('c.es_suscripcion','=', '1')
            -> orderBy('c.updated_at', 'DESC')
            -> first();
        }else{
            $suscriptores=null;
			$fecha_sus = 0;
        }
       //Consulta cantidad de tareas
       $task = DB::table('tareas as t') 
       -> where ('t.estatus','=', 'COMPLETADA')
       -> count();
       //Consulta de tareas
       if($task > 0){
            $fecha_tas = DB::table('tareas as t') 
            -> select('t.updated_at')
            -> where ('t.estatus','=', 'COMPLETADA')
            -> orderBy('t.updated_at', 'ASC')
            -> first();
       }else{
            $fecha_tas=null;
       }
       //Contar tabla de tareas
       $cont_tareas = DB::table('tareas as t') 
       -> where ('t.esta_activo','=', 'SI')
       -> count();
       //COnsultar tareas
       if($cont_tareas > 0){
            $tareas = DB::table('tareas as t') 
            -> where ('t.esta_activo','=', 'SI')
            -> orderBy('t.updated_at', 'DESC')
            -> get();
        }else{
            $tareas=null;
        }
    //alidacion por tipo de usuario
    if(auth()->user()->isRole('ADMINISTRADOR')){
        return view('dashboard', compact('clientes', 'clientes_cont','contratos','planes','productos','facturas','fecha_fac','empleados','empleados_cont',
        'fecha','suscriptores','fecha_sus','task','fecha_tas','tareas','cont_tareas'));
    }elseif(auth()->user()->isRole('CLIENTE')){
        //Consulta cantidad de contratos por cliente
        $contratos = DB::table('contratos as c') 
        -> join('users as u','c.user_id','=','u.id')
        -> where ('c.user_id','=', auth()->id())
        -> count();
        //Consulta datos de cliente
        $cliente = DB::table('users as u') 
        -> join('role_user as ru','ru.user_id','=','u.id')
        -> join('roles as r','ru.role_id','=','r.id')
        ->select('u.id','u.cedula','u.nombres','u.apellidos')
        -> where ('r.name','=', 'CLIENTE')
        -> where ('u.id','=',auth()->id())
        -> first();
        //Consulta cantidad de productos por cliente
        $productos = DB::table('enlaces as e')
        -> join('productos as p','p.id','=','e.router_id')
        -> where ('p.categoria_id','=', '3')
        -> where ('e.user_id','=', auth()->id())
        -> count();
        //Consulta para la suma
        $productos1 = DB::table('enlaces as e')
        -> join('productos as p','p.id','=','e.producto_id')
        -> where ('p.categoria_id','=', '3')
        -> where ('e.user_id','=', auth()->id())
        -> count();
        //Facturas cantidad
        $fact = DB::table('facturas as f') 
        -> join('users as u','u.id','=','f.cliente_id')
        -> where ('f.esta_paga','=', 'SI')
        -> where ('f.cliente_id','=', auth()->id())
        -> count();
        //Facturas fechaI
        if($fact > 0){
            $fecha_fact = DB::table('facturas as f')
            -> join('users as u','u.id','=','f.cliente_id')
            -> select('f.updated_at')
            -> where ('f.esta_paga','=', 'SI')
            -> where ('f.cliente_id','=', auth()->id())
            -> orderBy('f.updated_at', 'DESC')
            -> first();
        }else{
            $fecha_fact=null;
        }
        //Servicios al cliente
        //Contar tabla de tareas
       $cont_tareas1 = DB::table('tareas as t') 
       -> where ('t.esta_activo','=', 'SI')
       -> where ('t.cliente_id','=', auth()->id())
       -> count();
       //COnsultar tareas
       if($cont_tareas1 > 0){
            $tareas1 = DB::table('tareas as t') 
            -> where ('t.esta_activo','=', 'SI')
            -> where ('t.cliente_id','=', auth()->id())
            -> orderBy('t.updated_at', 'DESC')
            -> get();
            //Consultar empleados
            $empleados = DB::table('users as u') 
            -> join('role_user as ru','ru.user_id','=','u.id')
            -> join('roles as r','ru.role_id','=','r.id')
            -> select('u.id', 'u.nombres','u.apellidos')
            -> where ('r.name','=', 'EMPLEADO')
            -> get();
        }else{
            $tareas1=null;
        }
       //Consulta cantidad de tareas por cliente
       $task1 = DB::table('tareas as t') 
       -> where ('t.estatus','=', 'COMPLETADA')
       -> where ('t.cliente_id','=', auth()->id())
       -> count();
       //Consulta de tareas
       if($task1 > 0){
            $fecha_tas1 = DB::table('tareas as t') 
            -> select('t.updated_at')
            -> where ('t.estatus','=', 'COMPLETADA')
            -> where ('t.cliente_id','=', auth()->id())
            -> orderBy('t.updated_at', 'ASC')
            -> first();
       }else{
            $fecha_tas1=null;
       }
        //Enviar la informacion a la vista
        return view('dashboard1', compact('cliente', 'contratos','productos','productos1','empleados',
        'fact','fecha_fact','task1','fecha_tas1','tareas1','cont_tareas1'));
    }elseif(auth()->user()->isRole('EMPLEADO')){
        return view('dashboard2', compact('clientes', 'facturas','fecha_fac','contratos','clientes_cont','productos',
        'planes','suscriptores','empleados_cont','fecha','empleados','task','fecha_tas','tareas','cont_tareas'));
    }
}
    
}
