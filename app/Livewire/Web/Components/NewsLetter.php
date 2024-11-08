<?php

namespace App\Livewire\Web\Components;

use App\Mail\NewsLetterSubscriptionEmail;
use App\Models\NewsLetterSubscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class NewsLetter extends Component
{
    public $email;

    public function subscribe()
    {
        $this->validate([
            'email' => ['required', 'email', 'max:64', 'unique:' . NewsLetterSubscription::class],
        ], [
            'email.unique' => 'You are already subscribed to our newsletter please check your inbox.',
        ]);
        try {
            DB::transaction(function () {

                $subscriber = new NewsLetterSubscription;
                $subscriber->ref_id = NewsLetterSubscription::refId();
                $subscriber->user_id = Auth::user()->id ?? null;
                $subscriber->email = $this->email;
                $subscriber->status = 'unsubscribed';
                $subscriber->created_at = now()->format('Y-m-d H:i:s.u');
                $subscriber->save();
                Mail::to($this->email)->send(new NewsLetterSubscriptionEmail($subscriber->ref_id));
                $this->reset(['email']);
                $this->dispatch('alert', type: 'success', message: 'You have successfully subscribed to our newsletter. Please check your inbox to confirm your email.');
            });
        } catch (\Throwable $th) {
            $this->dispatch('alert', type: 'error', message: 'Something went wrong you are not subscribed. Please try again later.');
        }
    }

    public function render()
    {
        return view('livewire.web.components.news-letter');
    }
}
