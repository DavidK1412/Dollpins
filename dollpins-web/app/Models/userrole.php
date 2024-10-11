<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userrole extends Model
{
    protected $table = 'userrole'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria
    public $incrementing = false; // No es autoincremental porque usamos UUID
    protected $keyType = 'string'; // Tipo de clave primaria
    public $timestamps = false; // Deshabilitar timestamps

    protected $fillable = ['id', 'user_id', 'role_id'];

    public function user()
    {
        return $this->belongsTo(authuser::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(role::class, 'role_id');
    }
}
