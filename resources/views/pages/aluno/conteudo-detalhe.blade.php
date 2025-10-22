<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Detalhes - StageConnect</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- <link rel="stylesheet" href="{{ asset('css/main.css') }}"> -->
    <link rel="icon" type="image/png" href="{{ asset('images/LogoSFundo.png') }}" />
    {{-- Adicione a diretiva Vite --}}
    @vite(['resources/css/alunos/aluno.css','resources/css/alunos/conteudos.css', 'resources/js/alunos/script-aluno.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- <script src='script-aluno.js'></script> --}}

</head>

<body>
    {{-- Responsividade --}}
    <nav class="site-nav">
        <button class="sidebar-toggle">
            <span class="material-symbols-rounded"> menu </span>
        </button>
    </nav>

    <div class="container">
        <x-aluno.sidebarAluno />


        <div class="main-content">
            @php
            // Prepara a URL da imagem (com fallback para a imagem padrão)
            $coverImageUrl = $conteudo->img
            ? asset('storage/' . $conteudo->img)
            : asset('images/default_cover.jpg');
            @endphp
            <div class="blog-container">
                <div class="blog-header">
                    {{-- Lógica da Imagem como Background --}}
                    {{-- Usa a variável preparada. O linter entende isso. --}}
                    <div class="blog-cover"
                        style="background-image: url('{{ $coverImageUrl }}')">
                        <div class="blog-author">
                            <h3>{{ $conteudo->autor->name_user }}</h3>
                        </div>
                    </div>
                </div>

                <div class="blog-body">
                    <div class="blog-title">
                        {{-- Título --}}
                        <h1>{{ $conteudo->titulo }}</h1>
                    </div>
                    <div class="blog-summary">
                        {{-- Conteúdo (Descrição Completa) --}}
                        <p>{{ $conteudo->descricao }}</p>
                    </div>

                    <div class="blog-tags">
                        <ul>
                            @foreach ($conteudo->tags as $tag)
                            {{-- Tags --}}
                            <li><a href="#">{{ $tag->name_tag }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="blog-footer">
                    <ul>
                        {{-- Data de Publicação --}}
                        <li class="published-date">{{ $conteudo->dt_created->format('M. d, Y') }}</li>
                        {{-- Links/ícones de comentário e compartilhamento (Opcional, pode ser removido se não for usado) --}}
                        {{-- ... --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>