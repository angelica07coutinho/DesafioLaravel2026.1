<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Endereco;
use App\Models\Produto;
use App\Models\Categoria;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categorias = [
            ['nome' => 'Dispositivos Móveis'],
            ['nome' => 'Computadores e Notebooks'],
            ['nome' => 'Acessórios e Componentes'],
            ['nome' => 'Jogos e Consoles'],
            ['nome' => 'Som e Audio'],
            ['nome' => 'Imagens e Vídeo'],
            ['nome' => 'Smart Home'],
            ['nome' => 'Cabos e Conectores'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }

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

        User::factory(5)->create(['tipo' => 'admin', 'id_criador' => 1])->each(function ($user) {
            Endereco::factory()->create(['id_usuario' => $user->id]);
        });

        User::factory(4)->create(['tipo' => 'admin', 'id_criador' => 2])->each(function ($user) {
            Endereco::factory()->create(['id_usuario' => $user->id]);
        });

        User::factory(18)->create(['tipo' => 'padrao'])->each(function ($user) {
            Endereco::factory()->create(['id_usuario' => $user->id]);
            Produto::factory(2)->create(['id_vendedor' => $user->id]);
        });
    }
}
