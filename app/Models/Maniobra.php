<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
