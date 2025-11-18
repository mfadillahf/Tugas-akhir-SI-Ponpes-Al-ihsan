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
        Schema::create('spps', function (Blueprint $table) {
        $table->id('id_spp');

        $table->unsignedBigInteger('id_santri');
        $table->unsignedTinyInteger('bulan'); // 1-12
        $table->year('tahun'); // contoh: 2025

        $table->enum('status', ['lunas', 'belum'])->default('belum');

        $table->timestamps();

    $table->foreign('id_santri')
            ->references('id_santri')
            ->on('santris')
            ->onDelete('cascade');


    $table->unique(['id_santri', 'bulan', 'tahun']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spps');
    }
};
