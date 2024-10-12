<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;


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
