<?php

namespace App\Http\Controllers\Bugreport;

use App\Bugreport;
use App\Jobs\SendBugreportMail;
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
        return view(
            'bugreport/create',
            [
                'applications' => config('app.siwecos.applications'),
                'exploittypes' => config('app.siwecos.exploittypes')
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
                'application'   => 'integer|min:1|max:5',
                'exploittype'  => 'integer|min:1|max:7',
                'version'       => 'max:100',
            ]
        );

        return \Response::json([
            'body' => \View::make('bugreport.mailtemplate', ["request" => $request])->render()
        ]);
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
                'application'   => 'required|integer|min:1|max:5',
                'exploittype'  => 'required|integer|min:1|max:7',
                'infourl'       => 'required',
                'version'       => 'required|max:100',
                'vulnerability' => 'required',
                'signedemail'   => 'required|pgpsignature'
            ]
        );

        $bugreport = new Bugreport();
        $bugreport->fill($request->toArray());

        $bugreport->user_id   = Auth::user()->id;

        $bugreport->save();

        // Send dispatcher command
        dispatch(new SendBugreportMail($bugreport));

        \Session::flash('message', 'Successfully queued report for sending');

        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Bugreport  $bugreports  bug reports model
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Bugreport $bugreports)
    {
        $bugreports = $bugreports->orderBy('created_at', 'desc')->paginate(30);

        return view('bugreport.index', compact('bugreports'));
    }

    /**
     * Show details of a bug report
     *
     * @param  int  $bugreportId  bug report id
     *
     * @return Response
     */
    public function show($bugreportId, Bugreport $bugreports)
    {
        $report = $bugreports->findOrFail($bugreportId);

        return view('bugreport.show', compact('report'));
    }
}
