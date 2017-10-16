<?php

namespace App\Mail;

use App\Bugreport;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BugreportMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
    * The invite instance.
    *
    * @var Bugreport
    */
    public $bugreport;

    /**
     * The mail text
     *
     * @var string
     */
    public $text;

    /**
     * Create a new message instance.
     */
    public function __construct(Bugreport $bugreport, $text)
    {
        $this->bugreport = $bugreport;
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject(
            'SIWECOS security incident report for '
            . config("app.siwecos.applications." . $this->bugreport->application)
        );

        return $this->text('emails.bugreport');
    }
}
