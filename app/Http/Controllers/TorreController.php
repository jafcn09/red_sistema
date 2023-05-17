<?php

namespace App\Http\Controllers;
use App\Torre;
use App\Nodo;
use DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class TorreController extends Controller
{
    /**
     * Display a listing of the torres
     *
     * @param  \App\Torre  $model
     * @return \Illuminate\View\View
     */
    public function index(Torre $model)
    {
        $torre = Torre::get();
        return view('torres.index', ['torres' => $model->paginate(15)], compact('torre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('torres.create');
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
         $torre = Torre::create($request->all());
         return redirect()->route('torres.index', $torre->id)
         ->withStatus(__('Torre guardada satisfactoriamene.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Torre  $torre
     * @return \Illuminate\Http\Response
     */
    public function show(Torre $torre)
    {
        return view('torres.show', compact('torre'));
    }

    /**
     * Show the form for editing the specified user
     * @param  \App\Torre  $torre
     * @return \Illuminate\Http\Response
     * @return \Illuminate\View\View
     */
    public function edit(Torre $torre)
    {
        return view('torres.edit', compact('torre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Torre  $torre
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Torre $torre)
    {
        //actualizar torres

        $torre->update($request->all());

        return redirect()->route('torres.index', $torre->id)->withStatus(__('Torre actualizada satisfactoriamene.'));

        //return view('roles.show', compact('role'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Torre  $torre
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Torre $torre)
    {
/*         $cont_nodos = Nodo::where('torre_id',$torre->id)->count();
        $contar = 0;
        while ($contar < $cont_nodos) {
            # code...
            $nodos = Nodo::where('torre_id',$torre->id)->first();
            $nodos->delete();
            $contar = $contar+1;
        } */
        $torre->delete();
        return redirect()->route('torres.index')->withStatus(__('Torre eliminada satisfactoriamente.'));
    }


}
