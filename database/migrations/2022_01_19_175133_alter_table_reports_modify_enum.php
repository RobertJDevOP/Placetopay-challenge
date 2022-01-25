<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableReportsModifyEnum extends Migration
{

    public function up(): void
    {
        \DB::statement("ALTER TABLE `reports` CHANGE `status` `status` ENUM('FAILED','PROCESSING','FINISH') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
    }

    public function down()
    {
        //
    }
}
