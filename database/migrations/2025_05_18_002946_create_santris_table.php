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
        Schema::create('santris', function (Blueprint $table) {
            $table->id('id_santri');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_kelas');
            $table->char('nama_lengkap', 50);
            $table->char('nama_panggil', 50);
            $table->date('tanggal_lahir');
            $table->string('alamat', 255);
            $table->char('no_telepon', 14)->nullable();
            $table->char('email', 50)->nullable();
            $table->char('jenis_kelamin', 10);
            $table->char('status', 10)->default('calon');;
            $table->char('pendidikan_asal', 50);
            $table->char('nama_ayah', 50);
            $table->char('pekerjaan_ayah', 30);
            $table->char('no_hp_ayah', 14);
            $table->char('nama_ibu', 50);
            $table->char('pekerjaan_ibu', 30);
            $table->char('no_hp_ibu', 14);
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
