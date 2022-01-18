<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up():void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id_report');
            $table->string('batch_name');
            $table->string('path',255)->nullable(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
}
