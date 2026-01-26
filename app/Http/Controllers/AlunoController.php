<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AlunoController extends Controller
{
      public function showIndex(): View
    {
        return view('pages.aluno.index');
    }

    public function showNoticiasTech(): View
    {      
        return view('pages.aluno.noticias-tech'); 
    }

       public function showConfiguracoes(): View
    {
        return view('pages.aluno.configuracoes-aluno');
    }
}
