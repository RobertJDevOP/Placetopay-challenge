<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableReports extends Migration
{

    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->string('name',50);
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->string('batch_name',255)->change();
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
}
