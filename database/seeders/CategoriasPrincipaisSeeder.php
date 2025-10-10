<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasPrincipaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Orientação Profissional/Material de Apoio',
            'Áreas de Atuação e Requisitos Técnicos',
            'Conteúdo Técnico Específico',
        ];

        foreach ($categorias as $name) {
            // Usa firstOrCreate para evitar duplicidade se o seeder for rodado mais de uma vez
            Categoria::firstOrCreate(
                ['name_category' => $name]
            );
        }
    }
}
