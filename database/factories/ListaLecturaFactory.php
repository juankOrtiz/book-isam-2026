<?php

namespace Database\Factories;

use App\Models\ListaLectura;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ListaLectura>
 */
class ListaLecturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder(123)->first()?->id ?? User::factory()->create(),
            'nombre' => fake()->sentence(3),
            'descripcion' => fake()->paragraph(),
        ];
    }
}
