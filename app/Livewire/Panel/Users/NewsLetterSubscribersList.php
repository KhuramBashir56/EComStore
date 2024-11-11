<?php

namespace App\Livewire\Panel\Users;

use App\Models\NewsLetterSubscription;
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
                $subscriber->delete();
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
