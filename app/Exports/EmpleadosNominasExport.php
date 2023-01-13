<?php

namespace App\Exports;
use App\Models\ListaAsitencia;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Exports\date;
use App\Models\Maniobra;
use Illuminate\Support\Facades\DB;

class EmpleadosNominasExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(int $maniobra_id, string $fecha_inicial, string $fecha_final)
    {
        $this->maniobra_id = $maniobra_id;
        $this->fecha_inicial = $fecha_inicial;
        $this->fecha_final = $fecha_final;
    }


    public function query()
    {
       return DB::table(DB::raw('maniobras'))
       ->select(DB::raw('
            CONCAT(maniobristas.name,"_",maniobristas.ap_paterno,"_",maniobristas.ap_materno),
            maniobristas.active,
            COUNT(lista_asitencias.asistencia),
            SUM(lista_asitencias.salario),
            maniobristas.faltas_totales
         '))
       ->join('turnos','turnos.maniobra_id' ,'=','maniobras.id')
       ->join('turno_fechas','turno_fechas.turno_id','=','turnos.id')
       ->join('lista_asitencias','lista_asitencias.turno_fecha_id','turno_fechas.id')
       ->join('maniobristas','lista_asitencias.maniobrista_id','maniobristas.id')
       ->groupBy('maniobristas.id')
       ->orderBy('maniobristas.id')
       ->where('maniobra_id','=',$this->maniobra_id)
       ->where('lista_asitencias.asistencia','=',1)
       ->whereBetween('turno_fechas.fecha',[$this->fecha_inicial, $this->fecha_final]);
    }

    public function headings(): array
    {
        $headings = ["Nombre","Activo","Aistencias","Cantidad a pagar", 'Total faltas'];

        return $headings;
    }
}
