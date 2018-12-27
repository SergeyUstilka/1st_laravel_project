<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='product';
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function photos(){
        return $this->hasMany(Photo::class, 'product_id', 'id');
        return $this->hasMany(Photo::class, 'product_id', 'id');
    }
    public function mainPhoto(){
    }
}
