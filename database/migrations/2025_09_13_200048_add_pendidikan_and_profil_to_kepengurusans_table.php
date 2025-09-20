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
        Schema::table('kepengurusans', function (Blueprint $table) {
            $table->string('pendidikan')->nullable()->after('jabatan');
            $table->longText('profil_singkat')->nullable()->after('pendidikan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kepengurusans', function (Blueprint $table) {
            $table->dropColumn(['pendidikan', 'profil_singkat']);
        });
    }
};
