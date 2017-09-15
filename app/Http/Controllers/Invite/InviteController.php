<?php

namespace App\Http\Controllers\Invite;

use App\Invite;
use App\Mail\InviteMail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class InviteController extends Controller
{
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return View('invite/create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->validate($request, [
        'firstname' => 'required|max:255',
        'lastname' => 'required|max:255',
        'email' => 'required|max:255',
        'reason' => 'required|max:500'
        ]);

        $invite = new Invite;

        $invite->firstname = $request->firstname;
        $invite->lastname = $request->lastname;
        $invite->email = $request->email;
        $invite->reason = $request->reason;
        $invite->token = sha1(random_bytes(64));
        $invite->send_at = date('Y-m-d H:i:s');
        $invite->send_by =  Auth::user()->id;

        $invite->save();

        Mail::to($request->email)->send(new InviteMail($invite));

        return redirect('/');
    }
}
