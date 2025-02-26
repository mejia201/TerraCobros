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
            $table->string('fechaPago');
            //nuevo campo para almacenar el monto de la cuota
            $table->decimal('montoCuota', 10, 2);

            //seria como un subtotal del monto calculando la mora
            $table->decimal('montoPorMora', 10, 2);

            //el total en mora 
            $table->decimal('moraAplicada', 10, 2);

            //el monto total + la mora
            $table->decimal('montoTotal', 10, 2);

            $table->string('metodo_pago')->nullable();
            $table->string('numero_cuenta')->nullable();
            $table->string('descripcion');
            
            $table->timestamps();
        
            $table->foreign('id_pago')->references('id_pago')->on('pago')->onDelete('cascade')->onUpdate('cascade');
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
