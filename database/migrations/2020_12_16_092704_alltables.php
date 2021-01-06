<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Alltables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Admin Tablosu
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('user_name')->unique();
            $table->string('password');
            $table->timestamps();

        });
        //Kullanıcı Tablosu
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('department_id');
            $table->string('email')->unique();
            $table->timestamps();
        });
        //Departman Tablosu
        Schema::create('department', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        //Donanım Tablosu
        Schema::create('hardware', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_id');
            $table->unsignedBigInteger('type_id');
            $table->string('barcode_number')->unique();
            $table->string('serial_number')->unique()->nullable();
            $table->string('detail')->nullable();
            $table->timestamps();
        });
        //Donanım Modelleri
        Schema::create('hardware_model', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        //Donanım Tipleri
        Schema::create('hardware_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('prefix',30)->unique();
            $table->timestamps();
        });
        //Donanım Sahipleri
        Schema::create('hardware_owner', function (Blueprint $table) {
            $table->unsignedBigInteger('hardware_id')->unique();
            $table->unsignedBigInteger('owner_id');
            $table->timestamp('created_at');
        });
        //Yazılım Tablosu
        Schema::create('software', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('type_id');
            $table->unsignedInteger('license_time')->nullable();
            $table->timestamp('start_time');
            $table->timestamp('finish_time')->nullable();
        });
        //Yazılım Tipleri
        Schema::create('software_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        //Yazılım Sahipleri
        Schema::create('software_owner', function (Blueprint $table) {
            $table->unsignedBigInteger('software_id')->unique();
            $table->unsignedBigInteger('owner_id');
            $table->timestamp('created_at');
        });
        //Malzeme Tablosu
        Schema::create('material', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->string('detail')->nullable();
            $table->timestamps();
        });
        //Malzeme Tipleri
        Schema::create('material_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        //Malzeme Sahipleri
        Schema::create('material_owner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('owner_id');
            $table->timestamp('created_at');
        });
        //Ortak Kullanım Ekipmanları
        Schema::create('common_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->string('name');
            $table->string('detail')->nullable();
            $table->unsignedInteger('owner_count')->default(0);
            $table->timestamps();
        });
        //Ortak Kullanım Ekipman Tipleri
        Schema::create('common_item_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        //Ortak Kullanım Ekipman Kullanıcıları
        Schema::create('common_item_owner', function (Blueprint $table) {
            $table->unsignedBigInteger('common_item_id');
            $table->unsignedBigInteger('owner_id');
            $table->timestamp('created_at');
        });
        //Tüm İşlem Geçmişi
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('user_id');
            $table->string('admin_name');
            $table->string('user_name');
            $table->string('user_email');
            $table->string('trans_info');
            $table->string('trans_details')->nullable();
            $table->timestamp('created_at');
        });
        //İşlem Geçmişi Tipleri
        Schema::create('transaction_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
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
        //
    }
}
