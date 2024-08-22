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
        Schema::create('detalle_pago', function (Blueprint $table) {
        $table->id('id_detalle_pago');
        $table->unsignedBigInteger('id_pago');
        $table->date('fechaPago');
        $table->float('montoPagado');
        $table->float('monto_mora')->nullable()->default(0);  // Permite valores nulos y establece un valor por defecto de 0
        $table->float('monto_total');
        $table->foreign('id_pago')->references('id_pago')->on('pago')->onDelete('cascade')->onUpdate('cascade');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pago');
    }
};
