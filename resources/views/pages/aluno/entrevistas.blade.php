@php
use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>

    <title>Notícias Tech - StageConnect</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoSFundo.png') }}" />

    @vite(['resources/css/alunos/aluno.css', 'resources/css/alunos/conteudos.css', 'resources/js/alunos/script-aluno.js', 'resources/js/alunos/modalSair.js'])

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    {{-- Responsividade --}}
    <nav class="site-nav">
        <button class="sidebar-toggle">
            <span class="material-symbols-rounded"> menu </span>
        </button>
    </nav>

    <div class="container">
        {{-- Puxa a sua Sidebar --}}
        <x-aluno.sidebarAluno />


        <div class="main-content">
            <div class="main-inicial">

                {{-- Título da Página (como no seu menu) --}}
                <h1 class="page-title">Notícias Tech</h1>

                {{-- LÓGICA DA FOTO DE PERFIL (Mantida) --}}
                @if (Auth::user()->foto_perfil)
                <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}"
                    alt="Foto de perfil do usuário"
                    class="perfil-img">
                @else
                <div class="perfil-img perfil-placeholder">
                    <span class="material-symbols-rounded"> account_circle </span>
                </div>
                @endif
            </div>

            {{-- Filtros e Busca (Mantido do seu layout de conteúdos) --}}
            <div class="content-header">
                <div class="search-and-filters">
                    <div class="search-bar">
                        <span class="material-symbols-rounded">search</span>
                        {{-- (Funcionalidade de busca pode ser implementada depois) --}}
                        <input type="search" placeholder="Buscar Notícias..." name="search" id="content-search">
                    </div>
                    <div class="filter-buttons">
                        <button class="filter-btn" type="button">
                            <span class="material-symbols-rounded">schedule</span>
                            Mais Recentes
                        </button>
                    </div>
                </div>
            </div>

            <hr class="content-divider">

            <div class="content-grid">

                {{--
                    Usamos @forelse (ao invés de @foreach)
                    Isso nos permite mostrar uma mensagem caso a variável $posts esteja vazia.
                --}}
                @forelse ($posts as $post)

                {{--
                        Aqui usamos o layout do 'content-item-card' que você já tem, 
                        mas alimentamos com os dados do $post (vindo do RSS) 
                    --}}
                <article class="content-item-card">

                    {{-- REQUISIÇÃO #5: Lógica da Thumbnail --}}
                    <div class="card-thumbnail">
                        @if ($post->thumbnail_url)
                        {{-- Se o post tem uma thumbnail, usa ela --}}
                        <img src="{{ $post->thumbnail_url }}" alt="Thumbnail para {{ $post->title }}">
                        @else
                        {{-- Senão, usa um ícone padrão baseado na categoria --}}
                        @if ($post->category == 'Vagas')
                        <span class="material-symbols-rounded"> work </span>
                        @else
                        <span class="material-symbols-rounded"> news </span>
                        @endif
                        @endif
                    </div>
                    <div class="card-body">

                        {{-- Título --}}
                        <h2 class="card-title">{{ $post->title }}</h2>

                        <div class="card-meta">
                            {{-- ITEM NOVO: Categoria --}}
                            <span class="meta-item">
                                @if ($post->category == 'Vagas')
                                <span class="material-symbols-rounded icon">work</span>
                                @else
                                <span class="material-symbols-rounded icon">article</span>
                                @endif
                                <strong>{{ $post->category }}</strong>
                            </span>

                            {{-- Item da Fonte --}}
                            <span class="meta-item">
                                <span class="material-symbols-rounded icon">label</span>
                                {{ $post->source_name }} {{-- Tirei o strong daqui --}}
                            </span>

                            {{-- Item da Data --}}
                            <span class="meta-item">
                                <span class="material-symbols-rounded icon">calendar_month</span>
                                {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d/m/Y') : 'Data Indisponível' }}
                            </span>
                        </div>

                        {{-- Descrição (Snippet) --}}
                        <p class="card-description">
                            {{-- Usamos Str::limit para garantir que o texto não quebre o card --}}
                            {{ Str::limit($post->snippet, 150) }} {{-- Mapeado para o Snippet --}}
                        </p>

                        {{-- Botão "Ver mais" (Link externo) --}}
                        <a href="{{ $post->source_url }}" target="_blank" class="card-button">
                            Ver matéria completa
                        </a>

                    </div>
                </article>

                @empty
                {{-- Isso aparece se $posts estiver vazio --}}
                <div class="empty-state-message" style="grid-column: 1 / -1; text-align: center; padding: 40px; color: var(--color-text-secondary);">
                    <span class="material-symbols-rounded" style="font-size: 48px; display: block; margin-bottom: 10px;">sentiment_dissatisfied</span>
                    <p>Nenhuma notícia encontrada no momento. O robô está buscando!</p>
                </div>
                @endforelse

            </div> {{-- Fim do content-grid --}}

            {{-- =========== LINKS DE PAGINAÇÃO =========== --}}
            <div class="pagination-links" style="padding: 20px 0; display: flex; justify-content: center;">
                {{ $posts->links() }}
            </div>

        </div>
    </div>

    {{-- FORMULÁRIO E MODAL DE LOGOUT (Mantidos) --}}

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div id="logout-modal" class="modal-overlay modal-hidden">
        <div class="card-cancelar">
            <div class="header-cancelar">
                <div class="image">
                    <span class="material-symbols-rounded">warning</span>
                </div>
                <div class="content">
                    <span class="title">Sair da Conta</span>
                    <p class="message">Você tem certeza que deseja sair?</p>
                </div>
                <div class="actions">
                    <button id="confirm-logout-btn" class="desactivate" type="button">Confirmar</button>
                    <button id="cancel-logout-btn" class="cancel" type="button">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>