<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthUser extends Authenticatable
{
    protected $table = 'AuthUser';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = ['id', 'email', 'password', 'active'];

    public function roles()
    {
        return $this->hasMany(UserRole::class, 'user_id');
    }
}
