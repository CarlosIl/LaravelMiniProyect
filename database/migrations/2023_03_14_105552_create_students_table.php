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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('student_email');
            $table->enum('student_gender', ['Male', 'Female']);
            // $table->dropForeign(['id_categoria']);
            // $table->foreignId("id_categoria")->on("categorias");
            $table->unsignedBigInteger('id_categoria');
            $table->foreign("id_categoria")->references('id')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
            // $table->string('student_image');
            $table->string('student_ftp_path');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
