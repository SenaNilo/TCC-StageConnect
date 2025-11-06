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

    public function showNoticiasTech(): View
    {      
        return view('pages.aluno.noticias-tech'); 
    }

       public function showConfiguracoes(): View
    {
        // Crie um arquivo em 'resources/views/aluno/areas_tecnicas.blade.php'
        // para esta página.
        return view('pages.aluno.configuracoes-aluno');
    }
}
