<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_asitencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('turno_fecha_id')->references('id')->on('turno_fechas')->onDelete('cascade')->onUpdate('cascade')->unsigned();
            $table->foreignId('maniobrista_id')->references('id')->on('maniobristas')->onDelete('cascade')->onUpdate('cascade')->unsigned();
            $table->bigInteger('salario');
            $table->integer('asistencia');
            $table->tinyInteger('active')->default(1);
            $table->string('imagen_url', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lista_asitencias');
    }
};
