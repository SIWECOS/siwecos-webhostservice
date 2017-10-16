<?php

namespace App\Http\Controllers\User;

use App\Bugreport;
use App\Jobs\SendBugreportMail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Webpatser\Countries\Countries;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  User  $users  user model
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $users, Countries $countries)
    {
        $users = $users->orderBy('created_at', 'desc')->paginate(30);

        $countries = $countries->getListForSelect();

        return view('user.index', compact('users', 'countries'));
    }
}
