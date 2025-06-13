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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('ci',20)->unique();
            $table->string('nombres',100);
            $table->string('paterno',100);
            $table->string('materno',100);
            $table->date('fecha_designacion');
            $table->string('celular',20);
            $table->text('direccion')->nullable();
            $table->string('cargo');
            $table->boolean('estado')->default(true);
            $table->unsignedBigInteger('unidad_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('unidad_id')->references('id')->on('unidades')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};
