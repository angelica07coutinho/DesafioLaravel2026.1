<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        $imagemDefault = 'produtos/default.png';
        if (!Storage::disk('public')->exists($imagemDefault)) {
            $sourcePath = public_path('images/default.png');
            if (File::exists($sourcePath)) {
                Storage::disk('public')->put($imagemDefault, File::get($sourcePath));
            }
        }
        
        return [
            'nome' => fake()->sentence(3),
            'descricao' => fake()->paragraph(8),
            'foto_produto' => $imagemDefault,
            'preco' => fake()->randomFloat(2, 1, 100),
            'quantidade' => fake()->numberBetween(1, 100),
            'id_vendedor' => User::factory(),
            'id_categoria' => fake()->numberBetween(1, 8),
        ];
    }
}
