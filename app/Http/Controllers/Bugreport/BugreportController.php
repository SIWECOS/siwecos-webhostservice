<?php

namespace App\Http\Controllers\Bugreport;

use App\Bugreport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BugreportController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $applications = array();
        $exploittypes = array();

        return view('bugreport\bugreport', ['applications' => $applications, 'exploidtypes' => $exploittypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'application'  => 'required|max:11',
             'version'      => 'required|max:100',
             'signedemail' => 'required'
            ]
        );

        $bugreport = new Bugreport;

        $bugreport->application     = $request->application;
        $bugreport->version         = $request->version;
        $bugreport->signedemail    = $request->signedemail;

        $bugreport->token     = sha1(random_bytes(64));
        $bugreport->date      = date('Y-m-d H:i:s');
        $bugreport->user_id   = Auth::user()->id;

        $bugreport->save();

        return redirect('/');
    }
}
