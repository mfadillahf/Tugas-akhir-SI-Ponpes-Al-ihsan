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
        Schema::create('hapalan_details', function (Blueprint $table) {
           $table->id('id_hapalan_detail');
            $table->unsignedBigInteger('id_hapalan');
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('id_hapalan')
                  ->references('id_hapalan')
                  ->on('hapalans')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hapalan_details');
    }
};
