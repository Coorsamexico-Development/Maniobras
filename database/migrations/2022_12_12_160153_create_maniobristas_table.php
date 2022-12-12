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
        Schema::create('maniobristas', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->string('ap_paterno', 60);
            $table->string('ap_materno', 60)->nullable();
            $table->integer('telefono')->unique();
            $table->tinyInteger('active')->default(1);
            $table->integer('faltas_seguidas');
            $table->integer('faltas_totales');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maniobristas');
    }
};
