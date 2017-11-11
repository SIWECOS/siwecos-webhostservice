<?php

namespace App\Mail;

use App\Bugreport;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
    * The data array
    *
    * @var array
    */
    public $data;

    /**
     * The mail text
     *
     * @var string
     */
    public $text;

    /**
     * Create a new message instance.
     *
     * @param $data
     * @param $text
     */
    public function __construct($data, $text)
    {
        $this->data = $data;
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
            'SIWECOS security pre-notification '
            . config("app.siwecos.applications." . $this->data["application"])
        );

        return $this->text('emails.notification');
    }
}
