<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Webpatser\Countries\Countries;

class ProfileController extends Controller
{
    public function show(Countries $countryModel)
    {
        // Check if a valid token is there
        $user = \Auth::user();

        // Fetch country list
        $countries = $countryModel->getListForSelect();

        return view('auth.profile', ["user" => $user, "countries" => $countries]);
    }

    /**
     * Store the updated profile
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = \Auth::user();

        $this->validate(
            $request,
            [
                'name' => 'required|max:255',
                'pgpkey' => 'required|pgpkey',
                'company' => 'required|max:255',
                'telephone' => 'max:255',
                'country' => 'required|integer|exists:countries,id',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'password' => 'min:6|confirmed',
            ]
        );

        if ($request->get('newpassword', '')) {
            $user->password = \Hash::make($request->get('newpassword', ''));
        }

        $user->update($request->all());

        \Session::flash('message', 'Profile updated successfully');

        return redirect('/user/profile');
    }
}
