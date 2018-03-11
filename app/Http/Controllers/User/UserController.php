<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $countries[0] = '- none selected -';

        return view('user.index', compact('users', 'countries'));
    }

    /**
     * Confirms a period reminder for a user
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmReminder(Request $request, User $userModel)
    {
        // Check if the token is present
        if (!$request->input('token')) {
            return redirect('/login');
        }

        // Check if the user id is present
        if (!$request->input('user')) {
            return redirect('/login');
        }

        $user = $userModel->where('last_reminder_token', '=', $request->input('token'))
            ->where('id', '=', $request->input('user'))
            ->first();

        if ($user === null) {
            throw new NotFoundHttpException();
        }

        $user->last_reminder_confirmed = 1;
        $user->last_reminder_token = null;
        $user->save();

        \Session::flash('message', 'Account confirmed successfully!');

        return redirect('/login');
    }
}
