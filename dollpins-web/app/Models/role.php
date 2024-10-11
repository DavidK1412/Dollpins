<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = 'role'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria
    public $incrementing = true; // Es autoincremental
    protected $keyType = 'int'; // Tipo de clave primaria

    protected $fillable = ['name']; // Atributos asignables
}
