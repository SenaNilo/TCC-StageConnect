<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica se o usuário administrador já existe no banco de dados.
        // Isso evita a criação de duplicatas se o seeder for rodado mais de uma vez.
        $adminUser = Usuario::where('email', 'admin@gmail.com')->first();

        // Se o usuário não existe, nós o criamos.
        if (!$adminUser) {
            Usuario::create([
                'name_user' => 'Admin',
                'email' => 'admin@gmail.com',
                'password_user' => Hash::make('123'), // Use uma senha padrão forte aqui
                'type_user' => 'ADM',
                'active_user' => true,
            ]);

            // Exibe uma mensagem no console para confirmar a criação
            $this->command->info('Usuário administrador criado com sucesso!');
        } else {
            // Se o usuário já existe, exibe uma mensagem no console
            $this->command->info('Usuário administrador já existe.');
        }
    }
}
