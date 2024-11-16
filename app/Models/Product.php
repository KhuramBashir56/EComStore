<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public static function refId()
    {
        return strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 20));
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class, 'product_id', 'id');
    }

    public function colorImages()
    {
        return $this->hasMany(ProductColorImage::class, 'product_id', 'id');
    }
}
