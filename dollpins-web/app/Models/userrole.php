<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userrole extends Model
{
    protected $table = 'userrole';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['id', 'user_id', 'role_id'];

    public function user()
    {
        return $this->belongsTo(authuser::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(role::class, 'role_id');
    }
}
