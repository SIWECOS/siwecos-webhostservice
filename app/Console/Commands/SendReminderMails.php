<?php

namespace App\Console\Commands;

use App\Mail\ReminderMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendReminderMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sendreminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends the period reminder mails that keep our address database up-to-date';

    /**
     * The user model
     *
     * @var User
     */
    protected $userModel;

    /**
     * Create a new command instance.
     *
     * @param User $userModel
     */
    public function __construct(User $userModel)
    {
        parent::__construct();

        $this->userModel = $userModel;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = $this->userModel->where('last_reminder', '<=', Carbon::now()->modify('-90 days'))->get();

        $this->info('Found ' . count($users) . ' users that will be reminded to check their account:');

        foreach ($users as $user) {
            $user->last_reminder_token = sha1(random_bytes(64));
            $user->last_reminder = Carbon::now();
            $user->last_reminder_confirmed = 0;

            \Mail::to($user->email)->send(new ReminderMail($user));

            $this->info('E-Mail sent to user ' . $user->email);

            $user->save();
        }
    }
}
