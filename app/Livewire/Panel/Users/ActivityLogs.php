<?php

namespace App\Livewire\Panel\Users;

use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ActivityLogs extends Component
{
    #[Validate(['required'])]
    public $from;

    #[Validate(['after_or_equal:from'])]
    public $to;

    #[Validate(['required', 'string'])]
    public $subject;

    public $range = 25;

    public function resetFiller()
    {
        $this->reset(['from', 'to', 'subject']);
        $this->range = 25;
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        $query = ActivityLog::where('user_id', Auth::user()->id)->select('subject', 'type', 'description', 'ip_address', 'last_activity')->latest('last_activity');
        $this->range = $this->range ?? 25;
        $activities = clone $query;
        if (!empty($this->subject)) {
            $activities = $activities->where('subject', $this->subject);
        }
        if (!empty($this->from) && !empty($this->to)) {
            $from = Carbon::parse($this->from)->startOfDay();
            $to = Carbon::parse($this->to)->endOfDay();
            $activities = $activities->whereBetween('last_activity', [$from, $to]);
        }
        return view('livewire.panel.users.activity-logs', [
            'activities' => $activities->paginate($this->range),
            'subjects' => ActivityLog::activities()
        ]);
    }
}
