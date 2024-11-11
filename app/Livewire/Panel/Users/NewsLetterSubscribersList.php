<?php

namespace App\Livewire\Panel\Users;

use App\Models\ActivityLog;
use App\Models\NewsLetterSubscription;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class NewsLetterSubscribersList extends Component
{
    use WithPagination;

    public $range = 25;

    public $search;

    public function deleteSubscriber(NewsLetterSubscription $subscriber)
    {
        $this->authorize('admin');
        if (!$subscriber) {
            $this->dispatch('alert', type: 'error', message: 'Subscriber not found.');
        } else {
            try {
                DB::transaction(function () use ($subscriber) {
                    $subscriber->delete();
                    ActivityLog::activity($subscriber->id, 'delete', 'Newsletter', 'Deleted email address is: (' . $subscriber->email . ')');
                });
                $this->dispatch('alert', type: 'success', message: 'Subscriber deleted successfully.');
            } catch (\Throwable $th) {
                $this->dispatch('alert', type: 'error', message: 'Something went wrong please try again.');
            }
        }
    }

    #[Layout('components.layouts.panel')]
    public function render()
    {
        if (empty($this->range)) {
            $this->range = 25;
        }
        return view('livewire.panel.users.news-letter-subscribers-list', [
            'subscribers' => NewsLetterSubscription::where('email', 'LIKE', $this->search . '%')->select('id', 'email', 'status', 'updated_at')->paginate($this->range),
        ]);
    }
}
