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
        Schema::create('kepengurusans', function (Blueprint $table) {
            $table->id('id_kepengurusan');
            $table->char('nama', 50);
            $table->char('jabatan', 50);
            $table->date('mulai');
            $table->date('akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepengurusans');
    }
};
