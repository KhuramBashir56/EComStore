<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsLetterSubscriptionEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $ref_id;

    public function __construct($ref_id)
    {
        $this->ref_id = $ref_id;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: config('app.name') . ' - News Letter Subscription Confirmation',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.news-letter-subscription-email',
            with: [
                'ref_id' => $this->ref_id
            ]
        );
    }
}
