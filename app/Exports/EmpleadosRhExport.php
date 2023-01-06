<?php

namespace App\Exports;

use App\Models\ListaAsitencia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class EmpleadosRhExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(int $maniobra_id)
    {
        $this->maniobra_id = $maniobra_id;
    }

    public function query()
    {
        $query = ListaAsitencia::select(
            'maniobristas.name AS NOMBRE',
            'maniobristas.ap_paterno AS APELLIDO_PATERNO',
            'maniobristas.ap_materno AS APELLIDO_MATERNO',
            'turno_fechas.fecha AS FECHA',
            'lista_asitencias.asistencia AS ASISTENCIA'
        )
        ->join('maniobristas','lista_asitencias.maniobrista_id','maniobristas.id')
        ->join('turno_fechas','lista_asitencias.turno_fecha_id','turno_fechas.id')
        ->join('turnos','turno_fechas.turno_id','turnos.id')
        ->join('maniobras','turnos.maniobra_id','maniobras.id')
        ->where('maniobras.id','=',$this->maniobra_id)
        ->get();

        for ($i=0; $i < count($query) ; $i++) 
        { 
            
        }

    }

    public function headings(): array
    {
        return ["Nombre", "Apellido_Paterno", "Apellido_Materno" ];
    }
}
