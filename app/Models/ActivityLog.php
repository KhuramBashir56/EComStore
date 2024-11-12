<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Model
{
    public $timestamps = false;

    protected $table = 'activity_logs';

    public function casts(): array
    {
        return [
            'last_activity' => 'datetime:Y-m-d H:i:s.u',
        ];
    }

    public static function activity($ref_id, $type, $subject, $description)
    {
        $activity = new ActivityLog;
        $activity->user_id = Auth::user()->id ?? null;
        $activity->ref_id = $ref_id;
        $activity->type = $type;
        $activity->subject = $subject;
        $activity->description = $description;
        $activity->ip_address = request()->ip();
        $activity->user_agent = request()->header('User-Agent');
        $activity->last_activity = now()->format('Y-m-d H:i:s.u');
        $activity->save();
        return $activity;
    }

    public static function activities(): array
    {
        return [
            'Account',
            'Newsletter',
            'Product Unit',
            'Product Brand',
            'Product Category',
            'Product Sub Category'
        ];
    }
}
