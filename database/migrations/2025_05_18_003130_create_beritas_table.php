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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id('id_berita');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_jenis_berita');
            $table->char('judul', 50);
            $table->text('isi');
            $table->date('tanggal');
            $table->char('foto', 20)->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_jenis_berita')->references('id_jenis_berita')->on('jenis_beritas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
