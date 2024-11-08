<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsLetterSubscription;

class NewsLetterSubscriptionController extends Controller
{
    public function confirmation($ref_id)
    {
        $subscriber = NewsLetterSubscription::where('ref_id', $ref_id)->first();
        if (!$subscriber) {
            abort(404);
        } else {
            if ($subscriber->status == 'subscribed') {
                return redirect()->route('home');
            } else {
                try {
                    $subscriber->status = 'subscribed';
                    $subscriber->updated_at = now()->format('Y-m-d H:i:s.u');
                    $subscriber->update();
                    return view('guest.mail.news-letter-subscription-email');
                } catch (\Throwable $th) {
                    return redirect()->route('home');
                }
            }
        }
    }
}
