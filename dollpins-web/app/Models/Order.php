<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'Order';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['id', 'client_id', 'status_id', 'employee_id', 'discount', 'extras', 'sub_total', 'total', 'delivery_address'];

    public function client() {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function status() {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }

    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
