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
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            // Relación con la tabla preguntas (Postgres lo maneja perfecto así)
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->string('option_text'); // El texto de la respuesta
            $table->boolean('is_correct')->default(false); // Para saber cuál es la buena
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
