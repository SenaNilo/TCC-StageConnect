<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AlunoController extends Controller
{
      public function showIndex(): View  // <-- MÉTODO ADICIONADO
    {
        // Agora sim, retornamos a view correta, que está em:
        // resources/views/aluno/index.blade.php
        return view('pages.aluno.index');
    }

     /**
     * Mostra a página de entrevistas.
     */
    public function showEntrevistas(): View
    {
        // Aqui você pode buscar dados do banco de dados se precisar
        // Por enquanto, vamos apenas retornar a view.

        // O Laravel vai procurar por 'resources/views/aluno/entrevistas.blade.php'
        return view('pages.aluno.entrevistas'); 
    }

    /**
     * Mostra a página de áreas técnicas.
     */
    public function showAreasTecnicas(): View
    {
        // Crie um arquivo em 'resources/views/aluno/areas_tecnicas.blade.php'
        // para esta página.
        return view('pages.aluno.areastecnicas');
    }

       public function showConfiguracoes(): View
    {
        // Crie um arquivo em 'resources/views/aluno/areas_tecnicas.blade.php'
        // para esta página.
        return view('pages.aluno.userSettings');
    }
}
