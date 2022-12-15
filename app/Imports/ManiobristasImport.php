<?php

namespace App\Imports;

use App\Models\Maniobrista;
use Maatwebsite\Excel\Concerns\ToModel;

class ManiobristasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Maniobrista([
            //
        ]);
    }
}
