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
        Schema::create('test_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('test_id')->constrained()->cascadeOnDelete();
            $table->integer('sinif_sira')->nullable();
            $table->integer('okul_sira')->nullable();
            $table->integer('ilce_sira')->nullable();
            $table->integer('il_sira')->nullable();
            $table->integer('genel_sira')->nullable();
            $table->integer('lgs_puan')->nullable();
            $table->integer('tyt_puan')->nullable();
            $table->integer('say_puan')->nullable();
            $table->integer('sozel_puan')->nullable();
            $table->integer('ea_puan')->nullable();
            $table->integer('ozel_puan')->nullable();
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
        Schema::dropIfExists('test_students');
    }
};
