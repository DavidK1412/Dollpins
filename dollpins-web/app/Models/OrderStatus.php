<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class OrderStatus extends Model
{
    protected $table = 'OrderStatusRepository';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['name'];

}
