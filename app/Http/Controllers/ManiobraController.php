<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Maniobra;
use App\Models\Maniobrista;
use App\Models\StatusManiobra;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ManiobraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $maniobras = Maniobra::select(
        'maniobras.id AS maniobra_id',
        'maniobras.name AS maniobra_name',
        'maniobras.descripcion AS maniobra_desc',
        'maniobras.salario AS maniobra_salario',
        'maniobras.status_maniobra_id AS maniobra_status',
        'clientes.name AS cliente_name'
        )
        ->join('clientes','maniobras.cliente_id','clientes.id')
        ->get();


        $maniobristas = Maniobrista::select(
            'maniobristas.*'
        )
        ->where('maniobristas.active','=',1)
        ->get();

        $clientes = Cliente::all();
        $status_maniobras = StatusManiobra::all();
        
        return Inertia::render('Maniobras/Maniobras.Index', 
        [
            'maniobras' => $maniobras,
            'clientes' => $clientes,
            'status_maniobras' => $status_maniobras,
            'maniobristas' => $maniobristas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Maniobra::create([
            'name' => $request['name'],
            'descripcion' => $request['descripcion'],
            'salario' => $request['salario'],
            'cliente_id' =>$request['cliente_id'],
            'status_maniobra_id'=> $request['status_maniobra_id']
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Maniobra  $maniobra
     * @return \Illuminate\Http\Response
     */
    public function show(Maniobra $maniobra)
    {
        //
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maniobra  $maniobra
     * @return \Illuminate\Http\Response
     */
    public function edit(Maniobra $maniobra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Maniobra  $maniobra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maniobra $maniobra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maniobra  $maniobra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maniobra $maniobra)
    {
        //
    }
}
