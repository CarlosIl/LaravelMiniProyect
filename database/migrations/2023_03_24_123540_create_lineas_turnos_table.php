<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lineas_turnos', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('dia');
            $table->unsignedBigInteger('id_turno');
            $table->foreign("id_turno")->references('id')->on('turnos')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_horario');
            $table->foreign("id_horario")->references('id')->on('horarios')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        // DB::statement('CREATE TABLE ')
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lineas_turnos');
    }
};
