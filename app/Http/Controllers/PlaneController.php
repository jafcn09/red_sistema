<?php

namespace App\Http\Controllers;
use App\Planes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use File;
use Image;
use DB;

class PlaneController extends Controller
{
    private static $this = '';
    //Constructor
    function __construct() {

      }
    /**
     * Display a listing of the planes
     *
     * @param  \App\Planes  $model
     * @return \Illuminate\View\View
     */
    public function index(Planes $model)
    {
        $plane = Planes::get();
        return view('planes.index', ['planes' => $model->paginate(15)], compact('plane'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('planes.create');
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
        //form validate
        $this->validate($request, [
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|nullable|max:100',
            'capacidad' => 'required',
            'precio' => 'required',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        try{
            $imagen = null;
            if($request->hasFile('imagen')) {
                $imagen = $this->saveFile($request->nombre, $request->file('imagen'));
            }

            $plan = Planes::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'capacidad' => $request->capacidad,
                'precio' => $request->precio,
                'imagen' => $imagen,
            ]);
            return redirect(route('planes.index'))->with('success', 'Plan ' . $plan->nombre . ' agregado satisfactoriamente');
        }catch(Exception $e){
            return redirect()->back()->with(['Error al registrar en el sistema' => $e->getMessage()]);
        }
    }
    public function saveFile($name, $photo)
    {
        $imagen = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/planes');

        if(!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        Image::make($photo)->save($path . '/' .$imagen);
        return $imagen;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Planes  $plane
     * @return \Illuminate\Http\Response
     */
    public function show(Planes $plane)
    {
        return view('planes.show', compact('plane'));
    }

    /**
     * Show the form for editing the specified user
     * @param  \App\Planes  $plane
     * @return \Illuminate\Http\Response
     * @return \Illuminate\View\View
     */
    public function edit(Planes $plane)
    {
        return view('planes.edit', compact('plane'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Planes  $plane
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
         //form validate
         $this->validate($request, [
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|nullable|max:100',
            'capacidad' => 'required',
            'precio' => 'required',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        try{
            DB::beginTransaction();
            $plane_img = Planes::findOrFail($id);
            $imagen = $plane_img->imagen;

            if($request->hasFile('imagen')) {
                !empty($imagen) ? File::delete(public_path('uploads/planes/' . $plane_img->imagen)):null;
                $imagen = $this->saveFile($request->nombre, $request->file('imagen'));
            }
            //Objeto de planes para actualizar
            $plan = Planes::find($id);
            $plan->nombre = $request->nombre;
            $plan->descripcion = $request->descripcion;
            $plan->capacidad = $request->capacidad;
            $plan->precio = $request->precio;
            $plan->imagen = $imagen;
            $plan->save();

            DB::commit();
            return redirect(route('planes.index'))->with('success', 'Plan ' . $plan->nombre . ' actualizado satisfactoriamente');
        }catch(Exception $e){
            return redirect()->back()->with(['Error al registrar en el sistema' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Planes  $plane
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Planes $plane)
    {
        $plan = Planes::findOrFail($plane->id);
        if(!empty($plan->imagen)) {
            File::delete(public_path('uploads/planes/' . $plan->imagen));
        }
        $plan->delete();
        return redirect()->route('planes.index')->withStatus(__('Plan eliminado satisfactoriamente.'));
    }

}
