<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
//    protected $table = 'categories';
        protected $guarded = [];
        public  function getRouteKeyName()
        {
            return 'slug';
        }

    public function products(){
            return $this->hasMany(Product::class, 'cat_id');
        }
}
