<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            // Tema 1: Orientação
            'Carreira', 'Júnior', 'Currículo', 'Entrevista', 'Portfólio', 'Soft Skills', 'Comunicação', 
            'Resiliência', 'Bem-Estar', 'Saúde Mental', 'Networking', 'Comunidade', 'Estágio', 'Liderança',
            'Mentoria', 'Feedback', 'Transição', 'Emprego', 'Projeto Pessoal', 
            
            // Tema 2: Requisitos e Áreas
            'Front-end', 'Back-end', 'Roadmap', 'Requisitos Técnicos', 'Data Science', 'DevOps', 'QA',
            'SQL', 'NoSQL', 'Docker', 'Infraestrutura', 'Full Stack', 'Segurança', 'Arquitetura',
            
            // Tema 3: Técnico Específico
            'Código', 'Python', 'JavaScript', 'React', 'PHP', 'Laravel', 'TypeScript', 'POO', 
            'Framework', 'Sintaxe', 'Tutorial', 'Layout', 'CSS', 'HTML', 'Git', 'API', 'Rotas',
        ];

        foreach (array_unique($tags) as $name) {
            Tag::firstOrCreate(['name_tag' => $name]);
        }
    }
}
