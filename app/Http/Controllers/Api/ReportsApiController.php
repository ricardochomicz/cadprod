<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsApiController extends Controller
{
    public function months(Request $request)
    {
        $year = (int) $request->input('year', 2018);
        $repository = ReportsController::getReportsMonthByYear($year);

        return response()->json($repository);
    }
}
