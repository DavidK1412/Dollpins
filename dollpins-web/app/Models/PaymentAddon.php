<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentAddon extends Model
{
    protected $table = 'PaymentAddon';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['id', 'payment_id', 'description', 'amount'];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

}
