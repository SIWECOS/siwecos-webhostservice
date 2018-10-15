<?php

namespace App\Jobs;

use App\Bugreport;
use App\Mail\BugreportMail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendBugreportMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Bugreport bugreport model
     */
    public $bugreport;

    /**
     * SendBugreportMail constructor.
     *
     * @param  Bugreport  $bugreport
     */
    public function __construct(Bugreport $bugreport)
    {
        $this->bugreport = $bugreport;
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
                $text = $gpg->encrypt($this->bugreport->signedemail);
            } catch (\Crypt_GPG_Exception $e) {
                \Log::error("GPG error while sending: " . $e->getMessage());

                continue;
            }

            \Mail::to($user->email)->send(new BugreportMail($this->bugreport, $text));
        }
    }
}
