<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Validator;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user account for the app';


    /**
     * @inheritdoc
     */
    public function handle()
    {

        /**
         * For a new user we collect a name, email, role and a password.
         */
        $name = $this->validateInput(
            function () {
                return $this->ask('Please enter a name');
            },
            ['name', 'required']
        );

        $email = $this->validateInput(
            function () {
                return $this->ask('Please enter an email');
            },
            ['email', 'required|email']
        );

        $roles = [
            User::USERROLE_ISP => 'ISP',
            User::USERROLE_CMSSECURITY => 'CMS Security Team',
            User::USERROLE_CMSGARDEN => 'CMS Garden Admin',
        ];

        $roleName = $this->choice(
            'Please select a role',
            $roles,
            User::USERROLE_ISP
        );

        // Laravel returns the value not the key in a multiple choice,
        $role = array_search($roleName, $roles);

        // The form validation "password_confirmation" seems not to work for the console.
        $passwordValidationRules = 'required|min:8';

        $password = $this->validateInput(
            function () {
                return $this->secret('Please enter a password');
            },
            ['password', $passwordValidationRules]
        );

        $password_match = $this->validateInput(
            function () {
                return $this->secret('Please repeat your password');
            },
            ['password', $passwordValidationRules]
        );

        if ($password !== $password_match) {
            $this->warn('Your passwords did not match. Please run the command again.');
            return;
        }

        $user = new User;

        $user->name     = $name;
        $user->email    = $email;
        $user->password = bcrypt($password);
        $user->role     = $role;

        $user->save();
        $this->info(sprintf('Created user %s,', $name));
    }

    /**
     * This is a wrapper so we can ask for the console data again and again
     * until we get valid data.
     *
     * @param  mixed $method A PHP function alias
     * @param  array $rules For the validator
     * @return string
     */
    public function validateInput($method, $rules)
    {
        $value    = $method();
        $validate = $this->runValidation($rules, $value);

        if ($validate !== true) {
            $this->warn($validate);
            $value = $this->validateInput($method, $rules);
        }
        return $value;
    }

    /**
     * Create a validator and try to validate the given value.
     *
     * @param $rules
     * @param $value
     * @return bool|string
     */
    public function runValidation($rules, $value)
    {
        $validator = Validator::make(
            [$rules[0] => $value],
            [$rules[0] => $rules[1]]
        );

        if ($validator->fails()) {
            $error = $validator->errors();
            return $error->first($rules[0]);
        } else {
            return true;
        }
    }
}
