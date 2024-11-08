<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    protected $table = 'roles';

    public static function admin()
    {
        return Self::where('slug', 'admin')->first();
    }

    public static function buyer()
    {
        return Self::where('slug', 'buyer')->first();
    }
}
