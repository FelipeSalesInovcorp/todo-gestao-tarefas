<?php

namespace App\Http\Controllers;

use App\Actions\Dashboard\GetDashboardMetricsAction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request, GetDashboardMetricsAction $action)
    {
        $data = $action->execute($request->user()->id);

        return view('dashboard', $data);
    }
}
