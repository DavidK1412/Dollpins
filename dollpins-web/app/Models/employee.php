<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    protected $table = 'employee'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria
    public $incrementing = false; // No es autoincremental porque usamos UUID
    protected $keyType = 'string'; // Tipo de clave primaria
    public $timestamps = false; // Esto desactiva el manejo de created_at y updated_at


    protected $fillable = ['id', 'name', 'document', 'email', 'phone', 'address', 'city_id', 'user_id']; // Atributos asignables

    public function user()
    {
        return $this->belongsTo(authuser::class, 'user_id');
    }

    public function city()
    {
        return $this->belongsTo(city::class, 'city_id');
    }

    public function positions()
    {
        return $this->hasMany(employeeposition::class, 'employee_id');
    }

}
