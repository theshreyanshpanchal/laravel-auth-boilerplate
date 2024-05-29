<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOtp extends Mailable
{
    use Queueable, SerializesModels;

    public string $otp;

    public function __construct(array $data)
    {
        $this->otp = $data['otp'];
    }

    public function envelope(): Envelope
    {
        $subject = __('Otp Verification', [ 'otp' => $this->otp ]);

        return new Envelope( subject: $subject );
    }

    public function content(): Content
    {
        return new Content( markdown: 'emails.send-otp' );
    }
}
