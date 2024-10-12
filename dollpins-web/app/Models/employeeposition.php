<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employeeposition extends Model
{
    protected $table = 'employeeposition';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'employee_id', 'position_id'];
}
