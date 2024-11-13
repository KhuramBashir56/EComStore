<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Brand extends Model
{
    protected $table = 'brands';

    public static function refId()
    {
        return strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 20));
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(SubCategory::class, 'sub_categories_brands', 'brand_id', 'category_id', 'id', 'id');
    }
}
