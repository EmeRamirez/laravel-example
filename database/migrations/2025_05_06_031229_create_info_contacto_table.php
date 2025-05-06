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
        Schema::create('info_contacto', function (Blueprint $table) {
            $table->id(); // Equivalente a INT PRIMARY KEY AUTO_INCREMENT
            $table->string('nombre', 255); // VARCHAR(255)
            $table->text('texto'); // TEXT
            $table->text('texto_adicional'); // TEXT adicional
            $table->boolean('activo')->default(true); // BOOLEAN DEFAULT TRUE
            $table->timestamps(); // Crea created_at y updated_at con timestamps automáticos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_contacto');
    }
};
