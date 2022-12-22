<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Maniobra;
use App\Models\TurnoFecha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TurnoFechaController extends Controller
{
    //

    public function index(Maniobra $maniobra, Request $request)
    {
        $validated =  $request->validate([
            'date' => ['required', 'date']
        ]);
        $turnos = $maniobra->turnoFechas()
            ->select('turno_fechas.*', 'turnos.name as name')
            ->selectRaw('count(lista_asitencias.id) as asistencias_confirmadas')
            ->leftJoin('lista_asitencias', function ($join) {
                $join->on('turno_fechas.id', 'lista_asitencias.turno_fecha_id')
                    ->on('lista_asitencias.asistencia', '=', DB::raw(1));
            })->groupBy(['turno_fechas.id', 'turnos.name']);

        if ($request->has('date')) {
            $turnos->whereDate('turno_fechas.fecha', $validated['date']);
        }

        if ($request->has('search')) {
            $search = '%' . str_replace('%', '\%', $request->input('search')) . '%';
            $turnos->where('turnos.name', 'like', $search);
        }

        return response()->json([
            'data' =>  $turnos->get()
        ]);
    }


    public function update(Request $request, TurnoFecha $turnoFecha)
    {
        $validated =   $request->validate([
            'active' => ['required', 'boolean']
        ]);

        $turnoFecha->update($validated);
        return response()->json([
            'message' => 'UPDATED'
        ]);
    }
}
