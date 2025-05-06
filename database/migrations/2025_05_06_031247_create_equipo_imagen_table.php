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
        Schema::create('equipo_imagen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained('equipo')->cascadeOnDelete();
            $table->foreignId('imagen_id')->constrained('imagen')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipo_imagen');
    }
};
