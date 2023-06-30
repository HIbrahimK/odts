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
        Schema::create('ders_ortalamas', function (Blueprint $table) {
            $table->id();
            $table->integer('sinif_ortalama')->nullable();
            $table->integer('okul_ortalama')->nullable();
            $table->integer('ilce_ortalama')->nullable();
            $table->integer('il_ortalama')->nullable();
            $table->integer('genel_ortalama')->nullable();
            $table->foreignId('test_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();

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
        Schema::dropIfExists('ders_ortalamas');
    }
};
