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
        Schema::create('endkon_ariza', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->date('date');
            $table->unsignedBigInteger('kumes_id');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('kumes_id')->references('id')->on('kumes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('endkon_ariza', function (Blueprint $table) {
            Schema::dropIfExists('endkon_ariza');
        });
    }
};
