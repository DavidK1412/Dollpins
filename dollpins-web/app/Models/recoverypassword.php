<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class recoverypassword extends Model
{
    protected $table = 'recoverypassword';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; // Esto desactiva el manejo de created_at y updated_at

    protected $fillable = ['id', 'user_id', 'token'];

    public function user()
    {
        return $this->belongsTo(authuser::class, 'user_id');
    }
}
