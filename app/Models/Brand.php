<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    public static function refId()
    {
        return strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 20));
    }
}
