<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use gnupg;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);

        Validator::extend('pgpkey', function ($attribute, $value, $parameters, $validator) {
            $gpg = new gnupg();
            $result = $gpg->import($value);

            return ($result !== false);
        });

        Validator::extend('pgpsignature', function ($attribute, $value, $parameters, $validator) {
            $gpg = new \gnupg();
            $plaintext = "";
            $expectedPlainText = false;

            // Check for existence of plaintext attribute
            if (!empty($parameters[0]) && array_key_exists($parameters[0], $validator->getData())) {
                $expectedPlainText = $validator->getData()[$parameters[0]];
            }

            $result = $gpg->verify($value, false, $plaintext);

            if ($result === false) {
                \Log::debug("Verification failed");

                return false;
            }

            if (empty($result[0])) {
                \Log::debug("Verification failed");

                return false;
            }

            if (($result[0]["summary"] & 0x04) == 0x04) {
                \Log::debug("Bad signature");

                return false;
            }

            if ($result[0]["fingerprint"] !== "4BE92C5424C889B894A846B099ECCB47D09C48AD") {
                \Log::debug("Invalid signing key");

                return false;
            }

            if ($expectedPlainText !== false && trim($plaintext) !== trim($expectedPlainText)) {
                \Log::debug("Mismatch between mail template and signed text");

                return false;
            }

            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
