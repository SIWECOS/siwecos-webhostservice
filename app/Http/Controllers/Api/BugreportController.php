<?php

namespace App\Http\Controllers\Api;

use App\Bugreport;
use App\Http\Controllers\Controller;

class BugreportController extends Controller
{
    public function index(Bugreport $bugreportModel)
    {
        return \Response::json($bugreportModel->all());
    }

    public function show($reportId, Bugreport $bugreportModel)
    {
        return \Response::json($bugreportModel->findOrFaiL($reportId));
    }
}
