<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Importar Hash para criptografar a senha
use App\Models\Pessoas;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'web@kasi.com.br',
        //     'password' => 'mudar123!'
        // ]);

         // Cria um usuário administrador
         Pessoas::create([
            'name' => 'admin',
            'email' => 'web@kasi.com.br',
            'password' => Hash::make('mudar123!'),
            'cpf' => '00000000000', // Defina um CPF válido ou de teste
        ]);
    }
}
