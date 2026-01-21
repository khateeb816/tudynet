<?php

namespace App\Helpers;

use App\Mail\GenericMail;
use Illuminate\Support\Facades\Mail;

class MailHelper
{
    /**
     * Send a generic email.
     *
     * @param mixed $to Recipient(s) (string email or array of emails)
     * @param string $subject Email subject
     * @param string $content Email content (HTML supported)
     * @return void
     */
    public static function send($to, $subject, $content)
    {
        if (empty($to)) {
            return;
        }

        Mail::to($to)->send(new GenericMail($subject, $content));
    }
}
