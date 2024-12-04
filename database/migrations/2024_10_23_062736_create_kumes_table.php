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
        Schema::create('kumes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('capacity');
            $table->decimal('latitude', 10, 8); // Enlem
            $table->decimal('longitude', 11, 8); //Boylam
            $table->unsignedBigInteger('entegre_id'); 
            $table->foreign('entegre_id')->references('id')->on('entegre')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('kumes', function (Blueprint $table) {
            
            $table->dropForeign(['entegre_id']);
        });

        Schema::dropIfExists('kumes');
    }
};
