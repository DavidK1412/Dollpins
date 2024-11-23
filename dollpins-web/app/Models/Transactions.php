<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'Transactions';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['id', 'type_id', 'amount', 'description'];

    public function type()
    {
        return $this->belongsTo(TransactionsType::class, 'type_id');
    }

}
