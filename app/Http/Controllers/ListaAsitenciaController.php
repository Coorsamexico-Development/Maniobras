<?php

namespace App\Http\Controllers;

use App\Exports\EmpleadosNominasExport;
use App\Exports\EmpleadosRhExport;
use App\Exports\ManiobristasExampleExport;
use App\Imports\ManiobristasImport;
use App\Models\ListaAsitencia;
use App\Models\Maniobra;
use App\Models\Turno;
use App\Models\TurnoFecha;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr\Cast\Object_;

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
        $turno_maniobra = Turno::select('turnos.*')
            ->where('turnos.id', '=', $request['turno'])
            ->get();

        $turnoFecha = TurnoFecha::updateOrCreate([
            'fecha' => $request['fecha'],
            'turno_id' => $request['turno'],
            'cant_asistencia' => $turno_maniobra->cant_personal //definir como crear esto
        ]);

        $maniobra_salario = Maniobra::select('maniobras.*')
            ->where('maniobras.id', '=', $turno_maniobra[0]->maniobra_id)
            ->get();

        $turno_fecha_id = $turnoFecha->id;

        Excel::import(new ManiobristasImport($turno_fecha_id, $maniobra_salario[0]->salario), $request['file']);
        return redirect()->back();
    }

    
    public function exportExample()
    {
        return Excel::download(new ManiobristasExampleExport, 'example.xlsx');
    }
    

    public function consultarReporteRH($maniobra_id)
    {

        return Excel::download(new EmpleadosRhExport($maniobra_id),'reportRh.xlsx');
    }


    public function consultarReporteNomina($maniobra_id, $fecha_inicial, $fecha_final)
    {
        return Excel::download(new EmpleadosNominasExport($maniobra_id, $fecha_inicial, $fecha_final), 'reportNominas.xlsx');
    }

    /*
    public function exportReporteRh(Request $request)
    {

        return $request;
        // return $arrayExcel;

        //return Excel::download(new EmpleadosRhExport($maniobra_id),'reportRh.xlsx');
    }
    */

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
