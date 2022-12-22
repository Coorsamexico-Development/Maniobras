<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListaAsitencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'turno_fecha_id',
        'maniobrista_id',
        'salario',
        'asistencia',
        'imagen_url',
        'active',
    ];

    protected $casts = [
        'asistencia' => 'boolean',
    ];


    public function maniobrista(): BelongsTo
    {
        return $this->belongsTo(Maniobrista::class, 'maniobrista_id');
    }
}
