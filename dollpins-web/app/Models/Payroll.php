<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $table = 'Payroll';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['id', 'employee_id', 'salary', 'status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
