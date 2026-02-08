<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Endereco;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'cpf' => '12345678910',
            'telefone' => '12987654321',
            'data_nascimento' => '2000-01-01',
            'tipo' => 'admin',
        ]);
        
        Endereco::factory()->create([
            'id_usuario' => $testUser->id,
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo',
            'estado' => 'São Paulo',
        ]);

        User::factory(9)->create(['tipo' => 'admin'])->each(function ($user) {
            Endereco::factory()->create(['id_usuario' => $user->id]);
        });

        User::factory(18)->create(['tipo' => 'padrao'])->each(function ($user) {
            Endereco::factory()->create(['id_usuario' => $user->id]);
        });
    }
}
