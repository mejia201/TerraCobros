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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('nombre');
            $table->string('dui', 10);
            $table->string('telefono', 15);
            $table->string('email')->unique();
            $table->longText('direccion')->nullable();
            $table->string('fecha_nacimiento')->nullable();
            $table->string('sexo')->nullable();
            $table->integer('edad')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('pais_nacimiento')->nullable();
            $table->string('estatus')->nullable();
            $table->longText('medio_enterado')->nullable();
            $table->string('tipo_cliente');


            // Datos de Reservación
            $table->float('valor_reserva')->nullable();
            $table->string('fecha_reserva')->nullable();
            $table->float('precio_venta')->nullable();
            $table->float('prima')->nullable();
            $table->float('valor_financiado')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
