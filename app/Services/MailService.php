<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class MailService
{
    public function send(string $to, array $data, string $mailable, bool $queue = true, int $delayInSeconds = 0): void
    {
        $mail = new $mailable($data);

        if ($queue) { $mail->delay(Carbon::now()->addSeconds($delayInSeconds)); }

        Mail::to($to)->send($mail);
    }
}
