<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public static function refId()
    {
        return strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 20));
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
