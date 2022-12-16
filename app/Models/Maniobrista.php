<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maniobrista extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ap_paterno',
        'ap_materno',
        'faltas_seguidas',
        'faltas_totales'
    ];
}
