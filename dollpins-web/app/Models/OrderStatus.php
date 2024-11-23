<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class OrderStatus extends Model
{
    protected $table = 'OrderStatus';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['name'];

}
