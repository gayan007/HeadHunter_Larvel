<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\Application;
use Illuminate\Support\Facades\Http;
use App\Services\Report;

class ReportController extends Controller
{
    public function commissionInPipeline()
    {
        $report = new Report();
        $reportData = $report->getPipelinePendngData();

        return view('reports.report', compact('reportData'));
    }
}
