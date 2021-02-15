<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VehicleForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicle', function (Blueprint $table) {
            $table->foreign('model_id')->references('id')->on('vehicle_model');
        });
        Schema::table('vehicle_owner', function (Blueprint $table) {
            $table->foreign('vehicle_id')->references('id')->on('vehicle');
            $table->foreign('owner_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle', function (Blueprint $table) {
            $table->dropForeign(['model_id']);
        });
        Schema::table('vehicle_owner', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
            $table->dropForeign(['owner_id']);
        });
    }
}
