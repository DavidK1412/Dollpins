<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'Category';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    protected $keyType = 'int';
}
