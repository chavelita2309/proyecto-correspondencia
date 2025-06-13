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
        //
        Schema::table('seguimientos', function (Blueprint $table) {
            $table->string('accion', 50)->change(); // Aumentamos a 50 caracteres
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('seguimientos', function (Blueprint $table) {
            $table->string('accion', 10)->change(); // Volvemos a 10 si se revierte
        });
    }
};
