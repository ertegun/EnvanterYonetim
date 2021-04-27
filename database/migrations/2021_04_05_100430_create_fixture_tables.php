<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixtureTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixture', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');//Tür
            $table->unsignedBigInteger('brand_id');//Marka
            $table->unsignedBigInteger('supplier_id');//Tedarikçi
            $table->unsignedBigInteger('bill_id')->nullable();//Fatura
            $table->unsignedBigInteger('status_id');//Statü
            $table->unsignedBigInteger('department_id');//Departman
            $table->unsignedBigInteger('section_id');//Bölüm
            $table->string('name');//Adı
            $table->string('serial_number')->unique()->nullable();//Seri No
            $table->string('barcode_number')->unique();//Barkod No
            $table->unsignedBigInteger('price')->nullable();//Tutar
            $table->unsignedInteger('warranty')->nullable();//Garanti Süresi (Yıl)
            $table->unsignedInteger('duration')->default(2);//Ömür (Yıl)
            $table->unsignedInteger('count')->default(1);//Adet
            $table->string('explanation')->nullable();//Açıklama
            $table->string('detail')->nullable();//Detay
            $table->string('image')->nullable();//Ürün Resmi
            $table->timestamps();//Oluşturma/Güncelleme Tarihi
            $table->softDeletes();//Silinme Tarihi
        });

        Schema::create('fixture_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('prefix',30)->unique();
            $table->timestamps();
        });

        Schema::create('fixture_brand', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('telephone')->unique();
            $table->timestamps();
        });

        Schema::create('bill', function (Blueprint $table) {
            $table->id();
            $table->string('no')->unique();
            $table->string('image')->unique();
            $table->timestamps();
        });

        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('fixture_owner', function (Blueprint $table) {
            $table->unsignedBigInteger('fixture_id');
            $table->unsignedBigInteger('owner_id');
            $table->timestamp('created_at');
            $table->softDeletes();
        });

        Schema::create('section', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->string('name');
            $table->string('prefix');
            $table->timestamps();
        });

        Schema::table('department', function(Blueprint $table){
            $table->string('prefix')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fixture');
        Schema::dropIfExists('fixture_type');
        Schema::dropIfExists('fixture_brand');
        Schema::dropIfExists('supplier');
        Schema::dropIfExists('bill');
        Schema::dropIfExists('status');
        Schema::dropIfExists('fixture_owner');
        Schema::dropIfExists('section');
        Schema::table('department', function (Blueprint $table) {
            $table->dropColumn('prefix');
        });
    }
}
