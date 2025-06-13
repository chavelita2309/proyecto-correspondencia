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
        Schema::create('derivacorrespondencias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha'); // Fecha de derivación
            $table->enum('prioridad', ['alta', 'regular', 'baja']);
            $table->enum('estado', ['recibido', 'rechazado', 'en revision', 'concluido']);
            $table->text('observaciones')->nullable();
            
            // Campos para seguimiento
            $table->timestamp('fecha_recepcion')->nullable(); // Cuándo el funcionario recibe el trámite
            $table->timestamp('fecha_conclusion')->nullable(); // Cuándo el funcionario concluye el trámite
    
            // Relaciones
            $table->unsignedBigInteger('correspondencia_id'); 
            $table->foreign('correspondencia_id')->references('id')->on('correspondencias')->onDelete('cascade');
            
            $table->unsignedBigInteger('funcionario_id');
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade');
    
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('derivacorrespondencias');
    }
};
