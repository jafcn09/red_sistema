<?php

namespace App\Http\Controllers;
use App\Cliente;
use App\Contrato;
use App\User;
use DB;
use App\FacturaContrato;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use \Auth, \Redirect, \Validator, \Input, \Session;

class ClienteController extends Controller
{
    /**
     * Display a listing of the clientes
     *
     * @param  \App\Cliente  $model
     * @return \Illuminate\View\View
     */
    public function index(Cliente $model)
    {
        $contratos = Contrato::get();

        return view('clientes.index', ['clientes' => $model->paginate(15)], compact('clientes','contratos'));
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
         -> where ('r.name','=', 'Visitantes')
         -> get();
        return view('clientes.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $cliente = Cliente::create($request->all());
         //actualizar permisos
         //$cliente->permissions()->sync($request->get('permissions'));
         return redirect()->route('clientes.index', $cliente->id)
         ->with('info', 'Cliente guardado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\View\View
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //actualizar role
        
        //actualizar permisos
        //$cliente->contratos()->sync($request->get('contratos'));
        $es_vip = $request->get('es_vip');
        if($es_vip == true ){
            $cliente->es_vip=1;
        }else{
            $cliente->es_vip=0;
        }
        $esta_activo = $request->get('esta_activo');
        if($esta_activo == true){
            $cliente->esta_activo=1;
        }else{
            $cliente->esta_activo=0;
        }

        $cliente->update($request->all());

        return redirect()->route('clientes.edit', $cliente->id)->withStatus(__('Cliente successfully deleted.'));

        //return view('roles.show', compact('role'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')->withStatus(__('Cliente successfully deleted.'));
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

        $cliente = Cliente::where('apellidos', $request->apellidos)->first();
        if ($cliente) {
            return response()->json([
                'status' => 'success',
                'data' => $cliente,
            ], 200);
        }

        return response()->json([
            'status' => 'failed',
            'data' => []
        ]);
    }

}
