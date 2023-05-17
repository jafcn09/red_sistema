<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::orderBy('id', 'ASC')->paginate(5);
        return view('categorias.index', compact('categorias'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|nullable|string',
            'esta_activo' => 'required|nullable|integer',
        ]);
        
        try{
            $categorias = Categoria::Create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'esta_activo' => $request->esta_activo
            ]);
            return redirect()->back()->with(['success' => 'Categoria: ' . $categorias->nombre . ' Agregado']);
        }catch(Exeption $e) {
            return redirect()->back()->with(['error'=> $e->getMessage()]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categorias'));
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
        //validasi form
        $this->validate($request, [
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|nullable|string',
            'esta_activo' => 'required|nullable|integer',
        ]);
        try{
            $categorias = Categoria::findOrFail($id);
            $categorias->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'esta_activo' => $request->esta_activo
            ]);
            return redirect('/categorias/index')->with(['success' => 'Categoria: ' . $categorias->nombre . ' Actualizada']);
        }catch(Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorias = Categoria::findOrFail($id);
        $categorias->delete();
        return redirect()->back()->with(['success' => 'Categoria: ' . $categorias->nombre . ' Eliminada']);
    }
}
