<?php

namespace App\Http\Controllers;
use App\Factura;
use App\Contrato;
use App\User;
use App\Planes;
use App\Empresa;
use App\Producto;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use Cookie;
use DB;
use PDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D; 
use Illuminate\Routing\Redirector;
use File;
use Image;

class ContratoController extends Controller
{
    /**
     * Display a listing of the contratos
     *
     * @param  \App\Contrato  $model
     * @return \Illuminate\View\View
     */
    public function index(Contrato $model)
    {
        $users = User::get();
        $facturas = Factura::get();
        $planes = Planes::get();
		$contratos = Contrato::get();
        return view('contratos.index', ['contratos' => $model->paginate(15)], compact('contratos','facturas','planes','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = User::all();
        $planes = Planes::get();
        $contrato_num = time();
		$contratos = Contrato::get();
        return view('contratos.create', compact('contratos', 'clientes','planes','contrato_num'));
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
        $contrato = Contrato::create($request->all());

         //actualizar permisos
         //$contrato->permissions()->sync($request->get('permissions'));
         return redirect()->route('contratos.index', $contrato->id)
         ->with('info', 'Contrato guardado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show(Contrato $contrato)
    {
        //
        $users = User::get();
        $planes = Planes::get();
        return view('contratos.show', compact('contrato','planes','users'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\Factura  $contrato
     * @return \Illuminate\View\View
     */
    public function edit(Contrato $contrato)
    {
        $clientes = User::get();
        $planes = Planes::get();
        return view('contratos.edit', compact('contrato','clientes','planes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contrato $contrato)
    {
        //actualizar role
        
        //actualizar permisos
        //$contrato->contratos()->sync($request->get('contratos'));

        $contrato->update($request->all());

        return redirect()->route('contratos.index', $contrato->id)->withStatus(__('Contrato successfully deleted.'));

        //return view('roles.show', compact('role'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contrato $contrato)
    {
        $contrato->delete();
        return redirect()->route('contratos.index')->withStatus(__('Contrato eliminado satisfactoriamente.'));
    }
 /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pdf(Request $request,$id){
        //CONSULTA DE contrato
        $contrato = Contrato::join('users','contratos.user_id','=','users.id')
        ->join('planes as p','contratos.plan_id','=','p.id')
        ->join('enlaces as e','users.id','=','e.user_id')
        ->select('users.nombres','users.apellidos','users.cedula','users.telefono','users.celular','users.direccion',
        'users.calle_p','users.calle_s','contratos.id','contratos.contrato_num','contratos.fecha_inicio',
        'contratos.fecha_fin','contratos.descripcion','p.nombre','p.descripcion','p.capacidad','p.precio','e.producto_id','e.router_id')
        ->where('contratos.id','=',$id)
        ->orderBy('contratos.id','desc')->take(1)->get();
  
        //Consulta de empresa
        $empresas = Empresa::get(); 
        //Nro contrato
        $num_contrato=Contrato::select('contrato_num')->where('id',$id)->get();
        //CODIGO DE BARRAS
        $code = new DNS1D();
        //Fecha hoy
        $hoy = new Date('now');
        //Productos
        $equipos = Producto::where('categoria_id','3')->where('asignado','1')->get();
  
        $pdf = \PDF::loadView('/pdf/contrato',['contrato'=>$contrato,'empresas'=>$empresas, 'code'=>$code,
        'hoy'=>$hoy, 'equipos'=>$equipos]);
        return $pdf->download('contrato-'.$num_contrato[0]->contrato_num.'.pdf');
        //return view('/pdf.factura', ['factura' => $factura, 'detalles' => $detalles]);
  
    }
}
