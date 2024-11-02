<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'Product';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['id', 'name', 'description', 'price', 'stock', 'category_id', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
