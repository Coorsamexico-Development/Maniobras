<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaAsitencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'turno_fecha_id',
        'maniobrista_id',
        'salario',
        'asistencia',
        'imagen_url'
    ];
}
