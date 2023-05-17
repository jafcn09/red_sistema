<?php

namespace App\Http\Controllers;
use App\User;
use App\Empleado;
use DB;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use \Auth, \Redirect, \Validator, \Input, \Session;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the empleados
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\View\View
     */
    public function index(Empleado $empleado)
    {
    	$usuarios = DB::table('users as u') 
        -> join('role_user as ru','ru.user_id','=','u.id')
        -> join('roles as r','ru.role_id','=','r.id')
        -> join('empleados as e','u.id','=','e.user_id')
        -> select('e.id', 'e.nombres','e.apellidos','e.telefono', 'e.celular','u.email',
        'e.total_salario','e.cargo','r.name')
        -> where ('r.name','=', 'Empleados')
        -> get();

        return view('empleados.index', ['empleado' => $empleado], compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = DB::table('users as u') 
        -> join('role_user as ru','ru.user_id','=','u.id')
        -> join('roles as r','ru.role_id','=','r.id')
        -> select('u.id', 'u.name','u.email','r.slug')
        -> where ('r.name','=', 'Empleados')
        -> where ('u.es_visitante','=', 'NO')
        -> get();
        return view('empleados.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $empleado = Empleado::create($request->all());
         //actualizar permisos
         //$empleado->permissions()->sync($request->get('permissions'));
         return redirect()->route('empleados.index', $empleado->id)
         ->with('info', 'Empleado guardado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
        return view('empleados.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\View\View
     */
    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        //actualizar role
        
        //actualizar permisos
        //$empleado->contratos()->sync($request->get('contratos'));
        $es_vip = $request->get('es_vip');
        if($es_vip == true ){
            $empleado->es_vip=1;
        }else{
            $empleado->es_vip=0;
        }
        $esta_activo = $request->get('esta_activo');
        if($esta_activo == true){
            $empleado->esta_activo=1;
        }else{
            $empleado->esta_activo=0;
        }

        $empleado->update($request->all());

        return redirect()->route('empleados.edit', $empleado->id)->withStatus(__('Empleado successfully deleted.'));

        //return view('roles.show', compact('role'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleados.index')->withStatus(__('Empleado successfully deleted.'));
    }
    //
    public function contratos(){
        return $this->belongsToMany('Contrato');
    }
// Funcion que va con el carrito de compras
    public function search(Request $request) 
    {
        $this->validate($request, [
            'apellidos' => 'required|apellidos'
        ]);

        $empleado = Empleado::where('apellidos', $request->apellidos)->first();
        if ($empleado) {
            return response()->json([
                'status' => 'success',
                'data' => $empleado,
            ], 200);
        }

        return response()->json([
            'status' => 'failed',
            'data' => []
        ]);
    }

}
