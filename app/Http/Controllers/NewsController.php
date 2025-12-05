<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{

    public function index(Request $request)
    {

        $query = DB::table('aggregated_posts');

        if ($request->filled('search')) {
            $busca = $request->input('search');

            $query->where(function ($q) use ($busca) {
                $q->where('title', 'like', "%{$busca}%")
                    ->orWhere('snippet', 'like', "%{$busca}%");
            });
        }

        $orderDirection = $request->input('order', 'desc');

        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'desc';
        }

        $query->orderBy('published_at', $orderDirection);

        $posts = $query->paginate(10)->withQueryString();

        return view('pages.aluno.noticias-tech', [
            'posts' => $posts, 
            'orderDirection' => $orderDirection
        ]);
    }
}
