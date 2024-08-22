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
        Schema::create('propiedad', function (Blueprint $table) {
            $table->id('id_propiedad');
            $table->float('areaTerreno');
            $table->float('precioPorVRS');
            $table->float('precioTotal');
            $table->float('primaEnEfectivo');
            $table->float('montoAFinanciar');
            $table->float('ingresoRequerido');
            $table->char('estado', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedad');
    }
};
