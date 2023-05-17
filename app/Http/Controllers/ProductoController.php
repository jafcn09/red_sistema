<?php

namespace App\Http\Controllers;

use App\Factura;
use App\Cliente;
use App\Categoria;
use App\Producto;
use App\ProductoFactura;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D; 
use Illuminate\Routing\Redirector;
use File;
use Image;

class ProductoController extends Controller
{
    private static $this = '';
    //Constructor
    function __construct() {

      }

    /**
     * Display a listing of the productos
     *
     * @param  \App\Producto  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $code = new DNS1D();
        $productos = Producto::with('categoria')->where('categoria_id','1')->orderBy('id', 'ASC')->paginate(10);
        $categorias = Categoria::all();
        return view('productos.index', compact('productos', 'categorias','code'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //$productos = Producto::get();
        //$code = time();
        $categoria = Categoria::where('nombre','<>','SERVICIOS')->get();
        
        return view('productos.create', compact('categoria'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
        //$producto = Producto::all();
        $categorias = Categoria::all();
        
        return view('productos.show', compact('categorias', 'producto'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @param  \App\Producto  $model
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //form validate
        $this->validate($request, [

            'codigo' => 'required|string|max:30|unique:productos',
            'nombre' => 'required|string|max:50',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'descripcion' => 'required|string|nullable|max:100',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'condicion' => 'required|integer',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        try{
            $imagen = null;
            if($request->hasFile('imagen')) {
                $imagen = $this->saveFile($request->nombre, $request->file('imagen'));
            }

            $producto = Producto::create([
                'categoria_id' => $request->categoria_id,
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
                'marca' => $request->marca,
                'modelo' => $request->modelo,
                'descripcion' => $request->descripcion,
                'cantidad' => $request->cantidad,
                'precio' => $request->precio,
                'condicion' => $request->condicion,
                'asignado' => 0,
                'imagen' => $imagen,
            ]);
            return redirect()->route('productos.index', $producto->nombre)->withStatus(__('Producto agregado satisfactoriamente.'));
        }catch(Exception $e){
            return redirect()->back()->with(['Error' => $e->getMessage()]);
        }
    }

    public function saveFile($name, $photo)
    {
        $imagen = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/productos');

        if(!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        Image::make($photo)->save($path . '/' .$imagen);
        return $imagen;
    }

    public function destroy($id)
    {
        $productos = Producto::findOrFail($id);
        if(!empty($productos->imagen)) {
            File::delete(public_path('uploads/productos/' . $productos->imagen));
        }
        $productos->delete();
        return redirect()->route('productos.index', $productos->nombre)->withStatus(__('Producto eliminado satisfactoriamente.'));

    }
    /**
     * Display a listing of the productos
     *
     * @param  \App\Producto  $model
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::orderBy('id', 'ASC')->get();
        return view('productos.edit', compact('producto', 'categorias'));
    }


        /**
     * Update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @param  \App\Producto  $model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //form validate
        $this->validate($request, [
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|nullable|max:100',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'condicion' => 'required|integer',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        try{
            $producto = Producto::findOrFail($id);
            $imagen = $producto->imagen;

            if($request->hasFile('imagen')) {
                !empty($imagen) ? File::delete(public_path('uploads/productos/' . $producto->imagen)):null;
                $imagen = $this->saveFile($request->nombre, $request->file('imagen'));
            }

            $product = Producto::find($id);
                $product->nombre = $request->nombre;
                $product->descripcion = $request->descripcion;
                $product->cantidad = $request->cantidad;
                $product->precio = $request->precio;
                $product->condicion = $request->condicion;
                $product->imagen = $imagen;
                $product->save();

           return redirect()->route('productos.index', $product->nombre)->withStatus(__('Producto actualizado satisfactoriamente.'));
        }catch(Exception $e){
            return redirect()->back()->with(['Error' => $e->getMessage()]);
        }

    }
// Servicios controller con los datos asociados a servicios de la empresa
 /**
     * Display a listing of the productos
     *
     * @param  \App\Producto  $model
     * @return \Illuminate\View\View
     */
    public function servicio_index()
    {
        $code = new DNS1D();
        $servicios = Producto::with('categoria')->where('categoria_id','=','2')
        ->orderBy('id', 'ASC')->paginate(10);
        $categorias = Categoria::where('id','=','2');
        return view('servicios.index', compact('servicios', 'categorias','code'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function servicio_create()
    {   
        //$productos = Producto::get();
        $code = time();
        $categoria = Categoria::where('id','<>','1')->get();
        
        return view('servicios.create', compact('categoria', 'code'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $servicio
     * @return \Illuminate\Http\Response
     */
    public function servicio_show(Producto $servicio)
    {
        //
        //$servicio = Producto::all();
        $categorias = Categoria::all();
        
        return view('servicios.show', compact('categorias', 'servicio'));
    }

    public function servicioSaveFile($name, $photo)
    {
        $imagen = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/servicios');

        if(!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        Image::make($photo)->save($path . '/' .$imagen);
        return $imagen;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @param  \App\Producto  $model
     * @return \Illuminate\Http\Response
     */
    public function servicio_store(Request $request)
    {
        //form validate
        $this->validate($request, [
            'categoria_id' => 'required|exists:categorias,id',
            'codigo' => 'required|string|max:10|unique:productos',
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|nullable|max:100',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'condicion' => 'required|integer',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        try{
            $imagen = null;
            if($request->hasFile('imagen')) {
                $imagen = $this->servicioSaveFile($request->nombre, $request->file('imagen'));
            }

            $producto = Producto::create([
                'categoria_id' => $request->categoria_id,
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'cantidad' => $request->cantidad,
                'asignado' => 0,
                'condicion' => $request->condicion,
                'imagen' => $imagen,
            ]);
            return redirect()->route('servicios.index', $producto->nombre)->withStatus(__('Servicio agregado satisfactoriamente.'));
        }catch(Exception $e){
            return redirect()->back()->with(['Error' => $e->getMessage()]);
        }
    }

    public function servicio_destroy($id)
    {
        $productos = Producto::findOrFail($id);
        if(!empty($productos->imagen)) {
            File::delete(public_path('uploads/servicios/' . $productos->imagen));
        }
        $productos->delete();
        return redirect()->route('servicios.index', $productos->nombre)->withStatus(__('Servicio eliminado satisfactoriamente.'));
    }
    /**
     * Display a listing of the productos
     *
     * @param  \App\Producto  $model
     * @return \Illuminate\View\View
     */
    public function servicio_edit($id)
    {
        $servicio = Producto::findOrFail($id);
        $categorias = Categoria::where('id', '>', '1')->get();
        return view('servicios.edit', compact('servicio', 'categorias'));
    }


        /**
     * Update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @param  \App\Producto  $model
     * @return \Illuminate\Http\Response
     */
    public function servicio_update(Request $request, $id)
    {
        //form validate
        $this->validate($request, [
            'categoria_id' => 'required|exists:categorias,id',

            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|nullable|max:100',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'condicion' => 'required|integer',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        try{
            $producto = Producto::findOrFail($id);
            $imagen = $producto->imagen;

            if($request->hasFile('imagen')) {
                !empty($imagen) ? File::delete(public_path('uploads/servicios/' . $producto->imagen)):null;
                $imagen = $this->servicioSaveFile($request->nombre, $request->file('imagen'));
            }

            $product = Producto::find($id);
                $product->categoria_id = $request->categoria_id;
                $product->nombre = $request->nombre;
                $product->descripcion = $request->descripcion;
                $product->precio = $request->precio;
                $product->cantidad = $request->cantidad;
                $product->condicion = $request->condicion;
                $product->imagen = $imagen;
                $product->save();

            return redirect()->route('servicios.index', $product->nombre)->withStatus(__('Servicio actualizado satisfactoriamente.'));
        }catch(Exception $e){
            return redirect()->back()->with(['Error' => $e->getMessage()]);
        }

    }

        /**
     * Display a listing of the productos
     *
     * @param  \App\Producto  $model
     * @return \Illuminate\View\View
     */
    public function inventario()
    {
        $code = new DNS1D();
        $inventario = Producto::with('categoria')->where('categoria_id','3')->orderBy('id', 'ASC')->paginate(10);
        $categorias = Categoria::all();
        return view('productos.inventario', compact('inventario', 'categorias','code'));    
    }
}
