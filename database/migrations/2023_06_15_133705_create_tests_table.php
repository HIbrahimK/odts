<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('publisher');
            $table->dateTime('test_date');
            $table->integer('level');
            $table->string('type');
            $table->integer('sinif_kat_sayisi')->nullable();
            $table->integer('okul_kat_sayisi')->nullable();
            $table->integer('ilce_kat_sayisi')->nullable();
            $table->integer('il_kat_sayisi')->nullable();
            $table->integer('genel_kat_sayisi')->nullable();
            $table->integer('sinif_puan_ortalama')->nullable();
            $table->integer('okul_puan_ortalama')->nullable();
            $table->integer('ilce_puan_ortalama')->nullable();
            $table->integer('il_puan_ortalama')->nullable();
            $table->integer('genel_puan_ortalama')->nullable();
            $table->boolean('sonuclandi')->default(0);
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('test_id')->nullable()->constrained();
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
        Schema::dropIfExists('tests');
    }
};
