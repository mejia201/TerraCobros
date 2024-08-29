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
            $table->decimal('montoPago', 10, 2);
            $table->decimal('monto_mora', 10, 2);
            $table->decimal('monto_total', 10, 2);
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
