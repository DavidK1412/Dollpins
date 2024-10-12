<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class authuser extends Authenticatable
{
    protected $table = 'authuser';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = ['id', 'email', 'password', 'active'];

    public function roles()
    {
        return $this->hasMany(userrole::class, 'user_id');
    }
}
