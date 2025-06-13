<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Support\Str;
// $codigo=str::random(6);

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('correspondencias', function (Blueprint $table) {
            $table->id();
            $table->string('rut',20)->unique();
            $table->date('fecha');
            $table->time('hora');
            $table->year('gestion');
            $table->string('fojas');
            $table->string('folder')->nullable();
            $table->string('destinatario',100);
            $table->string('unidad')->nullable();
            $table->text('referencia');
            $table->string('remitente',100);
            $table->string('fono',20)->nullable();
            $table->string('tipo');
            $table->string('codigo', 6)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('correspondencias');
    }
};
