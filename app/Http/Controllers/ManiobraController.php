<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ListaAsitencia;
use App\Models\Maniobra;
use App\Models\Maniobrista;
use App\Models\StatusManiobra;
use App\Models\TurnoFecha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ManiobraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

        
        $maniobristas = [];

       if($request->has('turno_id') && $request->has('fecha'))
       {
         $turno_fecha_id = TurnoFecha::select()
         ->where('turno_id','=', $request['turno_id'])
         ->where('fecha','LIKE' ,'%'.$request['fecha'].'%')
         ->get();

          if(count($turno_fecha_id) > 0)
          {
            $maniobristas = ListaAsitencia::select()
            ->join('maniobristas','lista_asitencias.maniobrista_id','maniobristas.id')
            ->where('turno_fecha_id','=',$turno_fecha_id[0]->id)
            ->get();
          }

       }

    
       $total_turno_fecha = TurnoFecha::select(
        'turno_fechas.fecha',
        'turno_fechas.cant_asistencia',
         DB::raw('COUNT(lista_asitencias.maniobrista_id) AS lista_asistencia'))
        ->join('lista_asitencias','turno_fechas.id','lista_asitencias.turno_fecha_id')
        ->groupby('lista_asitencias.turno_fecha_id')
        ->get();


        $clientes = Cliente::all();
        $status_maniobras = StatusManiobra::all();
        
        return Inertia::render('Maniobras/Maniobras.Index', 
        [
            'maniobras' => $maniobras,
            'clientes' => $clientes,
            'status_maniobras' => $status_maniobras,
            'maniobristas' => $maniobristas,
            'total_turnos_fecha' => $total_turno_fecha
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
