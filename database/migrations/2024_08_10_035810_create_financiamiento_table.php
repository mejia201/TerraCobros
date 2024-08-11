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
        Schema::create('financiamiento', function (Blueprint $table) {
            $table->id('id_financiamiento');
            $table->unsignedBigInteger('id_propiedad');
            $table->unsignedBigInteger('id_cliente');
            $table->float('tasaInteres');
            $table->integer('plazoAnos');
            $table->float('pagoMensual');
            $table->integer('numeroCuotas');
            $table->date('fechaInicio');
            $table->foreign('id_propiedad')->references('id_propiedad')->on('propiedad')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financiamiento');
    }
};
