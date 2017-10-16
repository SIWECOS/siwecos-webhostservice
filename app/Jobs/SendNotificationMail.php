<?php

namespace App\Jobs;

use App\Mail\NotificationMail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNotificationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array data
     */
    public $data;

    /**
     * SendNotificationMail constructor.
     *
     * @param  array  $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(User $users)
    {
        $users = $users->where('approved', '=', '1')->get();

        foreach ($users as $user) {
            $gpg = new \gnupg();

            // Get fingerprint and add to encryption list
            $keyinfo = $gpg->import($user->pgpkey);
            $gpg->addencryptkey($keyinfo["fingerprint"]);

            // Encrypt text with key of user
            $text = $gpg->encrypt($this->data["signedemail"]);

            \Mail::to($user->email)->send(new NotificationMail($this->data, $text));
        }
    }
}
