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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id('id_agenda');
            $table->unsignedBigInteger('id_jenis_agenda');
            $table->char('judul', 50);
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->string('deskripsi', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_jenis_agenda')->references('id_jenis_agenda')->on('jenis_agendas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
