<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsLetterSubscription extends Model
{
    public $timestamps = false;

    protected $table = 'news_letter_subscribers';

    public function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d H:i:s.u',
            'updated_at' => 'datetime:Y-m-d H:i:s.u',
        ];
    }

    public static function refId()
    {
        return strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 20));
    }
}
