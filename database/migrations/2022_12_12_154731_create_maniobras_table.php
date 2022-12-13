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
        Schema::create('maniobras', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('descripcion', 100);
            $table->integer('salario');
            $table->foreignId('cliente_id')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade')->unsigned();
            $table->foreignId('status_maniobra_id')->references('id')->on('status_maniobras')->onDelete('cascade')->onUpdate('cascade')->unsigned();
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
        Schema::dropIfExists('maniobras');
    }
};
