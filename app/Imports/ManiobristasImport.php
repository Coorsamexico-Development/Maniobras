<?php

namespace App\Imports;

use App\Models\ListaAsitencia;
use App\Models\Maniobrista;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ManiobristasImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function __construct(int $turno_fecha_id, int $salario)
    {
      $this ->turno_fecha_id = $turno_fecha_id;   

      $this -> salario = $salario;
    }



    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            /*To mayus*/
           $nombre = strtoupper($row["nombre"]);
           $ap_paterno = strtoupper($row["apellido_paterno"]);
           $ap_materno = strtoupper($row["apellido_materno"]);

           /*Recorrido de lo existente*/
           $searchManiobrista = Maniobrista::select('maniobristas.*')
           ->where('name','LIKE','%'.$nombre.'%')
           ->where('ap_paterno','LIKE','%'.$ap_paterno.'%')
           ->where('ap_materno','LIKE','%'.$ap_materno.'%')
           ->get();

           $newManiobrista = null;
           $newLista = null;

           if(count($searchManiobrista) > 0) //si existe o el arreglo es mayo a cero
           {
               Maniobrista::where('name','LIKE','%'.$nombre.'%')
              ->where('ap_paterno','LIKE','%'.$ap_paterno.'%')
              ->where('ap_materno','LIKE','%'.$ap_materno.'%')
              ->update([
                "name" => $nombre,
                "ap_paterno" => $ap_paterno,
                "ap_materno" => $ap_materno,
                "telefono" => $row["telefono"],
                "faltas_seguidas" => $row["faltas_seguidas"],
                "faltas_totales" => $row["faltas_totales"]
              ]);

             $newManiobrista = Maniobrista::select('maniobristas.*')
             ->where('name','LIKE','%'.$nombre.'%')
             ->where('ap_paterno','LIKE','%'.$ap_paterno.'%')
             ->where('ap_materno','LIKE','%'.$ap_materno.'%')
             ->get();
 

             $newlista = ListaAsitencia::updateOrcreate([
                "turno_fecha_id" => $this->turno_fecha_id,
                "maniobrista_id" => $newManiobrista[0]-> id,
                "salario" => $this ->salario,
                "asistencia" => 0,
                "active" => 1,
                "imagen_url" => "-"
             ]);

           }
           else
           {
              $newManiobrista = Maniobrista::create([
                "name" => $nombre,
                "ap_paterno" => $ap_paterno,
                "ap_materno" => $ap_materno,
                "telefono" => $row["telefono"],
                "faltas_seguidas" => $row["faltas_seguidas"],
                "faltas_totales" => $row["faltas_totales"]
             ]);

             
            
             $newlista = ListaAsitencia::updateOrcreate([
                "turno_fecha_id" => $this->turno_fecha_id,
                "maniobrista_id" => $newManiobrista-> id,
                "salario" => $this ->salario,
                "asistencia" => 0,
                "active" => 1,
                "imagen_url" => "-"
             ]);


           }
        }
    }
}
