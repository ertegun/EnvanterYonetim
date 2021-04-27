<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Exchange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fixture', function (Blueprint $table) {
            $table->unsignedBigInteger('exchange_id')->nullable();//Döviz
            $table->unsignedBigInteger('exchange_rate')->nullable();//Döviz Tutarı
        });

        Schema::create('exchange', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('icon')->unique();
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
        Schema::table('fixture', function (Blueprint $table) {
            $table->dropColumn('exchange_id');
            $table->dropColumn('exchange_rate');
        });
        Schema::dropIfExists('exchange');
    }
}
