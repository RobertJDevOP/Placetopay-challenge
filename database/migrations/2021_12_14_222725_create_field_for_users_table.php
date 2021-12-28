<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldForUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surnames',50)->nullable()->after('name');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('number_document',16)->nullable()->after('password');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('cell_phone',15)->nullable()->after('remember_token');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_street',255)->nullable()->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('surnames');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('number_document');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cell_phone');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_street');
        });
    }
}
