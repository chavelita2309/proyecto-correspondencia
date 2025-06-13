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
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('correspondencia_id');
            $table->unsignedBigInteger('funcionario_id');
            $table->enum('accion', ['derivado', 'recibido', 'rechazado', 'revisado', 'concluido']);
            $table->text('comentario')->nullable();
            $table->timestamp('fecha');
            $table->foreign('correspondencia_id')->references('id')->on('correspondencias')->onDelete('cascade');
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimientos');
    }
};
