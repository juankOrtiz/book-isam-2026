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
        Schema::create('libro_lista_lectura', function (Blueprint $table) {
            $table->id();
            // Definimos la FK que va a estar relacionada con la tabla lista_lectura
            $table->foreignId('lista_lectura_id')
                ->constrained('listas_lectura')
                ->onDelete('cascade');
            $table->foreignId('libro_id')
                ->constrained('libros')
                ->onDelete('cascade');
            $table->integer('puntaje')->nullable();
            $table->string('estado')->default('pendiente'); // 'leyendo', 'completado', 'pendiente'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro_lista_lectura');
    }
};
