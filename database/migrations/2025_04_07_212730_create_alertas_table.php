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
        Schema::create('alertas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('correspondencia_id');
            $table->unsignedBigInteger('funcionario_id')->nullable();
            $table->string('tipo'); // ejemplo: 'sin_recepcion', 'retraso_conclusion'
            $table->boolean('vista')->default(false);
            $table->timestamp('fecha_alerta');
            $table->text('mensaje');
            $table->timestamps();

            // Relaciones
            $table->foreign('correspondencia_id')->references('id')->on('correspondencias')->onDelete('cascade');
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alertas');
    }
};
