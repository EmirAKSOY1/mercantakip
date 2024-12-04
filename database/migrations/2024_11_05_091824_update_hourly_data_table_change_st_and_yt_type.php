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
        Schema::table('hourly_data', function (Blueprint $table) {
            $table->integer('st')->change(); // st alanını integer olarak değiştir
            $table->integer('yt')->change(); // yt alanını integer olarak değiştir
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hourly_data', function (Blueprint $table) {
            $table->string('st')->change(); // st alanını eski haline getir
            $table->string('yt')->change(); // yt alanını eski haline getir
        });
    }
};
