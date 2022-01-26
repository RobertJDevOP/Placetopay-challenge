<?php

namespace App\Http\Controllers;

use App\Http\Request\Reports\IndexRequest;
use App\Models\Reports;
use App\Reports\ReportsContract;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    public function store(IndexRequest $request): void
    {
        $report = app()->make(ReportsContract::class, $request->validated());

        $report->generate();
    }

    public function index(Reports $reports): JsonResponse
    {
        $data = $reports::select('id_report','path','created_at','status','name')->where('name', '<>', 'Products import')->get();

        return response()->json($data);
    }

}
