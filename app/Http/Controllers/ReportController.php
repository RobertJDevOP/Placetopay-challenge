<?php

namespace App\Http\Controllers;

use App\Jobs\ReporteGenerateProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class ReportController extends Controller
{
    public function generate(){

        $batch = Bus::batch([
            new ReporteGenerateProcess(),
        ])->then(function (Batch $batch) {
            // All jobs completed successfully...
        })->catch(function (Batch $batch, Throwable $e) {
            // First batch job failure detected...
        })->finally(function (Batch $batch) {
             return $batch->id;
        })->dispatch();


       // return $batch;
    }
}
