<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableReportsChangeBatchName extends Migration
{

    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->renameColumn('batch_name', 'id_batch_job');
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->renameColumn('id_batch_job', 'batch_name');
        });
    }
}
