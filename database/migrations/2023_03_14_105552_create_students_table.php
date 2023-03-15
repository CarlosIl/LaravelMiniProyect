<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

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
            $table->string('student_image');
            // $table->foreignId("id_profesor")->on("profesors");
            $table->timestamps();
        });


        // DB::statement('alter table students add constraint students_id_categoria_foreign
        //                foreign key (id_categoria)
        //                references categoria(id)
        //                on delete cascade;'
        // );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // DB::statement('alter table students drop FOREIGN KEY students_id_categoria_foreign;');
        Schema::dropIfExists('students');
    }
};
