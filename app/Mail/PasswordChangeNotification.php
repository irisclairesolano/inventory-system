<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordChangeNotification extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $timestamp;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->timestamp = now()->format('Y-m-d H:i:s');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Password Changed - Inventory Management System',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.password-change',
        );
    }
}
