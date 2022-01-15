<?php

namespace App\Http\Controllers;


use App\Models\Reports;
use App\Reports\ReportsContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;


class ReportController extends Controller
{
    //en esta implementacion hare lo correspondiente a validaciones,manejo de errores, solid
    public function store(Request $request){

        $report = app()->make(ReportsContract::class, $request->only('typeReport'));

        $report->generate();

    }

    public  function  getReports(Reports $reports): JsonResponse
    {
        $data = $reports->all();

        return response()->json($data);
    }

    public function batchInProgress()
    {
        $idBatch=1;

        return Bus::findBatch($idBatch);
    }
}
