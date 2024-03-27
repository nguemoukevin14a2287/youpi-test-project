<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employe>
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'birthday' => fake()->date($max = date('Y-m-d', strtotime('-21 years'))),
            'address' => fake()->address(),
            'joined_at' => fake()->date($max = date('Y-m-d', strtotime('-6 months'))),
            'salary' =>  rand(1200, 5200) * 100,
            'sexe' => rand() > 0.5 ? 'b' : 'g',
            'strengths' => [],
            'matricule' => Str::random(7)
        ];
    }
}
