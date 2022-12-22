<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TurnoFecha extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'cant_asistencia',
        'turno_id',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function listaAsitencias(): HasMany
    {
        return $this->hasMany(listaAsitencia::class, 'turno_fecha_id');
    }
}
