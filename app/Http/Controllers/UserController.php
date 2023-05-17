<?php

namespace App\Http\Controllers;

use App\User;
use App\RoleUser;
use App\Contrato;
use App\Planes;
use DB;
use Caffeinated\Shinobi\Models\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use File;
use Image;

class UserController extends Controller
{
    private static $this = '';
    //Constructor
    function __construct() {

      }
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $roles = Role::get();
		$users = User::get();

        return view('users.index', ['users' => $model->paginate(15)], compact('users','roles'));
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::get();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        try{
            $foto = null;
            $foto_cedula = null;
            if($request->hasFile('foto') || $request->hasFile('foto_cedula')) {
                $foto = $this->saveFile($request->nombres, $request->file('foto'));
                $foto_cedula = $this->saveFile($request->cedula, $request->file('foto_cedula'));
            }

            DB::beginTransaction();
            $cedula = $request->get('cedula');   

                $usuario = User::create([
                    'cedula' => $cedula,
                    'nombres' => $request->nombres,
                    'apellidos' => $request->apellidos,
                    'telefono' => $request->telefono,
                    'celular' => $request->celular,
                    'email' => $request->email,
                    'password' => Hash::make($request->get('password')),
                    'calle_p' => $request->calle_p,
                    'calle_s' => $request->calle_s,
                    'direccion' => $request->direccion,
                    'salario' => $request->salario,
                    'descuento' => $request->descuento,
                    'total_salario' => $request->total_salario,
                    'foto' => $foto,
                    'foto_cedula' => $foto_cedula,
                    'es_vip' => $request->es_vip,
                    'esta_activo' => $request->esta_activo,
                ]);
 
                $user = User::select('id')->where('cedula',$cedula)->first();
                
                $role_user = RoleUser::create([
                    'user_id' => (int)$user->id,
                    'role_id' => (int)$request->get('rol_id'),
                ]); 
                DB::commit(); 
                return redirect()->route('users.index')->withStatus(__('Usuario creado satisfactoriamente.'));
            }catch(Exception $e){
            return redirect()->back()->with(['Error' => $e->getMessage()]);
        }

    }
    public function saveFile($name, $photo)
    {
        $imagen = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/usuarios');

        if(!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        Image::make($photo)->save($path . '/' .$imagen);
        return $imagen;
    }
   /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        $role_user = RoleUser::get();
        $roles = Role::get();
        return view('users.show', compact('user','roles','role_user'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function editar_persona($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();
        return view('users.editar_persona', compact('user','roles'));
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit_role(User $user)
    {
        //
        $roles = Role::get();
        return view('users.edit_role', compact('user','roles'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function actualizar_persona(UserRequest $request, User $user)
    {
        try{
            $user_img = User::findOrFail($user->id);
            $foto = $user_img->foto;
            $foto_cedula = $user_img->foto_cedula;

            if($request->hasFile('foto')) {
                //foto
                !empty($foto) ? File::delete(public_path('uploads/usuarios/' . $user_img->foto)):null;
                $foto = $this->saveFile($request->nombres, $request->file('foto'));
            }
            if($request->hasFile('foto_cedula')) {
                //foto_cedula
                !empty($foto_cedula) ? File::delete(public_path('uploads/usuarios/' . $user_img->foto_cedula)):null;
                $foto_cedula = $this->saveFile($request->cedula, $request->file('foto_cedula'));
            }

            DB::beginTransaction();
            $cedula = $request->get('cedula');   

                $usuario = User::find($user->id);
                    $usuario->cedula = $cedula;
                    $usuario->nombres = $request->nombres;
                    $usuario->apellidos = $request->apellidos;
                    $usuario->telefono = $request->telefono;
                    $usuario->celular = $request->celular;
                    $usuario->email = $request->email;
                    $usuario->calle_p = $request->calle_p;
                    $usuario->calle_s = $request->calle_s;
                    $usuario->direccion = $request->direccion;
                    $usuario->salario = $request->salario;
                    $usuario->descuento = $request->descuento;
                    $usuario->total_salario = $request->total_salario;
                    $usuario->foto = $foto;
                    $usuario->foto_cedula = $foto_cedula;
                    $usuario->es_vip = $request->es_vip;
                    $usuario->esta_activo = $request->esta_activo;
                $usuario->save(); 
 
                //$user = User::select('id')->where('cedula',$cedula)->first();
                $role_user = RoleUser::get()->where('user_id',$user->id)->first();
                if($role_user){
                    $role_user->user_id = (int)$user->id;
                    $role_user->role_id = (int)$request->get('rol_id');
                    $role_user->save();
                }else{
                    $role_user = RoleUser::create([
                        'user_id' => (int)$user->id,
                        'role_id' => (int)$request->get('rol_id'),
                    ]); 
                }
                DB::commit(); 
                return redirect()->route('users.index')->withStatus(__('Usuario actualizado satisfactoriamente.'));
                 

            }catch(Exception $e){
            return redirect()->back()->with(['Error' => $e->getMessage()]);
        }

    }
    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit_clave($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit_clave', compact('user'));
    }
    /**
     * Update the specified user in storage
     *
   
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_clave(Request $request, User  $user)
    {
        try{
            DB::beginTransaction();

             $user->update(
                $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
             ));  

                DB::commit(); 
                return redirect()->route('users.index')->withStatus(__('Cambio de clave satisfactorio.'));

            }catch(Exception $e){
            return redirect()->back()->with(['Error en el sistema' => $e->getMessage()]);
        }

    }

    public function update_role(Request $request, User $user)
    {
        //actualizar el usuario
        $user->update($request->all());
        //actualizar los roles
        $user->roles()->sync($request->get('roles'));

        
        return redirect()->route('users.edit_role', $user->id)
        ->with('info', 'Usuario actualizado con exito');

        return view('users.show', compact('user'));
    }
    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        //Eliminar relacion role_usuario
        $role_user = RoleUser::get()->where('user_id',$user->id)->first();
        if(!empty($role_user)) {
            $role_user->delete;
        }
        //Eliminar archivos imagen
        $user_img = User::findOrFail($user->id);
        if(!empty($user_img->foto) || !empty($user_img->foto_cedula)) {
            File::delete(public_path('uploads/usuarios/' . $user_img->foto));
            File::delete(public_path('uploads/usuarios/' . $user_img->foto_cedula));
        }
        //Eliminar usuario
        $user->delete();
        return redirect()->route('users.index')->withStatus(__('Usuario eliminado correctamente.'));
    }
    /**
     * Display a listing of the empleados
     *
     * @param  \App\User  $empleado
     * @return \Illuminate\View\View
     */
    public function verEmpleado(User $empleado)
    {
    	$usuarios = DB::table('users as u') 
        -> join('role_user as ru','ru.user_id','=','u.id')
        -> join('roles as r','ru.role_id','=','r.id')
        -> select('u.id', 'u.nombres','u.apellidos','u.telefono', 'u.celular','u.email',
        'u.total_salario','u.esta_activo','r.name')
        -> where ('r.name','=', 'Empleado')
        -> get();

        return view('empleados.index', ['empleado' => $empleado], compact('usuarios'));
    }
    /**
     * Display a listing of the clientes
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function verClientes()
    {
        $planes = Planes::get();
        $contratos = Contrato::get();
        //Devuelve cantidad usuarios en la consulta
    	$count = DB::table('users as u') 
        -> join('role_user as ru','ru.user_id','=','u.id')
        -> join('roles as r','ru.role_id','=','r.id')
        -> select('u.id', 'u.nombres','u.apellidos','u.cedula','u.telefono', 'u.celular','u.email',
        'u.direccion','u.total_salario','r.name')
        -> where ('r.name','=', 'cliente')
        -> count();
        //Devuelve usuarios en la consulta
            $usuarios = DB::table('users as u') 
            -> join('role_user as ru','ru.user_id','=','u.id')
            -> join('roles as r','ru.role_id','=','r.id')
            -> select('u.id', 'u.nombres','u.apellidos','u.cedula','u.telefono', 'u.celular','u.email',
            'u.direccion','u.total_salario','r.name')
            -> where ('r.name','=', 'cliente')
            -> get();


        return view('clientes.index', compact('contratos','usuarios','planes','count'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $cliente
     * @return \Illuminate\Http\Response
     */
    public function showCliente(User $cliente)
    {
        //
        $role_user = RoleUser::get();
        $roles = Role::get();
        return view('clientes.show', compact('cliente','role_user','roles'));
    }

    /**
     * Show the form for editing the specified cliente
     *
     * @param  \App\User  $cliente
     * @return \Illuminate\View\View
     */
    public function editCliente($id)
    {
        $cliente = User::findOrFail($id);
        $roles = Role::get();
        return view('clientes.edit', compact('cliente','roles'));
    }
    /**
     * Update the specified cliente in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $cliente
     * @return \Illuminate\Http\RedirectResponse
     */
    public function actualizarCliente(Request $request, User $cliente)
    {
        try{
            $user_img = User::findOrFail($cliente->id);
            $foto = $user_img->foto;
            $foto_cedula = $user_img->foto_cedula;

            if($request->hasFile('foto')) {
                //foto
                !empty($foto) ? File::delete(public_path('uploads/usuarios/' . $user_img->foto)):null;
                $foto = $this->saveFile($request->nombres, $request->file('foto'));
            }
            if($request->hasFile('foto_cedula')) {
                //foto_cedula
                !empty($foto_cedula) ? File::delete(public_path('uploads/usuarios/' . $user_img->foto_cedula)):null;
                $foto_cedula = $this->saveFile($request->cedula, $request->file('foto_cedula'));
            }

            DB::beginTransaction();
            $cedula = $request->get('cedula');   

                $usuario = User::find($cliente->id);
                    $usuario->nombres = $request->nombres;
                    $usuario->apellidos = $request->apellidos;
                    $usuario->telefono = $request->telefono;
                    $usuario->celular = $request->celular;
                    $usuario->email = $request->email;
                    $usuario->calle_p = $request->calle_p;
                    $usuario->calle_s = $request->calle_s;
                    $usuario->direccion = $request->direccion;
                    $usuario->foto = $foto;
                    $usuario->foto_cedula = $foto_cedula;
                    $usuario->es_vip = $request->es_vip;
                    $usuario->esta_activo = $request->esta_activo;
                $usuario->save(); 
 
                DB::commit(); 
                return redirect()->route('clientes.index')->withStatus(__('Cliente actualizado satisfactoriamente.'));
                 

            }catch(Exception $e){
            return redirect()->back()->with(['Error en la actualización' => $e->getMessage()]);
        }
    }
    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $cliente
     * @return \Illuminate\View\View
     */
    public function edit_clave_cliente($id)
    {
        $cliente = User::findOrFail($id);
        return view('clientes.edit_clave_cliente', compact('cliente'));
    }

    /**
     * Update the specified user in storage
     *
   
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_clave_cliente(Request $request, User  $user)
    {
        try{
            DB::beginTransaction();

             $user->update(
                $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
             ));  

                DB::commit(); 
                return redirect()->route('clientes.index')->withStatus(__('Cambio clave de cliente satisfactorio.'));

            }catch(Exception $e){
            return redirect()->back()->with(['Error en el sistema' => $e->getMessage()]);
        }

    }

}
