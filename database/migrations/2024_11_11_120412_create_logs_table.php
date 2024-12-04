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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip'); // Kullanıcının IP adresi
            $table->unsignedBigInteger('user_id'); // Kullanıcı ID'si
            $table->text('action'); // Kullanıcının yaptığı işlem
            $table->timestamp('date')->useCurrent(); // İşlemin yapıldığı tarih
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Kullanıcı ile ilişki
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
