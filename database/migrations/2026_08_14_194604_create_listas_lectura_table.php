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
        Schema::create('listas_lectura', function (Blueprint $table) {
            $table->id();
            // Relacion 1:N con la tabla users
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('nombre', 150);
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listas_lectura');
    }
};
