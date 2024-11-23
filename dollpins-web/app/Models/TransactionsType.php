<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionsType extends Model
{
    protected $table = 'TransactionsType';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['name'];

}
