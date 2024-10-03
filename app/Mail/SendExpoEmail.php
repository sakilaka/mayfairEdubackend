<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendExpoEmail extends Mailable /* implements ShouldQueue */
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->data['subject'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'sendMail',
        );
    }

    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->view('sendMail');
    }
}
