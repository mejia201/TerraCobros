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
        Schema::create('pago', function (Blueprint $table) {
            $table->id('id_pago');
            $table->unsignedBigInteger('id_financiamiento');
            $table->string('fechaPagoEsperada');
            $table->integer('cuota');
            $table->decimal('montoPago', 10, 2)->default(0);
            $table->string('estado')->nullable();
            $table->foreign('id_financiamiento')->references('id_financiamiento')->on('financiamiento')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago');
    }
};
