<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixtureTablesForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fixture', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('fixture_type');
            $table->foreign('brand_id')->references('id')->on('fixture_brand');
            $table->foreign('supplier_id')->references('id')->on('supplier');
            $table->foreign('bill_id')->references('id')->on('bill');
            $table->foreign('status_id')->references('id')->on('status');
        });
        Schema::table('fixture_owner', function (Blueprint $table) {
            $table->foreign('fixture_id')->references('id')->on('fixture');
            $table->foreign('owner_id')->references('id')->on('user');
        });
        Schema::table('section', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('department');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fixture', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['bill_id']);
            $table->dropForeign(['status_id']);
        });
        Schema::table('fixture_owner', function (Blueprint $table) {
            $table->dropForeign(['fixture_id']);
            $table->dropForeign(['owner_id']);
        });
        Schema::table('section', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
        });
    }
}
