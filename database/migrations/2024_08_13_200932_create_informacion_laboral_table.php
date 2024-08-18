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
        Schema::create('informacion_laboral', function (Blueprint $table) {
            $table->id('id_informacion_laboral');
            $table->unsignedBigInteger('id_cliente');
            // Información laboral
            $table->string('estado_laboral')->nullable();
            $table->string('nombre_empresa')->nullable();
            $table->longText('direccion_empresa')->nullable();
            $table->string('cargo')->nullable();
            $table->string('telefono_empresa')->nullable();
            $table->string('tiempo_en_empresa')->nullable();
            $table->string('jefe_inmediato')->nullable();
            $table->string('telefono_jefe')->nullable();
            $table->string('registro_iva')->nullable();
            $table->string('tipo_negocio')->nullable();

            // Ingresos laborales
            $table->float('salario_mensual')->nullable();
            $table->float('ingresos_adicionales')->nullable();
            $table->float('remesas')->nullable();

            $table->foreign('id_cliente')->references('id_cliente')->on('cliente')->onDelete('cascade')->onUpdate('cascade');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informacion_laboral');
    }
};
