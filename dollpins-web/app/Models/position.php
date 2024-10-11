<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class position extends Model
{
    protected $table = 'position'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria
    public $incrementing = true; // Es autoincremental
    protected $keyType = 'int'; // Tipo de clave primaria

    protected $fillable = ['name']; // Atributos asignables
}
