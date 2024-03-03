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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->default(date("Y-m-d"));
            $table->dateTime('hora_entrada')->nullable()->comment('Hora de entrada del trabajador');
            $table->dateTime('hora_salida')->nullable()->comment('Hora de salida del trabajador');
            $table->unsignedBigInteger('empl_id');
            $table->foreign('empl_id') ->references('id')->on('empleados')
                ->cascadeDelete()
                ->cascadeUpdate();
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
        Schema::dropIfExists('asistencias');
    }
};
