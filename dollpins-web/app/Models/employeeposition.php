<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employeeposition extends Model
{
    protected $table = 'employeeposition'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria
    public $incrementing = false; // No es autoincremental porque usamos UUID
    protected $keyType = 'string'; // Tipo de clave primaria

    protected $fillable = ['id', 'employee_id', 'position_id']; // Atributos asignables
}
