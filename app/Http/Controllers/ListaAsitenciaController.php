<?php

namespace App\Http\Controllers;

use App\Imports\ManiobristasImport;
use App\Models\ListaAsitencia;
use App\Models\TurnoFecha;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ListaAsitenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        TurnoFecha::create([
            'fecha' => $request['fecha'],
            'turno_id' => $request['turno'],
            'cant_asistencia' => 1  //definir como crear esto
       ]);
       
       Excel::import(new ManiobristasImport, $request['file']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListaAsitencia  $listaAsitencia
     * @return \Illuminate\Http\Response
     */
    public function show(ListaAsitencia $listaAsitencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ListaAsitencia  $listaAsitencia
     * @return \Illuminate\Http\Response
     */
    public function edit(ListaAsitencia $listaAsitencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListaAsitencia  $listaAsitencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListaAsitencia $listaAsitencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListaAsitencia  $listaAsitencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListaAsitencia $listaAsitencia)
    {
        //
    }
}
