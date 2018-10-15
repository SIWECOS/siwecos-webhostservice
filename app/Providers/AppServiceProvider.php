<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
            $gpg = new \Crypt_GPG();
            $result = $gpg->importKey($value);

            return (!empty($result["fingerprints"]));
        });

        Validator::extend('pgpsignature', function ($attribute, $value, $parameters, $validator) {
            $gpg = new \Crypt_GPG();
            $expectedPlainText = false;

            // Check for existence of plaintext attribute
            if (!empty($parameters[0]) && array_key_exists($parameters[0], $validator->getData())) {
                $expectedPlainText = $validator->getData()[$parameters[0]];
            }

            try {
                $result = $gpg->verify($value);
            } catch (\Crypt_GPG_Exception $exception) {
                \Log::debug("Verification failed:" . $exception->getMessage());

                return false;
            }

            if (empty($result[0])) {
                \Log::debug("Verification failed");

                return false;
            }

            if (!$result[0]->isValid()) {
                \Log::debug("Bad signature");

                return false;
            }

            if ($result[0]->getKeyFingerprint() !== "4BE92C5424C889B894A846B099ECCB47D09C48AD") {
                \Log::debug("Invalid signing key");

                return false;
            }

            // Extract plaintext from signature
            preg_match(
                '/Hash: \S*\n\n(.*)-----BEGIN PGP SIGNATURE-----/ms',
                str_replace("\r\n", "\n", $value),
                $matches
            );
            $plaintext = $matches[1];

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
