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
        Schema::table('seguimientos', function (Blueprint $table) {
            
            $table->unsignedBigInteger('derivacion_id')->nullable()->after('correspondencia_id');

            //  clave foránea
            $table->foreign('derivacion_id')
                  ->references('id')
                  ->on('derivacorrespondencias')
                  ->onDelete('cascade'); // O 'set null' si prefieres que los seguimientos se mantengan si se borra la derivación
        });
    }

    /**
     * Reverse the migrations.
     */
   public function down(): void
    {
        Schema::table('seguimientos', function (Blueprint $table) {
     
            $table->dropForeign(['derivacion_id']);
           
            $table->dropColumn('derivacion_id');
        });
    }
};
