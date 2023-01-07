<?php

namespace App\Exports;

use App\Models\Maniobristas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ManiobristasExampleExport implements WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return ["nombre", "apellido_paterno", "apellido_materno", "telefono"];
    }
}
