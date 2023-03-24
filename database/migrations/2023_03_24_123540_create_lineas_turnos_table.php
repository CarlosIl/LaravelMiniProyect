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
        Schema::create('lineas_turnos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_turno');
            $table->foreign("id_turno")->references('id_turno')->on('turnos')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_horario');
            $table->foreign("id_horario")->references('id_horario')->on('horarios')->onDelete('cascade')->onUpdate('cascade');
            $table->id('dia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lineas_turnos');
    }
};
