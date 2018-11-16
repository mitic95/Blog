<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class WelcomeAgain
 * @package App\Mail
 */
class WelcomeAgain extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * WelcomeAgain constructor.
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.welcome-again');
    }
}
