<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollPayments extends Model
{
    protected $table = 'PayrollPayments';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['payroll_id', 'amount', 'payment_date'];

    public function payroll()
    {
        return $this->belongsTo(Payroll::class, 'payroll_id');
    }

}
