<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $sql = DB::select('SELECT MIN(id) as min, MAX(id) as max FROM categorias');
        $min = intval($sql[0]->min);
        $max = intval($sql[0]->max);

        // foreach ($sql as $fila){
        //     $min = intval($fila->min);
        //     $max = intval($fila->max);
        // }

        $student_email = $this->faker->unique()->safeEmail();

        try {
            Storage::disk('ftp')->makeDirectory($student_email);
        } catch (\Throwable $th) {
            Storage::disk('sftp')->makeDirectory($student_email);
        }

        return [
            "student_name" => $this->faker->name(),
            "student_email" => $student_email,
            "student_gender" => $this->faker->randomElement(['Male','Female']),
            "id_categoria" => $this->faker->numberBetween($min, $max),
            "student_ftp_path" => $student_email,
            // "student_image" => Str::random(10)
        ];


    }
}
