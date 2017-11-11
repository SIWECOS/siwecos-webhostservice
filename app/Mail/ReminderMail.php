<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
    * The user instance.
    *
    * @var User
    */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param   User  $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject(
            'SIWECOS - periodic account check'
        );

        return $this->text('emails.reminder');
    }
}
