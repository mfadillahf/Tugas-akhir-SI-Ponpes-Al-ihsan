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
        Schema::create('hapalan_kitab', function (Blueprint $table) {
            $table->id('id_hapalan_kitab');
            $table->unsignedBigInteger('id_hapalan'); // relasi ke tabel hapalans
            $table->unsignedBigInteger('id_santri');
            $table->unsignedBigInteger('id_guru');
            $table->text('keterangan_1')->nullable();
            $table->text('keterangan_2')->nullable();
            $table->text('keterangan_3')->nullable();
            $table->text('keterangan_4')->nullable();
            $table->date('waktu');
            $table->timestamps();

            // Foreign key relasi
            $table->foreign('id_hapalan')->references('id_hapalan')->on('hapalans')->onDelete('cascade');
            $table->foreign('id_santri')->references('id_santri')->on('santris')->onDelete('cascade');
            $table->foreign('id_guru')->references('id_guru')->on('gurus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hapalan_kitab');
    }
};
