<?php

namespace App\Http\Controllers;
use App\User;
use App\Tarea;
use App\TareaUser;
use DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Display a listing of the tareas
     *
     * @param  \App\Tarea  $model
     * @return \Illuminate\View\View
     */
    public function index(Tarea $model)
    {
        $tareas = Tarea::get();
        $usuarios = User::get();

        return view('tareas.index', compact('tareas','usuarios'));  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   //listado de empleados
    	$usuarios = DB::table('users as u') 
        -> join('role_user as ru','ru.user_id','=','u.id')
        -> join('roles as r','ru.role_id','=','r.id')
        -> select('u.id', 'u.nombres','u.apellidos')
        -> where ('r.name','=', 'EMPLEADO')
        -> get();
        //Listado de clientes
        $clientes = DB::table('users as u') 
        -> join('role_user as ru','ru.user_id','=','u.id')
        -> join('roles as r','ru.role_id','=','r.id')
        ->select('u.id','u.nombres','u.apellidos')
        -> where ('r.name','=', 'CLIENTE')
        -> get();
        //Manda la vista
        return view('tareas.create', compact('usuarios','clientes'));
    }
  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
         DB::beginTransaction();
        //Registro de tareas y validaciones
        $mytime = Carbon::now('America/Guayaquil');
        $updated_at = $mytime -> toDateTimeString();
        $tarea = Tarea::create([
            'tipo_tarea' => $request->tipo_tarea,
            'nombre_tarea' => $request->nombre_tarea,
            'description' => $request->description,
            'cliente_id' => $request->cliente_id,
            'user_id' => $request->user_id,
            'asignado_a' => $request->asignado_a,
            'fecha_solucion' => $request->fecha_solucion,
            'estatus' => $request->estatus,
            'esta_activo' => "SI",
            'updated_at' => $updated_at
        ]);
        //Consultamos registro anterior
        $tarea_id = DB::table('tareas')->where('nombre_tarea',$request->nombre_tarea)
        ->orderBy('updated_at','desc')->first();
        //Guardar en user_tarea
        $tarea = TareaUser::create([
            'user_id' => $request->user_id,
            'tarea_id' => $tarea_id->id
        ]);
        //Hacer commit al try catch
        DB::commit();
         return redirect()->route('tareas.index', $tarea->id)
         ->withStatus(__('Tarea guardada satisfactoriamene.'));
        }catch(Exception $e){
        return redirect()->back()->with(['Error' => $e->getMessage()]);
        }
    }
   /**
     * Display the specified resource.
     *
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function show(Tarea $tarea)
    {
        $usuarios = User::get();
        return view('tareas.show', compact('tarea','usuarios'));
    }

    /**
     * Show the form for editing the specified user
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     * @return \Illuminate\View\View
     */
    public function edit(Tarea $tarea)
    {
        $user = User::where('id',$tarea->asignado_a)->first();
        $usuarios = User::get();
        return view('tareas.edit', compact('tarea','user','usuarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Tarea $tarea)
    {
        try{
            DB::beginTransaction();
           //Registro de enlave y validaciones
           $mytime = Carbon::now('America/Guayaquil');
           $updated_at = $mytime -> toDateTimeString();
            $tarea = Tarea::find($tarea->id);
               $tarea->tipo_tarea = $request->tipo_tarea;
               $tarea->nombre_tarea = $request->nombre_tarea;
               $tarea->description = $request->description;
               $tarea->cliente_id = $request->cliente_id;
               $tarea->user_id = $request->user_id;
               $tarea->asignado_a = $request->asignado_a;
               $tarea->fecha_solucion = $request->fecha_solucion;
               $tarea->estatus = $request->estatus;
               $tarea->esta_activo = $request->esta_activo;
               $tarea->updated_at = $updated_at;
            $tarea->save(); 
            //Guardar en user_tarea
            $consultar = TareaUser::where('tarea_id',$tarea->id)->orderBy('updated_at','DESC')->first();
            if($tarea->user_id != $consultar->user_id){
                $tarea = TareaUser::create([
                    'user_id' => $request->user_id,
                    'tarea_id' => $tarea->id
                ]);
            }
           //Proceder con el registro
           DB::commit();
            return redirect()->route('tareas.index', $tarea->id)
            ->withStatus(__('Tarea actualizada satisfactoriamene.'));
           }catch(Exception $e){
           return redirect()->back()->with(['Error' => $e->getMessage()]);
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tarea $tarea)
    {
        try{
        DB::beginTransaction();
        //Eliminar la relacion user_tarea
        $tarea_user = TareaUser::where('tarea_id',$tarea->id)->first();
        $tarea_user->delete();
        //Eliminar tarea
        $tarea->delete();
        DB::commit();
        return redirect()->route('tareas.index', $tarea->id)
        ->withStatus(__('Tarea eliminada satisfactoriamene.'));
       }catch(Exception $e){
       return redirect()->back()->with(['Error' => $e->getMessage()]);
       }    
    }
 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function finalizar(Request $request, Tarea $tarea)
    {
        try{
            DB::beginTransaction();
           //Registro de tareas y validaciones
            $tarea = Tarea::find($tarea->id);
               $tarea->esta_activo = "NO";
            $tarea->save(); 
           //Proceder con el registro
           DB::commit();
            return redirect()->route('home', $tarea->id)
            ->withStatus(__('Tarea finalizada satisfactoriamene.'));
           }catch(Exception $e){
           return redirect()->back()->with(['Error' => $e->getMessage()]);
           }
    }
 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function actualizar(Request $request, Tarea $tarea)
    {
        try{
            DB::beginTransaction();
           //Registro de enlave y validaciones
           $mytime = Carbon::now('America/Guayaquil');
           $updated_at = $mytime -> toDateTimeString();
            $tarea = Tarea::find($tarea->id);
               $tarea->solucion = $request->solucion;
               $tarea->estatus = $request->estatus;
               $tarea->updated_at = $updated_at;
            $tarea->save(); 
           //Proceder con el registro
           DB::commit();
            return redirect()->route('home', $tarea->id)
            ->withStatus(__('Tarea actualizada satisfactoriamene.'));
           }catch(Exception $e){
           return redirect()->back()->with(['Error' => $e->getMessage()]);
           }
    }
}
