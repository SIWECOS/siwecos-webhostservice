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
            'name' => 'required|max:255',
            'email' => 'required|max:191|unique:invites|unique:users',
            'reason' => 'required|max:500'
        ], [
            'email.unique' => 'The email address is already used in and invite and/or user account'
        ]);

        $invite = new Invite;

        $invite->name = $request->name;
        $invite->email = $request->email;
        $invite->reason = $request->reason;
        $invite->token = sha1(random_bytes(64));
        $invite->send_by =  Auth::user()->id;

        $invite->save();

        Mail::to($request->email)->send(new InviteMail($invite, Auth::user()));

        return redirect('/');
    }
}
