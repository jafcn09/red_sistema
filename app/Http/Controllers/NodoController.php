<?php

namespace App\Http\Controllers;
use App\Nodo;
use App\Producto;
use App\Torre;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class NodoController extends Controller
{
    /**
     * Display a listing of the nodos
     *
     * @param  \App\Nodo  $model
     * @return \Illuminate\View\View
     */
    public function index(Nodo $model)
    {
        $nodo = Nodo::get();
        return view('nodos.index', ['nodos' => $model->paginate(15)], compact('nodo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::where('cantidad','>','0')->where('asignado','=','0')
        ->where('categoria_id','<>','2')->get();
        $torres = Torre::get();
        return view('nodos.create' ,compact('productos','torres'));
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
                $nodo = Nodo::create($request->all());
                $producto =  Producto::findOrFail($request->producto_id);
                $producto -> categoria_id = 3;
                $producto -> cantidad = $producto -> cantidad - 1;
                $producto -> update();
                DB::commit();
                return redirect()->route('nodos.index', $nodo->id)
                ->withStatus(__('Nodo guardado satisfactoriamene.'));
            }catch(Exception $e){
                return redirect()->back()->with(['Error' => $e->getMessage()]);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nodo  $nodo
     * @return \Illuminate\Http\Response
     */
    public function show(Nodo $nodo)
    {
        return view('nodos.show', compact('nodo'));
    }

    /**
     * Show the form for editing the specified user
     * @param  \App\Nodo  $nodo
     * @return \Illuminate\Http\Response
     * @return \Illuminate\View\View
     */
    public function edit(Nodo $nodo)
    {
        $productos = Producto::where('asignado','=','0')->where('cantidad','>','0')
        ->where('categoria_id','<>','2')->get();
        $torres = Torre::get();
        return view('nodos.edit', compact('nodo','productos','torres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nodo  $nodo
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Nodo $nodo)
    {
        try{
            DB::beginTransaction();
            //Actualizar productos para modificar
            $nod = Nodo::findOrFail($nodo->id);
            if ($nod->producto_id != $request->producto_id) {
                //Consulta 1
                $producto =  Producto::findOrFail($request->producto_id);
                $producto -> asignado = 1;
                $producto -> cantidad = $producto -> cantidad - 1;
                $producto -> update();
                //Consulta 2
                $producto1 =  Producto::findOrFail($nod->producto_id);
                $producto1 -> asignado = 0;
                $producto1 -> cantidad = $producto1 -> cantidad + 1;
                $producto1 -> update();
            }
            //actualizar nodos
            $nodo->update($request->all());
            DB::commit();
            return redirect()->route('nodos.index', $nodo->id)
            ->withStatus(__('Nodo actualizado satisfactoriamene.'));
           }catch(Exception $e){
           return redirect()->back()->with(['Error' => $e->getMessage()]);
           }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nodo  $nodo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Nodo $nodo)
    {
        try{
            DB::beginTransaction();
            //Cambiar estado de productos para reusar
            $producto =  Producto::findOrFail($nodo->producto_id);
            $producto -> asignado = 0;
            $producto -> cantidad = $producto -> cantidad + 1;
            $producto -> update();
            $nodo->delete();
            DB::commit();
            return redirect()->route('nodos.index', $nodo->id)
            ->withStatus(__('Nodo  fue eliminado satisfactoriamene.'));
           }catch(Exception $e){
           return redirect()->back()->with(['Error' => $e->getMessage()]);
           }
    }


}
