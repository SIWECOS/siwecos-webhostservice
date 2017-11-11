<?php

namespace App\Http\Controllers\Auth;

use App\Invite;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Webpatser\Countries\Countries;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request, Invite $inviteModel, Countries $countryModel)
    {
        // Check if the token is present
        if (!$request->input('token')) {
            return redirect('/login');
        }

        // Check if a valid token is there
        $invite = $inviteModel->where('token', '=', $request->input('token'))->first();

        if (!$invite) {
            return redirect('/login');
        }

        // Fetch country list
        $countries = $countryModel->getListForSelect();

        return view('auth.register', ["countries" => $countries]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'pgpkey' => 'required|pgpkey',
            'company' => 'required|max:255',
            'token' => 'required|exists:invites,token',
            'telephone' => 'max:255',
            'country' => 'required|integer|exists:countries,id',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        // Check if a valid token is there
        $invites = new Invite();
        $invite = $invites->where('token', '=', $data["token"])->first();

        // Delete invite
        $invite->delete();

        $user = User::create([
            'name' => $data['name'],
            'company' => $data['company'],
            'country' => $data['country'],
            'telephone' => $data['telephone'],
            'email' => $data['email'],
            'pgpkey' => $data['pgpkey'],
            'password' => bcrypt($data['password']),
        ]);

        $user->invited_by = $invite->send_by;
        $user->invited_at = $invite->send_at;
        $user->invite_reason = $invite->reason;
        $user->last_reminder_confirmed = 1;
        $user->last_reminder = Carbon::now();

        $user->save();

        \Session::flash('message', 'Registration completed successfully');

        return $user;
    }
}
