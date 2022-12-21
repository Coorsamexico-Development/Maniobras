<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Maniobra extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'descripcion',
        'salario',
        'cliente_id',
        'status_maniobra_id'
    ];


    public function turnos(): HasMany
    {
        return $this->hasMany(Turno::class, 'maniobra_id');
    }
    public function turnoFechas(): HasManyThrough
    {
        return $this->hasManyThrough(TurnoFecha::class, Turno::class, 'maniobra_id', 'turno_id');
    }
}
