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
        Schema::create('endkon_data', function (Blueprint $table) {
            $table->id();
            $table->integer('SN')->nullable(); // int
            $table->integer('KN')->nullable(); // int
            $table->integer('ISI')->nullable(); // int
            $table->integer('DI')->nullable(); // int
            $table->integer('SE')->nullable(); // int
            $table->integer('HI')->nullable(); // int
            $table->integer('NE')->nullable(); // int
            $table->integer('BA')->nullable(); // int
            $table->integer('CO')->nullable(); // int
            $table->integer('HZ')->nullable(); // int
            $table->integer('LU')->nullable(); // int
            $table->integer('SU')->nullable(); // int
            $table->integer('S1')->nullable(); // int
            $table->integer('S2')->nullable(); // int
            $table->integer('HK')->nullable(); // int
            $table->integer('MO')->nullable(); // int
            $table->integer('GU')->nullable(); // int
            $table->integer('HS')->nullable(); // int
            $table->integer('DUN_SU')->nullable(); // int
            $table->integer('YEM')->nullable(); // int
            $table->integer('DUN_YEM')->nullable(); // int
            $table->integer('OS')->nullable(); // int
            $table->integer('OO')->nullable(); // int
            $table->dateTime('tarih')->nullable();
            $table->unsignedBigInteger('kumes_id');
            $table->timestamps();

            $table->foreign('kumes_id')->references('id')->on('kumes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endkon_data');
    }
};
