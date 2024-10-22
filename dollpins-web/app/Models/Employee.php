<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'Employee';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;


    protected $fillable = ['id', 'name', 'document', 'email', 'phone', 'address', 'city_id', 'user_id']; // Atributos asignables

    public function user()
    {
        return $this->belongsTo(AuthUser::class, 'user_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function positions()
    {
        return $this->hasMany(EmployeePosition::class, 'employee_id');
    }

}
