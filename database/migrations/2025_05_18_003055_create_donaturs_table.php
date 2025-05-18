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
        Schema::create('donaturs', function (Blueprint $table) {
            $table->id('id_donatur');
            $table->unsignedBigInteger('id_user');
            $table->char('nama', 50);
            $table->string('alamat', 255)->nullable();
            $table->char('no_telepon', 14);
            $table->char('email', 50)->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donaturs');
    }
};
