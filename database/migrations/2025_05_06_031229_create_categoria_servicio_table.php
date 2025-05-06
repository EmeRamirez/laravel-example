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
        Schema::create('categoria_servicio', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->text('imagen');
            $table->text('texto');
            $table->boolean('activo')->default(true);
            $table->timestamps();  // created_at/updated_at con timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_servicio');
    }
};
