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
        Schema::create('turno_fechas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->boolean('active')->default(1);
            $table->integer('cant_asistencia');
            $table->foreignId('turno_id')->constrained('turnos');
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
        Schema::dropIfExists('turno_fechas');
    }
};
