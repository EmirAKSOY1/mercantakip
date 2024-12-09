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
        Schema::create('daily_data', function (Blueprint $table) {
            $table->id();
            $table->decimal('s1', 8, 2);
            $table->decimal('s2', 8, 2); 
            $table->integer('os');
            $table->integer('oo');
            $table->integer('gu');
            $table->foreignId('kumes_id')->constrained('kumes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_data');
    }
};
