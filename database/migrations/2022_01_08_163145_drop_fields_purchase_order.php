<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropFieldsPurchaseOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->dropColumn('requestId');
        });
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->dropColumn('processUrl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->string('status',20)->nullable();
        });
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->integer('requestId',false);
        });
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->string('processUrl')->nullable();
        });
    }
}
