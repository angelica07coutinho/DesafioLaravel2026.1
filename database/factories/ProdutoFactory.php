<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produto;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->word(),
            'descricao' => fake()->sentence(),
            'foto' => fake()->imageUrl(),
            'preco' => fake()->randomFloat(2, 1, 100),
            'quantidade' => fake()->numberBetween(1, 100),
            'id_usuario' => User::factory(),
            'id_categoria' => fake()->numberBetween(1, 8),
        ];
    }
}
