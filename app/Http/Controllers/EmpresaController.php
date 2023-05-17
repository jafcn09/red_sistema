<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empresa;
use App\Factura;
use File;
use Image;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::orderBy('id', 'ASC')->paginate(5);
        return view('empresas.index', compact('empresas'));
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
            'ruc' => 'required|string',
            'telefono' => 'required|string|max:50',
            'celular' => 'required|string|max:50',
            'direccion' => 'required|string',
            'descripcion' => 'required|nullable|string',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);
        
        try{
            $logo = null;
            if($request->hasFile('logo')) {
                $logo = $this->saveFile($request->nombre, $request->file('logo'));
            }

            $empresas = Empresa::Create([
                'nombre' => $request->nombre,
                'ruc' => $request->ruc,
                'telefono' => $request->telefono,
                'celular' => $request->celular,
                'direccion' => $request->direccion,
                'descripcion' => $request->descripcion,
                'logo' => $logo

            ]);
            return redirect()->back()->with(['success' => 'Empresa: ' . $empresas->nombre . ' Agregado']);
        }catch(Exeption $e) {
            return redirect()->back()->with(['error'=> $e->getMessage()]);
        }
    }
//Funcion de guardar imagen
public function saveFile($name, $photo)
{
    $imagen = str_slug($name) . '.' . $photo->getClientOriginalExtension();
    $path = public_path('img');

    if(!File::isDirectory($path)) {
        File::makeDirectory($path, 0777, true, true);
    }
    Image::make($photo)->save($path . '/' .$imagen);
    return $imagen;
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresas = Empresa::findOrFail($id);
        return view('empresas.edit', compact('empresas'));
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
            'ruc' => 'required|string',
            'telefono' => 'required|string|max:50',
            'celular' => 'required|string|max:50',
            'direccion' => 'required|string',
            'descripcion' => 'required|nullable|string',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);
        try{
            $emp = Empresa::findOrFail($id);
            $logo = $emp->logo;

            if($request->hasFile('logo')) {
                !empty($logo) ? File::delete(public_path('img' . $emp->logo)):null;
                $logo = $this->saveFile($request->nombre, $request->file('logo'));
            }

            $empresas = Empresa::findOrFail($id);
            $empresas->update([
                'nombre' => $request->nombre,
                'ruc' => $request->ruc,
                'telefono' => $request->telefono,
                'celular' => $request->celular,
                'direccion' => $request->direccion,
                'descripcion' => $request->descripcion,
                'logo' => $logo
            ]);
            return redirect('/empresas/index')->with(['success' => 'Empresa: ' . $empresas->nombre . ' Actualizada']);
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
        $facturas = Factura::where('empresa_id','=',$id)->first();
        if($facturas){
            return redirect()->back()->with(['danger' => 'Empresa: ' - ' No puede see Borrada']);
        }else{
            $empresas = Empresa::findOrFail($id);
            $empresas->delete();
            return redirect()->back()->with(['success' => 'Empresa: ' . $empresas->nombre . ' Deleted']);
        }
        
    }
}
