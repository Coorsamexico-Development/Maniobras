<?php

namespace App\Imports;

use App\Models\Maniobra;
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
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            /*To mayus*/
           $nombre = strtoupper($row["nombre"]);
           $ap_paterno = strtoupper($row["apellido_paterno"]);
           $ap_materno = strtoupper($row["apellido_materno"]);

           /*Recorrido de lo existente*/
           $all_maniobristas = Maniobrista::select('maniobristas.*')
           ->where('nombre','LIKE','%'.$nombre.'%')
           ->where('ap_paterno','LIKE','%'.$ap_paterno.'%')
           ->where('ap_materno','LIKE','%'.$ap_materno.'%')
           ->get();

           if(count($all_maniobristas) > 0) //si existe o el arreglo es mayo a cero
           {
              Maniobra::update();
           }
           else
           {
             Maniobrista::create([
                "name" => $row["nombre"],
                "ap_paterno" => $row["apellido_paterno"],
                "ap_materno" => $row["apellido_materno"],
                "telefono" => $row["telefono"],
                "faltas_seguidas" => $row["faltas_seguidas"],
                "faltas_totales" => $row["faltas_totales"]
             ]);
           }

            /*
            Maniobrista::create([
                "name" => $nombre
            ]);
            */
        }
    }
}
