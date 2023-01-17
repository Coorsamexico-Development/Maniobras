<?php

namespace App\Http\Controllers;

use App\Models\LogActivo;
use Illuminate\Http\Request;

class LogActivoController extends Controller
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
        LogActivo::create([
            'maniobrista_id' => $request['maniobrista_id'],
            'user_id' => $request['user_id'],
            'fecha' => $request['fecha'], 
            'descripcion' => $request['descripcion'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LogActivo  $logActivo
     * @return \Illuminate\Http\Response
     */
    public function show(LogActivo $logActivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LogActivo  $logActivo
     * @return \Illuminate\Http\Response
     */
    public function edit(LogActivo $logActivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LogActivo  $logActivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LogActivo $logActivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LogActivo  $logActivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogActivo $logActivo)
    {
        //
    }
}
