<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class authuser extends Authenticatable
{
    protected $table = 'authuser'; // Solo minúsculas y sin comillas
    protected $primaryKey = 'id'; // Primary key
    public $incrementing = false; // Not auto-incrementing because we use UUID
    protected $keyType = 'string'; // Primary key type
    public $timestamps = true; // Enable timestamps if you have them in the table

    protected $fillable = ['id', 'email', 'password', 'active']; // Fillable attributes

    public function roles()
    {
        return $this->hasMany(userrole::class, 'user_id');
    }
}
