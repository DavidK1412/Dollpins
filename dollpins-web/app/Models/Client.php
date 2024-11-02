<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Client extends Model
{
    protected $table = 'Client';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id', 'id_type_client', 'name', 'document', 'cellphone', 'mail', 'address', 'postal_code', 'mail', 'id_city'
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'id_city');
    }

    public function typeClient()
    {
        return $this->belongsTo(TypeClient::class, 'id_type_client');
    }
}
