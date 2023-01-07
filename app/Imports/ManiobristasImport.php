<?php

namespace App\Imports;

use App\Models\ListaAsitencia;
use App\Models\Maniobrista;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
// use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class ManiobristasImport implements ToCollection, SkipsEmptyRows, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    protected $turno_fecha_id;
    protected $salario;

    public function __construct(int $turno_fecha_id, int $salario)
    {
        $this->turno_fecha_id = $turno_fecha_id;
        $this->salario = $salario;
    }



    public function collection(Collection $collection)
    {

        $rows = $collection->filter(function ($row) {
            return !empty($row['nombre']);
        });

        foreach ($rows as $row) {
            /*To mayus*/
            $nombre = str($row["nombre"])->trim()->upper();
            $ap_paterno = str($row["apellido_paterno"])->trim()->upper();
            $ap_materno = str($row["apellido_materno"])->trim()->upper();
            /*Buscamos si existente*/
            $maniobrista = Maniobrista::updateOrcreate([
                'name' =>  $nombre,
                'ap_paterno' => $ap_paterno,
                'ap_materno' => $ap_materno
            ], [
                "telefono" => $row["telefono"],
                "faltas_seguidas" => $row["faltas_seguidas"],
                "faltas_totales" => $row["faltas_totales"]
            ]);


            ListaAsitencia::updateOrcreate([
                "turno_fecha_id" => $this->turno_fecha_id,
                "maniobrista_id" => $maniobrista->id,
            ], [
                "salario" => $this->salario,
                "asistencia" => 0,
                "active" => 1,
                "imagen_url" => "-"
            ]);
        }
    }
}
