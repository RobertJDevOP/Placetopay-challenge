<?php

namespace App\Http\Controllers;

use App\Events\NotifyReportFinish;
use App\Jobs\ReporteGenerateProcess;
use App\Models\Reports;
use Illuminate\Bus\Batch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function generate(Reports $reports){

        /*$reports->batch_name='reporte1';
        $reports->path=null;
        $reports->save();

        $batch = Bus::batch([
            new ReporteGenerateProcess(),
        ]) ->name('reporte1')
        ->then(function (Batch $batch) {
            Log::info('Termino proceso job queue xd',['batch id'=>$batch->id]);
            event(new NotifyReportFinish('TERMINO EL PROCESO '));
        })->catch(function (Batch $batch, Throwable $e) {

        })->finally(function (Batch $batch) {
            Log::info('termino ejecucion del batch',['batch id'=>$batch->progress()]);
        })->dispatch();*/

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
