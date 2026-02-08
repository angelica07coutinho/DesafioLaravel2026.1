<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'cpf' => '12345678910',
            'telefone' => '12987654321',
            'data_nascimento' => '2000-01-01',
            'tipo' => 'admin',
        ]);

        User::factory(9)->create(['tipo' => 'admin']);
        User::factory(18)->create(['tipo' => 'padrao']);
    }
}
