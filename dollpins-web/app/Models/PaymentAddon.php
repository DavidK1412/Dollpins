<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentAddon extends Model
{
    protected $table = 'PaymentAddonRepository';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'payment_id', 'description', 'amount'];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

}
