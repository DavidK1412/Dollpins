<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecoveryPassword extends Model
{
    protected $table = 'RecoveryPassword';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['id', 'user_id', 'token'];

    public function user()
    {
        return $this->belongsTo(AuthUser::class, 'user_id');
    }
}
