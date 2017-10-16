<?php

namespace App\Http\Controllers\Notification;

use App\Jobs\SendNotificationMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'notification/create',
            [
                'applications' => config('app.siwecos.applications')
            ]
        );
    }

    /**
     * Create mail from template and return back to application
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createMail(Request $request)
    {
        $this->validate(
            $request,
            [
                'application'   => 'required|integer|min:1|max:5',
                'date'       => 'required|date',
                'time'       => 'required|date_format:H:i',
                'filterable'   => 'integer|min:0|max:1'
            ]
        );

        return \Response::json([
            'body' => \View::make('notification.mailtemplate', ["request" => $request])->render()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $this->validate(
            $request,
            [
                'signedemail'   => 'required|pgpsignature'
            ]
        );

        // Send dispatcher command
        dispatch(new SendNotificationMail($request->toArray()));

        return redirect('/');
    }
}
