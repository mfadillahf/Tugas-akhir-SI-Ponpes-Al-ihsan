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
        Schema::create('sistems', function (Blueprint $table) {
            $table->id();
            $table->char('judul', 50);
            $table->text('deskripsi');
            $table->char('no_telp', 14)->nullable();
            $table->text('alamat');
            $table->char('email', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sistems');
    }
};
