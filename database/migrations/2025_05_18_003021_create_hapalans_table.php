<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hapalans', function (Blueprint $table) {
            $table->id('id_hapalan');
            $table->unsignedBigInteger('id_santri');
            $table->unsignedBigInteger('id_guru');
            $table->timestamps();

            $table->foreign('id_santri')->references('id_santri')->on('santris')->onDelete('cascade');
            $table->foreign('id_guru')->references('id_guru')->on('gurus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hapalans');
    }
};
