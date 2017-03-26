<?php

namespace App\Http\Controllers\Invite;

use App\Invite;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InviteController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
  }

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
    $invite->send_at = '2017-03-26 10:00:00';
    $invite->send_by = '1';

    $invite->save();

    return redirect('/');

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

}
