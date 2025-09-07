<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_santri');
            $table->integer('nilai');
            $table->char('tahun_ajaran', 10);
            $table->timestamps();

            $table->foreign('id_mapel')->references('id_mapel')->on('mapels')->onDelete('cascade');
            $table->foreign('id_santri')->references('id_santri')->on('santris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
