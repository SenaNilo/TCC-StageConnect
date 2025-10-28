@php
// Prepara a URL da imagem (com fallback para imagem padrão)
$coverImageUrl = $conteudo->img
? asset('storage/' . $conteudo->img)
: asset('images/default_cover.jpg'); // Certifique-se que 'images/default_cover.jpg' existe
@endphp

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
    @vite(['resources/css/alunos/aluno.css', 'resources/js/alunos/script-aluno.js', 'resources/css/alunos/conteudo-detalhe.css'])
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


        {{-- Área Principal --}}
        <div class="main-content">

            {{-- Card Principal do Conteúdo --}}
            <article class="content-detail-card">

                @php
                $fromOrigin = request()->query('from', 'todos');

                $backRouteName = match($fromOrigin) {
                'orientacao' => 'aluno.orientacao',
                'requisitos' => 'aluno.requisitos',
                'tecnico' => 'aluno.tecnico',
                default => 'aluno.conteudos', // 'todos' ou qualquer outro valor vai para a lista geral
                };
                @endphp
                {{-- Botão Voltar (Opcional) --}}
                <a href="{{ route($backRouteName) }}" class="back-button">
                    <span class="material-symbols-rounded">arrow_back</span> Voltar
                </a>

                {{-- Imagem de Capa --}}
                <div class="content-cover" style="background-image: url('{{ $coverImageUrl }}');">
                    {{-- Pode adicionar um overlay escuro se a imagem for muito clara --}}
                    {{-- <div class="cover-overlay"></div> --}}
                </div>

                {{-- Cabeçalho do Conteúdo (Título e Metadados) --}}
                <header class="content-detail-header">
                    {{-- Título --}}
                    <h1 class="content-detail-title">{{ $conteudo->titulo }}</h1>

                    {{-- Metadados (Autor, Data, Tags) --}}
                    <div class="content-meta">
                        {{-- Autor --}}
                        <span class="meta-item">
                            <span class="material-symbols-rounded icon">person</span>
                            {{ $conteudo->autor?->name_user ?? 'Autor Desconhecido' }} {{-- Usando name_user --}}
                        </span>
                        {{-- Data --}}
                        <span class="meta-item">
                            <span class="material-symbols-rounded icon">calendar_month</span>
                            {{ $conteudo->dt_created ? \Carbon\Carbon::parse($conteudo->dt_created)->format('d/m/Y') : 'Data Indisponível' }}
                        </span>
                        {{-- Tags (Só mostra se houver) --}}
                        @if ($conteudo->tags && $conteudo->tags->isNotEmpty())
                        <span class="meta-item tags-item">
                            <span class="material-symbols-rounded icon">sell</span>
                            @foreach ($conteudo->tags as $tag)
                            {{-- Ajuste 'name_tag' para o nome correto do campo da sua tag --}}
                            <span class="tag-badge">{{ $tag->name_tag }}</span>
                            @endforeach
                        </span>
                        @endif
                    </div>
                </header>

                {{-- Corpo do Conteúdo --}}
                <div class="content-body">
                    {{-- Renderiza o HTML da descrição --}}
                    {{-- CUIDADO: Use isso apenas se confiar na fonte do HTML (evitar XSS) --}}
                    {!! $conteudo->descricao !!}
                </div>

                {{-- Rodapé (Opcional - Pode adicionar links relacionados, etc.) --}}
                {{-- <footer class="content-detail-footer"> ... </footer> --}}

            </article> {{-- Fim do content-detail-card --}}

        </div> {{-- Fim do main-content --}}

    </div> {{-- Fim do container --}}

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    {{-- Modal de Logout --}}
    <div id="logout-modal" class="modal-overlay modal-hidden">
        <div class="card-cancelar">
            <div class="header-cancelar">
                <div class="image">
                    <span class="material-symbols-rounded">warning</span>
                </div>
                <div class="content">
                    <span class="title">Sair da Conta</span>
                    <p>Tem certeza que deseja sair da sua conta?</p>
                </div>
            </div>
            <div class="actions-cancelar">
                <button id="cancel-logout-btn" class="btn-cancelar">Cancelar</button>
                <button id="confirm-logout-btn" class="btn-confirmar">Confirmar</button>
            </div>
        </div>
    </div>
    {{-- Fim do Modal de Logout --}}
</body>

</html>