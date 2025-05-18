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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id('id_guru');
            $table->unsignedBigInteger('id_user');
            $table->char('nama', 50);
            $table->char('no_telepon', 14);
            $table->char('email', 50)->nullable();
            $table->char('nip', 20)->nullable();
            $table->date('tanggal_lahir');
            $table->char('jenis_kelamin', 10);
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
