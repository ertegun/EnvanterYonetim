<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Vehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_id');
            $table->string('name');
            $table->string('detail')->nullable();
            $table->timestamps();
        });
        //Donanım Modelleri
        Schema::create('vehicle_model', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        //Donanım Sahipleri
        Schema::create('vehicle_owner', function (Blueprint $table) {
            $table->unsignedBigInteger('vehicle_id')->unique();
            $table->unsignedBigInteger('owner_id');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle');
        Schema::dropIfExists('vehicle_model');
        Schema::dropIfExists('vehicle_owner');
    }
}
