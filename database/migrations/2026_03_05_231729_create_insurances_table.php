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
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_empresa', 150)
                  ->comment('Razón social de la aseguradora');

            $table->string('telefono_contacto', 20)
                  ->comment('Teléfono principal de contacto');

            $table->text('notas_adicionales')
                  ->nullable()
                  ->comment('Observaciones internas del administrador');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
