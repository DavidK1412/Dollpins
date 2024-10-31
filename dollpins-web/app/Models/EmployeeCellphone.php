<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeCellphone extends Model
{
    protected $table = 'EmployeeCellphone'; 
    public $timestamps = false;

    protected $fillable = [
        'id', 'employee_id', 'cellphone', 'relationship' // Atributos asignables
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
