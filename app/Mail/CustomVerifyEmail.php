<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $url;
    public $expiredMinutes = 60; // Link expired dalam 60 menit

    public function __construct($user)
    {
        $this->user = $user;

        $this->url = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes($this->expiredMinutes),
            ['id' => $user->getKey(), 'hash' => sha1($user->getEmailForVerification())]
        );
    }

    public function build()
    {
        return $this->subject('Verify Your Email Address - NexGenbot Hospital')
            ->view('emails.verify')
            ->with([
                'user' => $this->user,
                'url' => $this->url,
                'expiredMinutes' => $this->expiredMinutes,
            ]);
    }
}
