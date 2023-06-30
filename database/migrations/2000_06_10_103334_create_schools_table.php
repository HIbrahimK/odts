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
        Schema::create('schools', function (Blueprint $table) {
            $table->id()->index();
            $table->string('il_adi');
            $table->foreignId('city_id')->constrained();
            $table->string('ilce_adi');
            $table->unsignedBigInteger('ilce_kodu');
            $table->string('okul_adi');
            $table->string('okul_website');
            $table->string('tip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
};
