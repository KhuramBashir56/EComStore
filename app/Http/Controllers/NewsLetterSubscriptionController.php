<?php

namespace App\Http\Controllers;

use App\Models\NewsLetterSubscription;

class NewsLetterSubscriptionController extends Controller
{
    public function confirmation($ref_id)
    {
        $subscriber = NewsLetterSubscription::where('ref_id', $ref_id)->first();
        if (!$subscriber) {
            abort(404);
        } else {
            if ($subscriber->status == 'verified') {
                return redirect()->route('home');
            } else {
                try {
                    $subscriber->status = 'verified';
                    $subscriber->updated_at = now()->format('Y-m-d H:i:s.u');
                    $subscriber->update();
                    return view('guest.mail.news-letter-subscription-confirmation');
                } catch (\Throwable $th) {
                    return redirect()->route('home');
                }
            }
        }
    }
}
