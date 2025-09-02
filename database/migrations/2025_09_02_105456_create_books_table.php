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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('author_id') // Crea la columna para el ID del autor
                  ->constrained()         // Establece la relación con la tabla 'authors'
                  ->cascadeOnDelete()     // Si un autor se borra, sus libros también
                  ->index();             // Crea un índice para búsquedas rápidas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
