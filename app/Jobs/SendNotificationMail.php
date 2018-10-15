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
            $gpg = new \Crypt_GPG(
                [
                    "homedir" => env('GPG_HOMEDIR'),
                    'binary' => env('GPG_BINARY'),
                    'agent' => "",
                    'gpgconf' => ""
                ]
            );

            try {
                // Get fingerprint and add to encryption list
                $keyInfo = $gpg->importKey($user->pgpkey);
                $gpg->addEncryptKey($keyInfo["fingerprint"]);

                // Encrypt text with key of user
                $text = $gpg->encrypt($this->data["signedemail"]);
            } catch (\Crypt_GPG_Exception $e) {
                \Log::error("GPG error while sending: " . $e->getMessage());

                continue;
            }

            \Mail::to($user->email)->send(new NotificationMail($this->data, $text));
        }
    }
}
