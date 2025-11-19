import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [// Arquivos CSS principais que o Vite deve processar
                'resources/css/app.css', // O arquivo limpo (apenas CDNs + Tailwind)
                
                // Use o caminho mais específico para cada arquivo, assumindo que eles estão em 'alunos/'
                'resources/css/alunos/aluno.css', 
                'resources/css/alunos/configuracoes.css', 
                'resources/css/alunos/conteudo-detalhe.css', 
                'resources/css/alunos/conteudos.css', 
                'resources/css/alunos/curriculo-resultado.css', 
                'resources/css/alunos/curriculo.css', 
                'resources/css/alunos/entrevistas.css', 
                
                // Mantenha os scripts
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/alunos/script-aluno.js',
                'resources/js/alunos/modalSucesso.js',
                'resources/js/alunos/modalSair.js',
                
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
