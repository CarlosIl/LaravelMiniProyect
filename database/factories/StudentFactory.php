<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        return [
            "student_name" => $this->faker->name(),
            "student_email" => $this->faker->unique()->safeEmail(),
            "student_gender" => $this->faker->randomElement(['Male','Female']),
            "id_categoria" => $this->faker->numberBetween($min = 1, $max = 3),
            // "student_image" => Str::random(10)
        ];
    }
}
