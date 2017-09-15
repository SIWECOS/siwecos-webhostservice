<?php

namespace App\Mail;

use App\Invite;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
    * The invite instance.
    *
    * @var invite
    */
    public $invite;

    /**
     * The user that sent the invite
     *
     * @var User
     */
    public $invitee;

    /**
     * Create a new message instance.
     */
    public function __construct(Invite $invite, User $invitee)
    {
        $this->invite = $invite;
        $this->invitee = $invitee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text('emails.invite');
    }
}
