<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Allforeigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('department');
        });
        Schema::table('hardware', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('hardware_type');
            $table->foreign('model_id')->references('id')->on('hardware_model');
        });
        Schema::table('hardware_owner', function (Blueprint $table) {
            $table->foreign('hardware_id')->references('id')->on('hardware');
            $table->foreign('owner_id')->references('id')->on('user');
        });
        Schema::table('software', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('software_type');
        });
        Schema::table('software_owner', function (Blueprint $table) {
            $table->foreign('software_id')->references('id')->on('software');
            $table->foreign('owner_id')->references('id')->on('user');
        });
        Schema::table('material', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('material_type');
        });
        Schema::table('material_owner', function (Blueprint $table) {
            $table->foreign('material_id')->references('id')->on('material');
            $table->foreign('owner_id')->references('id')->on('user');
        });
        Schema::table('common_item', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('common_item_type');
        });
        Schema::table('common_item_owner', function (Blueprint $table) {
            $table->foreign('common_item_id')->references('id')->on('common_item');
            $table->foreign('owner_id')->references('id')->on('user');
        });
        Schema::table('transaction', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('transaction_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
