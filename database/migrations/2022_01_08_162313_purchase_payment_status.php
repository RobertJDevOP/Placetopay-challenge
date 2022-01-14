<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PurchasePaymentStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_payment_status', function (Blueprint $table) {
            $table->bigIncrements('id_purchase_payment');
            $table->unsignedBigInteger('id_purchase_order');
            $table->string('status');
            $table->integer('requestId')->nullable();
            $table->string('processUrl')->nullable();
            $table->foreign('id_purchase_order')->references('id')->on('purchase_order');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_payment_status');
    }
}
