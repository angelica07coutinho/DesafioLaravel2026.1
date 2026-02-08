<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Endereco;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Endereco>
 */
class EnderecoFactory extends Factory
{
    protected $model = Endereco::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_usuario' => User::factory(),
            'cep' => fake()->numerify('########'),
            'logradouro' => fake()->streetName(),
            'numero' => fake()->buildingNumber(),
            'bairro' => fake()->citySuffix(),
            'cidade' => fake()->city(),
            'estado' => fake()->state(),
            'complemento' => fake()->optional()->secondaryAddress(),
        ];
    }
}
