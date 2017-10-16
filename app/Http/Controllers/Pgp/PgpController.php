<?php

namespace App\Http\Controllers\Pgp;

use App\PgpHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PgpController extends Controller
{
    public function verifySignature(Request $request)
    {
        $this->validate(
            $request,
            [
                'signedtext'  => 'pgpsignature:plaintext'
            ]
        );

        return \Response::json('Verification succeeded');
    }
}
