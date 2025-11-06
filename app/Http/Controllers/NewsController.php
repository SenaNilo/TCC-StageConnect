<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{

    public function index()
    {
        $posts = DB::table('aggregated_posts')
            ->latest('published_at') // Ordena pelos mais novos
            ->paginate(10); // Mostra 10 por página

        return view('pages.aluno.noticias-tech', ['posts' => $posts]);
    }
}
