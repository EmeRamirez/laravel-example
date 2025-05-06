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
        Schema::create('historia_imagen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('historia_id')->constrained('historia')->cascadeOnDelete();
            $table->foreignId('imagen_id')->constrained('imagen')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historia_imagen');
    }
};
