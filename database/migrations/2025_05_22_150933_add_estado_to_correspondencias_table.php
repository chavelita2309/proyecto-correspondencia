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
        // Verifica si la tabla 'correspondencias' existe y si la columna 'estado' no existe
        if (Schema::hasTable('correspondencias') && !Schema::hasColumn('correspondencias', 'estado')) {
            Schema::table('correspondencias', function (Blueprint $table) {
               
                $table->string('estado')->default('registrado')->after('tipo'); // Ajusta la posición según tu tabla
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Verifica si la tabla 'correspondencias' existe y si la columna 'estado' existe
        if (Schema::hasTable('correspondencias') && Schema::hasColumn('correspondencias', 'estado')) {
            Schema::table('correspondencias', function (Blueprint $table) {
                $table->dropColumn('estado');
            });
        }
    }
};