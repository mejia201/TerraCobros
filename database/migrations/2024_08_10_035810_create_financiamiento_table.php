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
            $table->float('tasaInteres'); //esto seria en base al 12% siempre
            //ya lo calcularia desde mi tabla propiedad, solo para venir a colocar a esta tabla 
            $table->integer('plazoAnos'); //por ejemplo 7
            $table->float('pagoMensual'); //por ejemplo 225.04
            $table->integer('numeroCuotas'); // la cantidad de coutas en 7 años 
            $table->date('fechaInicio'); // la fecha en la que inicia el financiemiento
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
