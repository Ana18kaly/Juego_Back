<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;


class ActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Activa tu cuenta',
            from: new Address('anakalydelgado14@gmail.com', 'THE GAME')
        );
    }

    public function content(): Content
{
    return new Content(
        view: 'emails.activation', // asegúrate que tu blade esté en resources/views/emails/activation.blade.php
        with: ['url' => $this->url],
    );
}


    public function attachments(): array
    {
        return [];
    }
}
